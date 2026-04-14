@extends('layouts.app')

@section('title', 'Add Product - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Add New Product</h1>
                <p class="text-gray-600 mt-1">Create a new product for your inventory</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Products
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Product Information</h2>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Product Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="product_name" name="product_name" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Enter product name">
                            </div>
                            
                            <div>
                                <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">
                                    SKU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="sku" name="sku" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Auto-generated or manual">
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Enter product description"></textarea>
                        </div>

                        <!-- Category and Brand -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <select id="category" name="category" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select a category</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="food">Food & Beverages</option>
                                    <option value="home">Home & Garden</option>
                                    <option value="sports">Sports & Outdoors</option>
                                    <option value="furniture">Furniture</option>
                                    <option value="appliances">Appliances</option>
                                    <option value="books">Books & Media</option>
                                    <option value="toys">Toys & Games</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">
                                    Brand
                                </label>
                                <input type="text" id="brand" name="brand"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Enter brand name">
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-800 mb-4">Pricing Information</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                <div>
                                    <label for="cost_price" class="block text-sm font-medium text-gray-700 mb-1">
                                        Cost Price <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2.5 text-gray-500">$</span>
                                        <input type="number" id="cost_price" name="cost_price" required step="0.01" min="0"
                                               class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="0.00">
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-1">
                                        Selling Price <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2.5 text-gray-500">$</span>
                                        <input type="number" id="selling_price" name="selling_price" required step="0.01" min="0"
                                               class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="0.00">
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="profit_margin" class="block text-sm font-medium text-gray-700 mb-1">
                                        Profit Margin
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="profit_margin" name="profit_margin" readonly
                                               class="w-full pr-8 px-3 py-2 border border-gray-300 rounded-lg bg-gray-100"
                                               placeholder="0.00">
                                        <span class="absolute right-3 top-2.5 text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-800 mb-4">Inventory Management</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">
                                        Current Stock <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="stock_quantity" name="stock_quantity" required min="0"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="0">
                                </div>
                                
                                <div>
                                    <label for="min_stock" class="block text-sm font-medium text-gray-700 mb-1">
                                        Minimum Stock Level
                                    </label>
                                    <input type="number" id="min_stock" name="min_stock" min="0"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="10">
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="stock_location" class="block text-sm font-medium text-gray-700 mb-1">
                                    Stock Location
                                </label>
                                <input type="text" id="stock_location" name="stock_location"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="e.g., Warehouse A, Shelf 1">
                            </div>
                        </div>

                        <!-- Product Attributes -->
                        <div>
                            <h3 class="text-md font-medium text-gray-800 mb-4">Product Attributes</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">
                                        Weight (kg)
                                    </label>
                                    <input type="number" id="weight" name="weight" step="0.01" min="0"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="0.00">
                                </div>
                                
                                <div>
                                    <label for="dimensions" class="block text-sm font-medium text-gray-700 mb-1">
                                        Dimensions (L×W×H)
                                    </label>
                                    <input type="text" id="dimensions" name="dimensions"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="10×5×3">
                                </div>
                                
                                <div>
                                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">
                                        Color
                                    </label>
                                    <input type="text" id="color" name="color"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Black">
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Product Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="discontinued">Discontinued</option>
                            </select>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <button type="button" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Product Image -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Product Image</h3>
                </div>
                <div class="p-4">
                    <div class="flex flex-col items-center">
                        <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <button type="button" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                            Upload Image
                        </button>
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF (Max 5MB)</p>
                    </div>
                </div>
            </div>

            <!-- Product Tags -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Product Tags</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">New Arrival</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Best Seller</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Premium</span>
                        </div>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                               placeholder="Add tag and press Enter">
                        <p class="text-xs text-gray-500">Press Enter to add tags</p>
                    </div>
                </div>
            </div>

            <!-- Additional Settings -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Additional Settings</h3>
                </div>
                <div class="p-4 space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Track inventory</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Allow backorders</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Featured product</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Taxable</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-calculate profit margin
document.addEventListener('DOMContentLoaded', function() {
    const costPrice = document.getElementById('cost_price');
    const sellingPrice = document.getElementById('selling_price');
    const profitMargin = document.getElementById('profit_margin');

    function calculateMargin() {
        const cost = parseFloat(costPrice.value) || 0;
        const selling = parseFloat(sellingPrice.value) || 0;
        
        if (cost > 0 && selling > 0) {
            const margin = ((selling - cost) / cost * 100).toFixed(2);
            profitMargin.value = margin;
        } else {
            profitMargin.value = '';
        }
    }

    costPrice.addEventListener('input', calculateMargin);
    sellingPrice.addEventListener('input', calculateMargin);
});
</script>
@endsection
