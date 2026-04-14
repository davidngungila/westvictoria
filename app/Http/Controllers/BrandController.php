<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::when($request->search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        })
        ->when($request->status, function($query, $status) {
            $query->where('status', $status);
        })
        ->orderBy('sort_order')
        ->orderBy('name')
        ->paginate(10);

        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'website' => $request->website,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Check if request is AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Brand "' . $brand->name . '" created successfully.',
                'brand' => $brand,
                'redirect_url' => route('brands.index')
            ]);
        }

        return redirect()->route('brands.index')
            ->with('success', 'Brand "' . $brand->name . '" created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        $brand->load('products');
        return view('brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $brand->update([
            'name' => $request->name,
            'description' => $request->description,
            'website' => $request->website,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Check if request is AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Brand "' . $brand->name . '" updated successfully.',
                'brand' => $brand,
                'redirect_url' => route('brands.index')
            ]);
        }

        return redirect()->route('brands.index')
            ->with('success', 'Brand "' . $brand->name . '" updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Brand $brand)
    {
        // Check if brand has products
        if ($brand->products()->exists()) {
            $errorMessage = 'Cannot delete brand "' . $brand->name . '" because it has associated products.';
            
            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 422);
            }

            return redirect()->route('brands.index')
                ->with('error', $errorMessage);
        }

        $brandName = $brand->name;
        $brand->delete();

        // Check if request is AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Brand "' . $brandName . '" deleted successfully.',
                'redirect_url' => route('brands.index')
            ]);
        }

        return redirect()->route('brands.index')
            ->with('success', 'Brand "' . $brandName . '" deleted successfully.');
    }
}
