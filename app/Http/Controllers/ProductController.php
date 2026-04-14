<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'supplier']);
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhereHas('category', function($query) use ($request) {
                      $query->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }
        
        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Sort by
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
        
        $products = $query->paginate(15);
        
        // Get categories for filter dropdown
        $categories = Category::where('status', 'active')->orderBy('name')->pluck('name', 'id');
        
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        // Get dynamic data from database models
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        $brands = Brand::where('status', 'active')->orderBy('name')->get();
        $suppliers = Supplier::where('status', 'active')->orderBy('name')->get();
        
        return view('products.create', compact('categories', 'brands', 'suppliers'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'min_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'status' => 'required|in:active,inactive,discontinued',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'barcode' => 'nullable|string|max:50|unique:products,barcode',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        try {
            // Get category name for SKU generation
            $category = Category::find($validated['category_id']);
            $categoryName = $category ? $category->name : null;
            
            // Auto-generate unique SKU
            $validated['sku'] = Product::generateUniqueSku($validated['name'], $categoryName);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }

            $product = Product::create($validated);

            return redirect()->route('products.index')
                ->with('success', 'Product "' . $product->name . '" created successfully with SKU: ' . $product->sku);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create product. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // Load product with relationships
        $product->load(['category', 'brand', 'supplier']);
        
        // Get all sale items for this product to show sales history
        $saleItems = \App\Models\SaleItem::where('product_id', $product->id)
            ->with('sale')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('products.show', compact('product', 'saleItems'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        // Get dynamic data from database
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        $suppliers = Supplier::where('status', 'active')->orderBy('name')->get();
        $brands = Brand::where('status', 'active')->orderBy('name')->get();
        
        return view('products.edit', compact('product', 'categories', 'suppliers', 'brands'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'min_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'status' => 'required|in:active,inactive,discontinued',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'barcode' => 'nullable|string|max:50|unique:products,barcode,' . $product->id,
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                
                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }

            $product->update($validated);

            return redirect()->route('products.index')
                ->with('success', 'Product "' . $product->name . '" updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update product. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Delete product image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $productName = $product->name;
            $product->delete();

            return redirect()->route('products.index')
                ->with('success', 'Product "' . $productName . '" deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete product. Please try again.');
        }
    }

    /**
     * Update product status.
     */
    public function updateStatus(Request $request, Product $product)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,inactive,discontinued',
        ]);

        $product->update($validated);

        return back()->with('success', 'Product status updated successfully.');
    }

    /**
     * Bulk delete products.
     */
    public function bulkDelete(Request $request)
    {
        $productIds = $request->input('products', []);
        
        if (empty($productIds)) {
            return back()->with('error', 'No products selected for deletion.');
        }

        try {
            $products = Product::whereIn('id', $productIds)->get();
            $deletedCount = 0;
            
            foreach ($products as $product) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->delete();
                $deletedCount++;
            }

            return back()->with('success', $deletedCount . ' products deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete selected products. Please try again.');
        }
    }

    /**
     * Export products to CSV.
     */
    public function export()
    {
        try {
            $products = Product::all();
            
            if ($products->isEmpty()) {
                return back()->with('warning', 'No products found to export.');
            }
            
            $filename = "products_" . date('Y_m_d_H_i_s') . ".csv";
            $handle = fopen($filename, 'w+');
            
            // CSV header
            fputcsv($handle, [
                'Name', 'SKU', 'Category', 'Price', 'Cost Price', 'Quantity', 
                'Min Quantity', 'Status', 'Brand', 'Supplier', 'Created At'
            ]);
            
            // CSV data
            foreach ($products as $product) {
                fputcsv($handle, [
                    $product->name,
                    $product->sku,
                    $product->category ? $product->category->name : '',
                    $product->price,
                    $product->cost_price,
                    $product->quantity,
                    $product->min_quantity,
                    $product->status,
                    $product->brand ? $product->brand->name : '',
                    $product->supplier ? $product->supplier->name : '',
                    $product->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($handle);
            
            return response()->download($filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to export products. Please try again.');
        }
    }
}
