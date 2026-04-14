@extends('layouts.app')

@section('title', 'Product Pricing - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Product Pricing</h1>
                <p class="text-gray-600 mt-1">Manage product pricing based on customer type</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <a href="{{ route('sales.dashboard') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Pricing Settings -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pricing Settings</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Retail Markup Percentage</label>
                <div class="flex items-center space-x-2">
                    <input type="number" id="retail_markup" value="20" step="0.1" min="0" max="100" 
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="text-gray-600">%</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Markup percentage applied to retail customers</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Wholesale Markup Percentage</label>
                <div class="flex items-center space-x-2">
                    <input type="number" id="wholesale_markup" value="10" step="0.1" min="0" max="100" 
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="text-gray-600">%</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Markup percentage applied to wholesale customers</p>
            </div>
        </div>
        <div class="mt-4">
            <button onclick="savePricingSettings()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Save Settings
            </button>
        </div>
    </div>

    <!-- Product Pricing Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Product Pricing</h3>
                <div class="flex items-center space-x-2">
                    <input type="text" id="product_search_pricing" placeholder="Search products..." 
                           class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <select id="category_filter" onchange="filterProducts()" 
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach($products->pluck('category')->unique() as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Retail Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wholesale Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="products_tbody">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 product-row" 
                            data-name="{{ $product->name }}" 
                            data-category="{{ $product->category }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($product->image)
                                        <img class="h-10 w-10 rounded-full object-cover mr-3" 
                                             src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $product->brand ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $product->sku }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="number" class="cost-price-input w-24 px-2 py-1 border border-gray-300 rounded text-sm" 
                                       value="{{ $product->cost_price }}" step="0.01" min="0" 
                                       data-product-id="{{ $product->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <input type="number" class="retail-price-input w-24 px-2 py-1 border border-gray-300 rounded text-sm" 
                                           value="{{ $product->price }}" step="0.01" min="0" 
                                           data-product-id="{{ $product->id }}">
                                    <button onclick="calculateRetailPrice({{ $product->id }})" class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <input type="number" class="wholesale-price-input w-24 px-2 py-1 border border-gray-300 rounded text-sm" 
                                           value="{{ $product->price * 0.9 }}" step="0.01" min="0" 
                                           data-product-id="{{ $product->id }}">
                                    <button onclick="calculateWholesalePrice({{ $product->id }})" class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">{{ $product->category }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $product->quantity }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="updateProductPricing({{ $product->id }})" class="text-blue-600 hover:text-blue-900">Update</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bulk Pricing Actions -->
    <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Bulk Pricing Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Apply Markup to All Products</h4>
                <div class="flex items-center space-x-2">
                    <input type="number" id="bulk_markup" value="20" step="0.1" min="0" max="100" 
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="text-gray-600">%</span>
                    <button onclick="applyBulkMarkup('retail')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Apply to Retail
                    </button>
                    <button onclick="applyBulkMarkup('wholesale')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Apply to Wholesale
                    </button>
                </div>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Category-based Pricing</h4>
                <div class="flex items-center space-x-2">
                    <select id="category_select" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Category</option>
                        @foreach($products->pluck('category')->unique() as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    <input type="number" id="category_markup" value="20" step="0.1" min="0" max="100" 
                           class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="text-gray-600">%</span>
                    <button onclick="applyCategoryMarkup()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Pricing JavaScript
const products = @json($products);

// Product search
document.getElementById('product_search_pricing').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('.product-row');
    
    rows.forEach(row => {
        const name = row.dataset.name.toLowerCase();
        if (name.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Filter by category
function filterProducts() {
    const category = document.getElementById('category_filter').value;
    const rows = document.querySelectorAll('.product-row');
    
    rows.forEach(row => {
        if (!category || row.dataset.category === category) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Calculate retail price
function calculateRetailPrice(productId) {
    const costPrice = parseFloat(document.querySelector(`.cost-price-input[data-product-id="${productId}"]`).value) || 0;
    const markup = parseFloat(document.getElementById('retail_markup').value) || 20;
    const retailPrice = costPrice * (1 + markup / 100);
    
    document.querySelector(`.retail-price-input[data-product-id="${productId}"]`).value = retailPrice.toFixed(2);
}

// Calculate wholesale price
function calculateWholesalePrice(productId) {
    const costPrice = parseFloat(document.querySelector(`.cost-price-input[data-product-id="${productId}"]`).value) || 0;
    const markup = parseFloat(document.getElementById('wholesale_markup').value) || 10;
    const wholesalePrice = costPrice * (1 + markup / 100);
    
    document.querySelector(`.wholesale-price-input[data-product-id="${productId}"]`).value = wholesalePrice.toFixed(2);
}

// Update product pricing
function updateProductPricing(productId) {
    const costPrice = parseFloat(document.querySelector(`.cost-price-input[data-product-id="${productId}"]`).value) || 0;
    const retailPrice = parseFloat(document.querySelector(`.retail-price-input[data-product-id="${productId}"]`).value) || 0;
    const wholesalePrice = parseFloat(document.querySelector(`.wholesale-price-input[data-product-id="${productId}"]`).value) || 0;
    
    fetch(`/products/${productId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            cost_price: costPrice,
            price: retailPrice,
            wholesale_price: wholesalePrice
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product pricing updated successfully!');
        } else {
            alert('Error updating pricing: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating pricing');
    });
}

// Save pricing settings
function savePricingSettings() {
    const retailMarkup = document.getElementById('retail_markup').value;
    const wholesaleMarkup = document.getElementById('wholesale_markup').value;
    
    // Save to system settings (implement this as needed)
    localStorage.setItem('retail_markup', retailMarkup);
    localStorage.setItem('wholesale_markup', wholesaleMarkup);
    
    alert('Pricing settings saved successfully!');
}

// Apply bulk markup
function applyBulkMarkup(type) {
    const markup = parseFloat(document.getElementById('bulk_markup').value) || 0;
    const priceClass = type === 'retail' ? '.retail-price-input' : '.wholesale-price-input';
    
    document.querySelectorAll(priceClass).forEach(input => {
        const productId = input.dataset.productId;
        const costPrice = parseFloat(document.querySelector(`.cost-price-input[data-product-id="${productId}"]`).value) || 0;
        const newPrice = costPrice * (1 + markup / 100);
        input.value = newPrice.toFixed(2);
    });
    
    alert(`Bulk ${type} markup of ${markup}% applied to all products!`);
}

// Apply category markup
function applyCategoryMarkup() {
    const category = document.getElementById('category_select').value;
    const markup = parseFloat(document.getElementById('category_markup').value) || 0;
    
    if (!category) {
        alert('Please select a category');
        return;
    }
    
    document.querySelectorAll('.product-row').forEach(row => {
        if (row.dataset.category === category) {
            const productId = row.querySelector('.cost-price-input').dataset.productId;
            const costPrice = parseFloat(row.querySelector('.cost-price-input').value) || 0;
            const retailPrice = costPrice * (1 + markup / 100);
            const wholesalePrice = costPrice * (1 + (markup * 0.8 / 100)); // 80% of retail markup for wholesale
            
            row.querySelector('.retail-price-input').value = retailPrice.toFixed(2);
            row.querySelector('.wholesale-price-input').value = wholesalePrice.toFixed(2);
        }
    });
    
    alert(`Markup of ${markup}% applied to ${category} category!`);
}

// Load saved settings
document.addEventListener('DOMContentLoaded', function() {
    const savedRetailMarkup = localStorage.getItem('retail_markup');
    const savedWholesaleMarkup = localStorage.getItem('wholesale_markup');
    
    if (savedRetailMarkup) {
        document.getElementById('retail_markup').value = savedRetailMarkup;
    }
    if (savedWholesaleMarkup) {
        document.getElementById('wholesale_markup').value = savedWholesaleMarkup;
    }
});
</script>
@endsection
