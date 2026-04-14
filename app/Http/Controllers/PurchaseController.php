<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display the purchases dashboard.
     */
    public function dashboard()
    {
        // Get purchase statistics
        $todayPurchases = Purchase::whereDate('order_date', today())->sum('final_amount');
        $monthlyPurchases = Purchase::whereMonth('order_date', now()->month)
            ->whereYear('order_date', now()->year)
            ->sum('final_amount');
        $activeOrders = Purchase::whereIn('status', ['ordered', 'in_transit'])->count();
        $totalSuppliers = Supplier::count();

        // Get recent purchases with relationships
        $recentPurchases = Purchase::with(['supplier', 'creator'])
            ->orderBy('order_date', 'desc')
            ->limit(10)
            ->get();

        // Get top suppliers by purchase amount
        $topSuppliers = Supplier::withCount(['purchases'])
            ->withSum('purchases', 'final_amount')
            ->orderByDesc('purchases_sum_final_amount')
            ->limit(5)
            ->get();

        // Get purchase status counts
        $purchaseStatuses = [
            'ordered' => Purchase::where('status', 'ordered')->count(),
            'in_transit' => Purchase::where('status', 'in_transit')->count(),
            'received' => Purchase::where('status', 'received')->count(),
            'cancelled' => Purchase::where('status', 'cancelled')->count(),
        ];

        // Get monthly purchase trend for the last 6 months
        $monthlyTrend = Purchase::select(
            DB::raw('MONTH(order_date) as month'),
            DB::raw('YEAR(order_date) as year'),
            DB::raw('SUM(final_amount) as total_amount'),
            DB::raw('COUNT(*) as order_count')
        )
            ->where('order_date', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Get pending approvals count
        $pendingApprovals = Purchase::where('status', 'ordered')->count();

        return view('purchases.dashboard', compact(
            'todayPurchases',
            'monthlyPurchases',
            'activeOrders',
            'totalSuppliers',
            'recentPurchases',
            'topSuppliers',
            'purchaseStatuses',
            'monthlyTrend',
            'pendingApprovals'
        ));
    }

    /**
     * Display a listing of the purchases.
     */
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'creator'])
            ->orderBy('order_date', 'desc')
            ->paginate(20);

        // Get additional statistics for the view
        $monthlyOrders = Purchase::whereMonth('order_date', now()->month)->count();
        $monthlyAmount = Purchase::whereMonth('order_date', now()->month)->sum('final_amount');
        $pendingOrders = Purchase::whereIn('status', ['ordered', 'in_transit'])->count();
        $completedOrders = Purchase::where('status', 'received')->count();
        $totalAmount = Purchase::sum('final_amount');

        return view('purchases.orders', compact('purchases', 'monthlyOrders', 'monthlyAmount', 'pendingOrders', 'completedOrders', 'totalAmount'));
    }

    /**
     * Show the form for creating a new purchase.
     */
    public function create()
    {
        // Get active suppliers
        $suppliers = Supplier::where('status', 'active')->orderBy('name')->get();
        
        // Get active products
        $products = Product::where('status', 'active')->orderBy('name')->get();
        
        // Generate next PO number
        $lastPurchase = Purchase::orderBy('created_at', 'desc')->first();
        $nextPoNumber = $lastPurchase ? 'PO-' . date('Y') . '-' . str_pad(substr($lastPurchase->purchase_number, -4) + 1, 4, '0', STR_PAD_LEFT) : 'PO-' . date('Y') . '-0001';

        return view('purchases.create', compact('suppliers', 'products', 'nextPoNumber'));
    }

    /**
     * Store a newly created purchase in storage.
     */
    public function store(Request $request)
    {
        $action = $request->input('action', 'create');
        
        // Validation rules differ for draft vs create
        if ($action === 'draft') {
            $request->validate([
                'supplier_id' => 'required|exists:suppliers,id',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'order_date' => 'required|date',
                'notes' => 'nullable|string',
            ]);
        } else {
            $request->validate([
                'supplier_id' => 'required|exists:suppliers,id',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.unit_price' => 'required|numeric|min:0',
                'order_date' => 'required|date',
                'expected_date' => 'nullable|date|after_or_equal:order_date',
                'notes' => 'nullable|string',
            ]);
        }

        DB::beginTransaction();
        try {
            // Calculate total amount
            $totalAmount = collect($request->items)->sum(function($item) {
                return ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
            });

            // Create purchase with appropriate status
            $status = $action === 'draft' ? 'draft' : 'ordered';
            
            $purchase = Purchase::create([
                'purchase_number' => 'PO-' . date('Y') . '-' . str_pad(Purchase::count() + 1, 4, '0', STR_PAD_LEFT),
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'expected_date' => $request->expected_date,
                'status' => $status,
                'total_amount' => $totalAmount,
                'final_amount' => $totalAmount,
                'notes' => $request->notes,
                'created_by' => Auth::id(),
            ]);

            // Create purchase items
            foreach ($request->items as $item) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'] ?? 0,
                    'unit_price' => $item['unit_price'] ?? 0,
                    'total_price' => ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0),
                    'description' => $item['description'] ?? '',
                ]);
            }

            DB::commit();
            
            $message = $action === 'draft' 
                ? 'Purchase order draft saved successfully.' 
                : 'Purchase order created successfully.';
                
            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect_url' => route('purchases.orders')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error ' . ($action === 'draft' ? 'saving draft' : 'creating purchase order') . ': ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Display the specified purchase.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'creator', 'purchaseItems.product']);
        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified purchase.
     */
    public function edit(Purchase $purchase)
    {
        if ($purchase->status !== 'ordered') {
            return back()->with('error', 'Cannot edit purchase order that is already processed.');
        }

        $purchase->load(['supplier', 'purchaseItems.product']);
        $suppliers = Supplier::where('status', 'active')->orderBy('name')->get();
        $products = Product::where('status', 'active')->orderBy('name')->get();

        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    /**
     * Update the specified purchase in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        if ($purchase->status !== 'ordered') {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot update purchase order that is already processed.'
                ], 422);
            }
            return back()->with('error', 'Cannot update purchase order that is already processed.');
        }

        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'expected_date' => 'nullable|date|after_or_equal:order_date',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Calculate total amount
            $totalAmount = collect($request->items)->sum(function($item) {
                return $item['quantity'] * $item['unit_price'];
            });

            // Update purchase
            $purchase->update([
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'expected_date' => $request->expected_date,
                'total_amount' => $totalAmount,
                'final_amount' => $totalAmount,
                'notes' => $request->notes,
            ]);

            // Delete old items and create new ones
            $purchase->purchaseItems()->delete();
            foreach ($request->items as $item) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                    'description' => $item['description'] ?? '',
                ]);
            }

            DB::commit();
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Purchase order updated successfully.',
                    'redirect_url' => route('purchases.show', $purchase->id)
                ]);
            }
            
            return redirect()->route('purchases.show', $purchase->id)->with('success', 'Purchase order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating purchase order: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->withInput()->with('error', 'Error updating purchase order: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified purchase from storage.
     */
    public function destroy(Request $request, Purchase $purchase)
    {
        if ($purchase->status !== 'ordered' && $purchase->status !== 'draft') {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete purchase order that is already processed.'
                ], 422);
            }
            return back()->with('error', 'Cannot delete purchase order that is already processed.');
        }

        DB::beginTransaction();
        try {
            $purchase->purchaseItems()->delete();
            $purchase->delete();
            DB::commit();
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Purchase order deleted successfully.',
                    'redirect_url' => route('purchases.orders')
                ]);
            }
            
            return redirect()->route('purchases.orders')->with('success', 'Purchase order deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting purchase order: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->with('error', 'Error deleting purchase order: ' . $e->getMessage());
        }
    }

    /**
     * Update purchase status.
     */
    public function updateStatus(Request $request, Purchase $purchase)
    {
        $request->validate([
            'status' => 'required|in:ordered,in_transit,received,cancelled',
        ]);

        try {
            $purchase->update(['status' => $request->status]);
            
            // If status is received, update stock
            if ($request->status === 'received') {
                foreach ($purchase->purchaseItems as $item) {
                    $product = $item->product;
                    if ($product) {
                        $product->increment('quantity', $item->quantity);
                    }
                }
            }
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Purchase status updated successfully.',
                    'redirect_url' => route('purchases.show', $purchase->id)
                ]);
            }
            
            return back()->with('success', 'Purchase status updated successfully.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating purchase status: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->with('error', 'Error updating purchase status: ' . $e->getMessage());
        }
    }

    /**
     * Generate invoice for purchase.
     */
    public function generateInvoice(Request $request, Purchase $purchase)
    {
        try {
            // Load purchase with relationships for invoice
            $purchase->load(['supplier', 'purchaseItems.product']);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Invoice generated successfully.',
                    'redirect_url' => route('purchases.invoice.view', $purchase->id)
                ]);
            }
            
            return view('purchases.invoice', compact('purchase'));
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error generating invoice: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->with('error', 'Error generating invoice: ' . $e->getMessage());
        }
    }

    /**
     * View invoice for purchase.
     */
    public function viewInvoice(Request $request, Purchase $purchase)
    {
        try {
            // Load purchase with relationships for invoice
            $purchase->load(['supplier', 'purchaseItems.product']);
            
            return view('purchases.invoice', compact('purchase'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading invoice: ' . $e->getMessage());
        }
    }

    /**
     * Track purchase order.
     */
    public function trackPurchase(Request $request, Purchase $purchase)
    {
        try {
            // Generate tracking information (in a real app, this would integrate with shipping APIs)
            $trackingInfo = [
                'tracking_number' => 'TRK-' . strtoupper(substr(md5($purchase->id), 0, 8)),
                'status' => ucfirst($purchase->status),
                'estimated_delivery' => $purchase->expected_date ? $purchase->expected_date->format('M d, Y') : 'Not specified',
                'last_updated' => $purchase->updated_at->format('M d, Y H:i'),
                'current_location' => $purchase->status === 'received' ? 'Delivered' : 'In Transit',
                'carrier' => 'Express Shipping Co.'
            ];
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tracking information retrieved successfully.',
                    'tracking_info' => $trackingInfo
                ]);
            }
            
            return back()->with('success', 'Tracking information retrieved successfully.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error retrieving tracking information: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->with('error', 'Error retrieving tracking information: ' . $e->getMessage());
        }
    }

    /**
     * Cancel purchase order.
     */
    public function cancelPurchase(Request $request, Purchase $purchase)
    {
        if (!in_array($purchase->status, ['ordered', 'draft'])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot cancel purchase order that is already processed.'
                ], 422);
            }
            return back()->with('error', 'Cannot cancel purchase order that is already processed.');
        }

        try {
            $purchase->update(['status' => 'cancelled']);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Purchase order cancelled successfully.',
                    'redirect_url' => route('purchases.orders')
                ]);
            }
            
            return redirect()->route('purchases.orders')->with('success', 'Purchase order cancelled successfully.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error cancelling purchase order: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->with('error', 'Error cancelling purchase order: ' . $e->getMessage());
        }
    }

    /**
     * Approve purchase order.
     */
    public function approvePurchase(Request $request, Purchase $purchase)
    {
        if ($purchase->status !== 'draft') {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only draft purchase orders can be approved.'
                ], 422);
            }
            return back()->with('error', 'Only draft purchase orders can be approved.');
        }

        try {
            $purchase->update(['status' => 'ordered']);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Purchase order approved successfully.',
                    'redirect_url' => route('purchases.orders')
                ]);
            }
            
            return redirect()->route('purchases.orders')->with('success', 'Purchase order approved successfully.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error approving purchase order: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->with('error', 'Error approving purchase order: ' . $e->getMessage());
        }
    }

    /**
     * Reject purchase order.
     */
    public function rejectPurchase(Request $request, Purchase $purchase)
    {
        if ($purchase->status !== 'draft') {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only draft purchase orders can be rejected.'
                ], 422);
            }
            return back()->with('error', 'Only draft purchase orders can be rejected.');
        }

        try {
            $purchase->update(['status' => 'cancelled']);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Purchase order rejected successfully.',
                    'redirect_url' => route('purchases.orders')
                ]);
            }
            
            return redirect()->route('purchases.orders')->with('success', 'Purchase order rejected successfully.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error rejecting purchase order: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->with('error', 'Error rejecting purchase order: ' . $e->getMessage());
        }
    }
}
