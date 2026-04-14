<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Payment;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display the sales dashboard.
     */
    public function dashboard()
    {
        $sales = Sale::with(['creator', 'saleItems'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Get statistics
        $totalSales = Sale::count();
        $totalRevenue = Sale::where('sale_status', 'completed')->sum('final_amount');
        $retailSales = Sale::retail()->count();
        $wholesaleSales = Sale::wholesale()->count();
        $pendingPayments = Sale::where('payment_status', 'pending')->count();
        
        return view('sales.dashboard', compact('totalSales', 'totalRevenue', 'retailSales', 'wholesaleSales', 'sales'));
    }

    /**
     * Display POS interface.
     */
    public function pos()
    {
        $products = Product::with(['category', 'brand', 'supplier'])
            ->where('status', 'active')
            ->where('quantity', '>', 0)
            ->get();
        return view('sales.pos', compact('products'));
    }

    /**
     * Display pricing page.
     */
    public function pricing()
    {
        $products = Product::get();
        return view('sales.pricing', compact('products'));
    }

    /**
     * Display retail sales.
     */
    public function retailIndex(Request $request)
    {
        $sales = Sale::retail()
            ->with(['creator', 'saleItems'])
            ->when($request->search, function($query, $search) {
                $query->where('sale_number', 'like', "%{$search}%")
                      ->orWhere('customer_name', 'like', "%{$search}%")
                      ->orWhere('customer_email', 'like', "%{$search}%");
            })
            ->when($request->payment_status, function($query, $status) {
                $query->where('payment_status', $status);
            })
            ->when($request->sale_status, function($query, $status) {
                $query->where('sale_status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('sales.retail.index', compact('sales'));
    }

    /**
     * Display wholesale sales.
     */
    public function wholesaleIndex(Request $request)
    {
        $sales = Sale::wholesale()
            ->with(['creator', 'saleItems'])
            ->when($request->search, function($query, $search) {
                $query->where('sale_number', 'like', "%{$search}%")
                      ->orWhere('customer_name', 'like', "%{$search}%")
                      ->orWhere('customer_email', 'like', "%{$search}%");
            })
            ->when($request->payment_status, function($query, $status) {
                $query->where('payment_status', $status);
            })
            ->when($request->sale_status, function($query, $status) {
                $query->where('sale_status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('sales.wholesale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create()
    {
        return redirect()->route('sales.pos');
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sale_type' => 'required|in:retail,wholesale',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cash,card,bank_transfer,mobile_money,credit',
            'payment_amount' => 'nullable|numeric|min:0',
            'payment_methods' => 'nullable|array',
            'payment_methods.*.method' => 'nullable|string|in:cash,card,bank_transfer,mobile_money,credit',
            'payment_methods.*.amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            DB::beginTransaction();
            
            // Calculate totals using system tax rate
            $totalAmount = 0;
            $discountAmount = 0;
            $taxAmount = 0;
            
            // Get tax rate from system settings
            $taxRate = SystemSetting::isTaxEnabled() ? SystemSetting::getTaxRate() : 0;
            
            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                $itemDiscount = $subtotal * ($item['discount_percentage'] ?? 0) / 100;
                $afterDiscount = $subtotal - $itemDiscount;
                $itemTax = $afterDiscount * ($taxRate / 100);
                
                $totalAmount += $subtotal;
                $discountAmount += $itemDiscount;
                $taxAmount += $itemTax;
            }
            
            $finalAmount = $totalAmount - $discountAmount + $taxAmount;
            
            // Determine payment status
            $paymentAmount = $request->payment_amount ?? 0;
            $paymentStatus = 'unpaid';
            
            if ($request->payment_method === 'credit') {
                $paymentStatus = 'unpaid';
            } elseif ($paymentAmount >= $finalAmount) {
                $paymentStatus = 'paid';
            } elseif ($paymentAmount > 0) {
                $paymentStatus = 'partial';
            }
            
            // Create sale
            $sale = Sale::create([
                'sale_number' => Sale::generateSaleNumber(),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'sale_type' => $request->sale_type,
                'total_amount' => $totalAmount,
                'discount_amount' => $discountAmount,
                'tax_amount' => $taxAmount,
                'final_amount' => $finalAmount,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'sale_status' => 'completed',
                'notes' => $request->notes,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);
            
            // Create sale items
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                
                $subtotal = $item['quantity'] * $item['unit_price'];
                $itemDiscount = $subtotal * ($item['discount_percentage'] ?? 0) / 100;
                $afterDiscount = $subtotal - $itemDiscount;
                $itemTax = $afterDiscount * ($taxRate / 100);
                $itemTotal = $afterDiscount + $itemTax;
                
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'discount_percentage' => $item['discount_percentage'] ?? 0,
                    'discount_amount' => $itemDiscount,
                    'tax_percentage' => $taxRate,
                    'tax_amount' => $itemTax,
                    'total_price' => $itemTotal,
                ]);
                
                // Update product quantity
                $product->decrement('quantity', $item['quantity']);
            }
            
            // Create payment records for multiple payment methods
            $paymentMethods = $request->payment_methods ?? [];
            
            if (!empty($paymentMethods)) {
                foreach ($paymentMethods as $paymentMethod) {
                    if ($paymentMethod['method'] !== 'credit' && isset($paymentMethod['amount']) && $paymentMethod['amount'] > 0) {
                        Payment::create([
                            'sale_id' => $sale->id,
                            'amount' => $paymentMethod['amount'],
                            'payment_method' => $paymentMethod['method'],
                            'payment_status' => 'completed',
                            'user_id' => Auth::id(),
                        ]);
                    }
                }
            } else {
                // Fallback to single payment method for backward compatibility
                if ($paymentAmount > 0 && $request->payment_method !== 'credit') {
                    Payment::create([
                        'sale_id' => $sale->id,
                        'amount' => $paymentAmount,
                        'payment_method' => $request->payment_method,
                        'payment_status' => 'completed',
                        'user_id' => Auth::id(),
                    ]);
                }
            }
            
            DB::commit();
            
            // Check if request wants JSON response (for AJAX)
            if ($request->header('Accept') === 'application/json' || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Sale created successfully',
                    'sale_id' => $sale->id,
                    'sale_number' => $sale->sale_number
                ]);
            }
            
            return redirect()->route('sales.dashboard')
                ->with('success', 'Sale "' . $sale->sale_number . '" created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Check if request wants JSON response (for AJAX)
            if ($request->header('Accept') === 'application/json' || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create sale: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->with('error', 'Failed to create sale. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified sale.
     */
    public function show(Sale $sale)
    {
        $sale->load(['creator', 'updater', 'saleItems.product']);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified sale.
     */
    public function edit(Sale $sale)
    {
        if ($sale->sale_status === 'completed' || $sale->sale_status === 'cancelled') {
            return redirect()->route('sales.show', $sale)
                ->with('error', 'Cannot edit ' . $sale->sale_status . ' sales.');
        }
        
        $sale->load('saleItems.product');
        $products = Product::where('status', 'active')->get();
        
        return view('sales.edit', compact('sale', 'products'));
    }

    /**
     * Update the specified sale in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        if ($sale->sale_status === 'completed' || $sale->sale_status === 'cancelled') {
            return redirect()->route('sales.show', $sale)
                ->with('error', 'Cannot edit ' . $sale->sale_status . ' sales.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cash,card,bank_transfer,mobile_money',
            'payment_status' => 'required|in:pending,paid,partial,overdue',
            'sale_status' => 'required|in:pending,completed,cancelled,refunded',
            'notes' => 'nullable|string',
        ]);

        try {
            $sale->update([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_status,
                'sale_status' => $request->sale_status,
                'notes' => $request->notes,
                'updated_by' => Auth::id(),
            ]);

            return redirect()->route('sales.show', $sale)
                ->with('success', 'Sale "' . $sale->sale_number . '" updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update sale. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified sale from storage.
     */
    public function destroy(Sale $sale)
    {
        if ($sale->sale_status === 'completed') {
            return redirect()->route('sales.show', $sale)
                ->with('error', 'Cannot delete completed sales.');
        }

        try {
            DB::beginTransaction();
            
            // Restore product quantities
            foreach ($sale->saleItems as $item) {
                if ($item->product) {
                    $item->product->increment('quantity', $item->quantity);
                }
            }
            
            $saleNumber = $sale->sale_number;
            $sale->delete();
            
            DB::commit();
            
            return redirect()->route('sales.dashboard')
                ->with('success', 'Sale "' . $saleNumber . '" deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to delete sale. Please try again.');
        }
    }

    /**
     * Display sales reports.
     */
    public function reports(Request $request)
    {
        $startDate = $request->start_date ?: now()->startOfMonth();
        $endDate = $request->end_date ?: now()->endOfDay();
        
        $sales = Sale::with(['creator', 'saleItems'])
            ->inDateRange($startDate, $endDate)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate statistics
        $totalRevenue = $sales->where('sale_status', 'completed')->sum('final_amount');
        $totalSales = $sales->count();
        $retailRevenue = $sales->where('sale_type', 'retail')->where('sale_status', 'completed')->sum('final_amount');
        $wholesaleRevenue = $sales->where('sale_type', 'wholesale')->where('sale_status', 'completed')->sum('final_amount');
        
        // Payment method breakdown
        $paymentMethods = $sales->where('sale_status', 'completed')
            ->groupBy('payment_method')
            ->map(function($sales) {
                return $sales->sum('final_amount');
            });
        
        return view('sales.reports', compact(
            'sales', 'startDate', 'endDate', 'totalRevenue', 
            'totalSales', 'retailRevenue', 'wholesaleRevenue', 'paymentMethods'
        ));
    }

    /**
     * Update sale status.
     */
    public function updateStatus(Request $request, Sale $sale)
    {
        $request->validate([
            'sale_status' => 'required|in:pending,completed,cancelled,refunded',
            'payment_status' => 'required|in:pending,paid,partial,overdue',
        ]);

        try {
            $sale->update([
                'sale_status' => $request->sale_status,
                'payment_status' => $request->payment_status,
                'updated_by' => Auth::id(),
            ]);

            return back()->with('success', 'Sale status updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update sale status. Please try again.');
        }
    }

    /**
     * Export sales data.
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfDay()->format('Y-m-d'));
        
        $sales = Sale::with(['creator', 'saleItems'])
            ->inDateRange($startDate, $endDate)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($format === 'excel') {
            return $this->exportToExcel($sales, $startDate, $endDate);
        } elseif ($format === 'pdf') {
            return $this->exportToPDF($sales, $startDate, $endDate);
        }

        return back()->with('error', 'Invalid export format.');
    }

    /**
     * Export sales to Excel.
     */
    private function exportToExcel($sales, $startDate, $endDate)
    {
        $filename = 'sales_report_' . $startDate . '_to_' . $endDate . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($sales) {
            $file = fopen('php://output', 'w');
            
            // CSV Header
            fputcsv($file, [
                'Date',
                'Sale Number',
                'Customer Name',
                'Customer Email',
                'Customer Phone',
                'Sale Type',
                'Payment Method',
                'Payment Status',
                'Sale Status',
                'Total Amount',
                'Discount Amount',
                'Tax Amount',
                'Final Amount',
                'Notes',
                'Created By'
            ]);

            // CSV Data
            foreach ($sales as $sale) {
                fputcsv($file, [
                    $sale->created_at->format('Y-m-d H:i:s'),
                    $sale->sale_number,
                    $sale->customer_name,
                    $sale->customer_email ?? '',
                    $sale->customer_phone ?? '',
                    $sale->sale_type,
                    $sale->payment_method,
                    $sale->payment_status,
                    $sale->sale_status,
                    number_format($sale->total_amount, 2),
                    number_format($sale->discount_amount, 2),
                    number_format($sale->tax_amount, 2),
                    number_format($sale->final_amount, 2),
                    $sale->notes ?? '',
                    $sale->creator ? $sale->creator->name : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export sales to PDF.
     */
    private function exportToPDF($sales, $startDate, $endDate)
    {
        $companyName = SystemSetting::getCompanyName();
        $currencyCode = SystemSetting::getCurrencyCode();
        
        $html = view('sales.pdf-report', compact('sales', 'startDate', 'endDate', 'companyName', 'currencyCode'))->render();
        
        // For now, return as HTML (you can integrate a PDF library like DomPDF later)
        $filename = 'sales_report_' . $startDate . '_to_' . $endDate . '.html';
        
        $headers = [
            'Content-Type' => 'text/html',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response($html, 200, $headers);
    }

    /**
     * Generate invoice for a specific sale.
     */
    public function generateInvoice(Sale $sale)
    {
        $sale->load(['creator', 'saleItems.product']);
        $companyName = SystemSetting::getCompanyName();
        $currencyCode = SystemSetting::getCurrencyCode();
        
        $html = view('sales.invoice-pdf', compact('sale', 'companyName', 'currencyCode'))->render();
        
        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    /**
     * Generate receipt for a specific sale.
     */
    public function generateReceipt(Sale $sale)
    {
        $sale->load(['creator', 'saleItems.product']);
        $companyName = SystemSetting::getCompanyName();
        $currencyCode = SystemSetting::getCurrencyCode();
        
        $html = view('sales.receipt-pdf', compact('sale', 'companyName', 'currencyCode'))->render();
        
        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }
}
