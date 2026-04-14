@extends('layouts.app')

@section('title', 'Product Details - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Product Details</h1>
                <p class="text-gray-600 mt-1">View and manage product information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Products
                </a>
                <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Product
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Product Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="flex items-start space-x-6">
                        <!-- Product Image -->
                        <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
                            @else
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @endif
                        </div>
                        
                        <!-- Product Details -->
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">{{ $product->name }}</h2>
                                    <p class="text-gray-600 mt-1">{{ $product->description ?: 'No description available' }}</p>
                                    <div class="flex items-center space-x-4 mt-3">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            {{ $product->category ? $product->category->name : 'No Category' }}
                                        </span>
                                        <span class="px-2 py-1 {{ $product->quantity <= 0 ? 'bg-red-100 text-red-800' : ($product->isLowStock() ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800') }} text-xs rounded-full">
                                            {{ $product->quantity <= 0 ? 'Out of Stock' : ($product->isLowStock() ? 'Low Stock' : 'In Stock') }}
                                        </span>
                                        <span class="text-sm text-gray-500">SKU: {{ $product->sku }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-gray-900">{{ $product->formatted_price }}</p>
                                    <p class="text-sm text-gray-500">Cost: {{ $product->formatted_cost_price }}</p>
                                    <p class="text-sm text-green-600">Margin: {{ number_format($product->profit_margin, 2) }}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Specifications -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Product Specifications</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Brand</p>
                                <p class="text-gray-900">{{ $product->brand ? $product->brand->name : 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Weight</p>
                                <p class="text-gray-900">{{ $product->weight ? $product->weight . ' kg' : 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Dimensions</p>
                                <p class="text-gray-900">{{ $product->dimensions ?: 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Barcode</p>
                                <p class="text-gray-900">{{ $product->barcode ?: 'Not specified' }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Supplier</p>
                                <p class="text-gray-900">{{ $product->supplier ? $product->supplier->name : 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Status</p>
                                <p class="text-gray-900">{{ ucfirst($product->status) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Created</p>
                                <p class="text-gray-900">{{ $product->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Last Updated</p>
                                <p class="text-gray-900">{{ $product->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($product->notes)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm font-medium text-gray-600 mb-2">Notes</p>
                            <p class="text-gray-900">{{ $product->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Inventory Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Inventory Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-16 h-16 {{ $product->quantity <= 0 ? 'bg-red-100' : ($product->isLowStock() ? 'bg-orange-100' : 'bg-green-100') }} rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 {{ $product->quantity <= 0 ? 'text-red-600' : ($product->isLowStock() ? 'text-orange-600' : 'text-green-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-900">{{ $product->quantity }}</p>
                            <p class="text-sm text-gray-600">Current Stock</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-900">{{ $product->min_quantity }}</p>
                            <p class="text-sm text-gray-600">Minimum Stock</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($product->price * $product->quantity, 0) }}</p>
                            <p class="text-sm text-gray-600">Total Value</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Last Updated</p>
                                <p class="text-gray-900">{{ $product->updated_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                            <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Update Stock
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('products.edit', $product->id) }}" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Product
                    </a>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="inline" onsubmit="handleDeleteProduct(event, '{{ $product->name }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Product
                        </button>
                    </form>
                    <a href="{{ route('products.export') }}" class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export Data
                    </a>
                </div>
            </div>

            <!-- Product Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Product Status</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Status</span>
                        <span class="px-2 py-1 {{ $product->status == 'active' ? 'bg-green-100 text-green-800' : ($product->status == 'inactive' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }} text-xs rounded-full">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Stock Level</span>
                        <span class="text-sm {{ $product->quantity <= 0 ? 'text-red-600' : ($product->isLowStock() ? 'text-orange-600' : 'text-green-600') }}">
                            {{ $product->quantity <= 0 ? 'Out of Stock' : ($product->isLowStock() ? 'Low Stock' : 'In Stock') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Profit Margin</span>
                        <span class="text-sm text-gray-600">{{ number_format($product->profit_margin, 2) }}%</span>
                    </div>
                </div>
            </div>

            <!-- Stock Alert -->
            @if($product->isLowStock())
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-orange-800">Low Stock Alert</h3>
                            <p class="text-xs text-orange-700 mt-1">Current stock ({{ $product->quantity }}) is below minimum level ({{ $product->min_quantity }})</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Sales History Section -->
    <div class="mt-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Sales History</h3>
                    <span class="text-sm text-gray-500">{{ $saleItems->count() }} sales found</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if($saleItems->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sale #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($saleItems as $saleItem)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">{{ $saleItem->sale->sale_number }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $saleItem->sale->customer_name }}</div>
                                        @if($saleItem->sale->customer_phone)
                                            <div class="text-xs text-gray-500">{{ $saleItem->sale->customer_phone }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $saleItem->quantity }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ App\Models\SystemSetting::getCurrencyCode() }} {{ number_format($saleItem->unit_price, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">{{ App\Models\SystemSetting::getCurrencyCode() }} {{ number_format($saleItem->total_price, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col space-y-1">
                                            <span class="text-xs">{{ $saleItem->sale->payment_status_label }}</span>
                                            <span class="text-xs text-gray-500">{{ ucfirst($saleItem->sale->payment_method) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $saleItem->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('sales.show', $saleItem->sale->id) }}" class="text-blue-600 hover:text-blue-900">View Sale</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="text-gray-500 mb-2">No sales found for this product</p>
                        <p class="text-xs text-gray-400">This product hasn't been sold yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// SweetAlert individual delete confirmation
window.handleDeleteProduct = function(event, productName) {
    event.preventDefault();
    
    Swal.fire({
        title: 'Delete Product?',
        text: `Are you sure you want to delete "${productName}"? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete product',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form
            event.target.closest('form').submit();
        }
    });
};
</script>
@endsection
