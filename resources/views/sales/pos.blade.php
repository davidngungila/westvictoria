@extends('layouts.app')

@section('title', 'Point of Sale - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Point of Sale</h1>
                <p class="text-gray-600 mt-1">Advanced POS system with real-time calculations</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <button onclick="generateInvoice()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Generate Invoice
                </button>
                <button onclick="generateReceipt()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a3 3 0 003 3h0a3 3 0 003-3v-1m-6 0h12m-6 0a2 2 0 01-2-2v-4a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2m0 0h-6"></path>
                    </svg>
                    Generate Receipt
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Panel - Product Selection -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h3>
                
                <!-- Customer Type Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer Type</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="customer_type" value="walk_in" checked class="mr-2" onchange="updateCustomerForm()">
                            <span class="text-sm">Walk-in Customer</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="customer_type" value="registered" class="mr-2" onchange="updateCustomerForm()">
                            <span class="text-sm">Registered Customer</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="customer_type" value="new" class="mr-2" onchange="updateCustomerForm()">
                            <span class="text-sm">New Customer</span>
                        </label>
                    </div>
                </div>
                
                <!-- Customer Details Form -->
                <div id="customer_details">
                    <!-- Walk-in Customer Form (Default) -->
                    <div id="walk_in_form" class="customer-form">
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                                    <input type="text" id="customer_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter customer name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" id="customer_phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter phone number">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="customer_email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter email address">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Registered Customer Form -->
                    <div id="registered_form" class="customer-form hidden">
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Customer</label>
                                    <div class="relative">
                                        <input type="text" id="customer_search" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search by name, phone, or email">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer ID</label>
                                    <input type="text" id="customer_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter customer ID">
                                </div>
                            </div>
                            
                            <!-- Customer Search Results -->
                            <div id="customer_search_results" class="hidden">
                                <div class="border border-gray-200 rounded-lg max-h-40 overflow-y-auto">
                                    <!-- Results will be populated here -->
                                </div>
                            </div>
                            
                            <!-- Selected Customer Details -->
                            <div id="selected_customer_details" class="hidden">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <h4 class="text-sm font-medium text-blue-800 mb-2">Selected Customer</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                                        <div><strong>Name:</strong> <span id="selected_name"></span></div>
                                        <div><strong>Phone:</strong> <span id="selected_phone"></span></div>
                                        <div><strong>Email:</strong> <span id="selected_email"></span></div>
                                        <div><strong>ID:</strong> <span id="selected_id"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- New Customer Form -->
                    <div id="new_form" class="customer-form hidden">
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name *</label>
                                    <input type="text" id="new_customer_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter customer name" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                    <input type="tel" id="new_customer_phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter phone number" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="new_customer_email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter email address">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                    <input type="text" id="new_customer_address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter address">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                    <input type="text" id="new_customer_city" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter city">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sale Type in same section -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-md font-semibold text-gray-800 mb-3">Sale Type</h4>
                    <div class="flex space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="sale_type" value="retail" checked class="mr-2" onchange="updatePricesForSaleType()">
                            <span class="text-sm">Retail Sale</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="sale_type" value="wholesale" class="mr-2" onchange="updatePricesForSaleType()">
                            <span class="text-sm">Wholesale Sale</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Product Search -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Product Search</h3>
                <div class="relative">
                    <input type="text" id="product_search" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search products by name, SKU, or barcode...">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Product Categories -->
                <div class="mt-4 flex flex-wrap gap-2">
                    <button onclick="filterCategory('all')" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200">All</button>
                    @foreach($products->pluck('category')->unique() as $category)
                        <button onclick="filterCategory('{{ $category }}')" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200">{{ $category }}</button>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Products</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="product_grid">
                    @foreach($products as $product)
                        @if($product->quantity > 0)
                            <div class="product-card border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all cursor-pointer" 
                                 onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->sku }}', {{ $product->quantity }})"
                                 data-category="{{ $product->category }}"
                                 data-name="{{ $product->name }}"
                                 data-sku="{{ $product->sku }}">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ $product->sku }}</span>
                                    <span class="text-xs text-gray-500">Stock: {{ $product->quantity }}</span>
                                </div>
                                <h4 class="font-medium text-gray-900 mb-1">{{ $product->name }}</h4>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-blue-600">{{ App\Models\SystemSetting::getCurrencyCode() }} {{ number_format($product->price, 2) }}</span>
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                @if($products->where('quantity', '>', 0)->count() === 0)
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-gray-500">No products available for sale</p>
                        <p class="text-sm text-gray-400 mt-2">All products are currently out of stock</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Panel - Cart and Checkout -->
        <div class="space-y-6">
            <!-- Cart -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Shopping Cart</h3>
                    <button onclick="clearCart()" class="text-red-600 hover:text-red-800 text-sm">Clear</button>
                </div>
                
                <div id="cart_items" class="space-y-3 max-h-96 overflow-y-auto">
                    <!-- Cart items will be added here dynamically -->
                    <div class="text-center text-gray-500 py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p>No items in cart</p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span id="subtotal" class="font-medium">{{ App\Models\SystemSetting::getCurrencyCode() }} 0.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Discount</span>
                        <span id="discount" class="font-medium text-red-600">{{ App\Models\SystemSetting::getCurrencyCode() }} 0.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Tax ({{ App\Models\SystemSetting::isTaxEnabled() ? App\Models\SystemSetting::getTaxRate() : 0 }}%)</span>
                        <span id="tax" class="font-medium">{{ App\Models\SystemSetting::getCurrencyCode() }} 0.00</span>
                    </div>
                    <div class="border-t pt-3">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span id="total" class="text-blue-600">{{ App\Models\SystemSetting::getCurrencyCode() }} 0.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Method</h3>
                
                <!-- Payment Methods List -->
                <div id="payment_methods_list" class="space-y-3 mb-4">
                    <!-- Default Cash Payment Method -->
                    <div class="payment-method-item border rounded-lg p-3 bg-blue-50" data-method="cash">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <select class="payment-method-select mr-3 px-3 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="cash" selected>Cash</option>
                                    <option value="card">Card</option>
                                    <option value="mobile_money">Mobile Money</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="credit">Credit (Loan)</option>
                                </select>
                                <span class="text-sm font-medium">Cash</span>
                            </div>
                            <button onclick="removePaymentMethod(this)" class="text-red-600 hover:text-red-800 hidden">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="payment-amount-section">
                            <input type="number" placeholder="Amount" step="0.01" min="0" 
                                   class="payment-amount-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
                
                <!-- Add Payment Method Button -->
                <button onclick="addPaymentMethod()" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Payment Method
                </button>
                
                <!-- Payment Summary -->
                <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Amount:</span>
                        <span id="total_amount_display" class="text-sm font-bold">{{ \App\Models\SystemSetting::getCurrencyCode() }} 0.00</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-sm text-gray-600">Payment Amount:</span>
                        <span id="payment_amount_display" class="text-sm font-bold">{{ \App\Models\SystemSetting::getCurrencyCode() }} 0.00</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-sm text-gray-600">Balance:</span>
                        <span id="balance_display" class="text-sm font-bold text-red-600">{{ \App\Models\SystemSetting::getCurrencyCode() }} 0.00</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-sm text-gray-600">Payment Status:</span>
                        <span id="payment_status_display" class="text-sm font-bold text-red-600">Unpaid</span>
                    </div>
                </div>
            </div>

            <!-- Checkout Button -->
            <button onclick="processSale()" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                Process Sale
            </button>
        </div>
    </div>
</div>

<!-- Invoice Modal -->
<div id="invoiceModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto m-4">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Invoice</h3>
                <button onclick="closeInvoiceModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="invoiceContent" class="p-6">
            <!-- Invoice content will be generated here -->
        </div>
    </div>
</div>

<!-- Receipt Modal -->
<div id="receiptModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-md w-full m-4">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Receipt</h3>
                <button onclick="closeReceiptModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="receiptContent" class="p-6">
            <!-- Receipt content will be generated here -->
        </div>
    </div>
</div>

<script>
// POS JavaScript
let cart = [];
const taxRate = {{ App\Models\SystemSetting::isTaxEnabled() ? App\Models\SystemSetting::getTaxRate() : 0 }};
const currencyCode = '{{ App\Models\SystemSetting::getCurrencyCode() }}';
const products = @json($products);

// Product search
document.getElementById('product_search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        const name = card.dataset.name.toLowerCase();
        const sku = card.dataset.sku.toLowerCase();
        
        if (name.includes(searchTerm) || sku.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Filter by category
function filterCategory(category) {
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
    
    // Update button styles
    const buttons = document.querySelectorAll('button[onclick^="filterCategory"]');
    buttons.forEach(btn => {
        if (btn.textContent.toLowerCase().includes(category.toLowerCase()) || (category === 'all' && btn.textContent.includes('All'))) {
            btn.className = 'px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200';
        } else {
            btn.className = 'px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200';
        }
    });
}

// Update customer form based on selected customer type
function updateCustomerForm() {
    const customerType = document.querySelector('input[name="customer_type"]:checked').value;
    
    // Hide all customer forms
    document.querySelectorAll('.customer-form').forEach(form => {
        form.classList.add('hidden');
    });
    
    // Show the selected form
    document.getElementById(`${customerType}_form`).classList.remove('hidden');
    
    // Clear search results when switching forms
    document.getElementById('customer_search_results').classList.add('hidden');
    document.getElementById('selected_customer_details').classList.add('hidden');
}

// Search for registered customers
function searchCustomers(query) {
    if (query.length < 2) {
        document.getElementById('customer_search_results').classList.add('hidden');
        return;
    }
    
    // Use real API endpoint for customer search
    fetch(`/api/customers/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(customers => {
            displayCustomerResults(customers);
        })
        .catch(error => {
            console.error('Error searching customers:', error);
            // Fallback to mock data if API fails
            const mockCustomers = [
                { id: 1, name: 'John Doe', phone: '0712345678', email: 'john@example.com', customer_id: 'CUST-001' },
                { id: 2, name: 'Jane Smith', phone: '0723456789', email: 'jane@example.com', customer_id: 'CUST-002' },
                { id: 3, name: 'Bob Johnson', phone: '0734567890', email: 'bob@example.com', customer_id: 'CUST-003' }
            ];
            
            const filteredCustomers = mockCustomers.filter(customer => 
                customer.name.toLowerCase().includes(query.toLowerCase()) ||
                customer.phone.includes(query) ||
                customer.email.toLowerCase().includes(query.toLowerCase())
            );
            
            displayCustomerResults(filteredCustomers);
        });
}

// Display customer search results
function displayCustomerResults(customers) {
    const resultsContainer = document.getElementById('customer_search_results');
    const resultsList = resultsContainer.querySelector('div');
    
    if (customers.length === 0) {
        resultsContainer.classList.add('hidden');
        return;
    }
    
    resultsList.innerHTML = customers.map(customer => `
        <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0" onclick="selectCustomer(${customer.id}, '${customer.name}', '${customer.phone}', '${customer.email}', '${customer.customer_id}')">
            <div class="text-sm font-medium text-gray-900">${customer.name} (${customer.customer_id})</div>
            <div class="text-xs text-gray-500">${customer.phone} | ${customer.email}</div>
        </div>
    `).join('');
    
    resultsContainer.classList.remove('hidden');
}

// Select a customer from search results
function selectCustomer(id, name, phone, email, customerId) {
    // Update selected customer details
    document.getElementById('selected_name').textContent = name;
    document.getElementById('selected_phone').textContent = phone;
    document.getElementById('selected_email').textContent = email;
    document.getElementById('selected_id').textContent = customerId;
    
    // Update main customer fields
    document.getElementById('customer_name').value = name;
    document.getElementById('customer_phone').value = phone;
    document.getElementById('customer_email').value = email;
    
    // Show selected customer details and hide search results
    document.getElementById('selected_customer_details').classList.remove('hidden');
    document.getElementById('customer_search_results').classList.add('hidden');
    
    // Clear search input
    document.getElementById('customer_search').value = '';
}

// Initialize customer search
document.addEventListener('DOMContentLoaded', function() {
    const customerSearchInput = document.getElementById('customer_search');
    if (customerSearchInput) {
        customerSearchInput.addEventListener('input', function() {
            searchCustomers(this.value);
        });
        
        // Clear search results on blur
        customerSearchInput.addEventListener('blur', function() {
            setTimeout(() => {
                document.getElementById('customer_search_results').classList.add('hidden');
            }, 200);
        });
    }
});

// Update prices based on sale type
function updatePricesForSaleType() {
    const saleType = document.querySelector('input[name="sale_type"]:checked').value;
    console.log('Sale type changed to:', saleType);
    
    // Update cart prices if items are in cart
    if (cart.length > 0) {
        // For now, we'll just update the cart display
        // In a real implementation, you'd fetch wholesale prices from the server
        updateCart();
        
        // Show notification about price update
        Swal.fire({
            icon: 'info',
            title: 'Sale Type Changed',
            text: `Prices updated for ${saleType === 'wholesale' ? 'Wholesale' : 'Retail'} sale`,
            timer: 2000,
            showConfirmButton: false
        });
    }
}

// Add to cart
function addToCart(productId, productName, price, sku, stock) {
    const existingItem = cart.find(item => item.productId === productId);
    
    if (existingItem) {
        if (existingItem.quantity < stock) {
            existingItem.quantity++;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Insufficient Stock',
                text: 'Only ' + stock + ' items available in stock',
                confirmButtonColor: '#3B82F6'
            });
            return;
        }
    } else {
        cart.push({
            productId: productId,
            name: productName,
            price: price,
            sku: sku,
            quantity: 1,
            stock: stock
        });
    }
    
    updateCart();
    
    // Additional auto-fill trigger to ensure payment amount updates
    setTimeout(() => {
        const totalText = document.getElementById('total').textContent;
        const total = parseFloat(totalText.replace(/[^0-9.-]/g, '')) || 0;
        console.log('addToCart - Total after update:', total); // Debug log
        
        const firstPaymentItem = document.querySelector('.payment-method-item');
        if (firstPaymentItem) {
            const method = firstPaymentItem.dataset.method;
            const amountInput = firstPaymentItem.querySelector('.payment-amount-input');
            
            if (method !== 'credit' && amountInput) {
                amountInput.value = total.toFixed(2);
                console.log('addToCart - Auto-filled payment amount:', amountInput.value); // Debug log
                
                // Trigger input event to update payment summary
                const event = new Event('input', { bubbles: true });
                amountInput.dispatchEvent(event);
            }
        }
    }, 100);
}

// Update cart display
function updateCart() {
    const cartContainer = document.getElementById('cart_items');
    
    if (cart.length === 0) {
        cartContainer.innerHTML = '<p class="text-gray-500 text-center py-4">No items in cart</p>';
        document.getElementById('subtotal').textContent = 'TZS 0.00';
        document.getElementById('discount').textContent = 'TZS 0.00';
        document.getElementById('tax').textContent = 'TZS 0.00';
        document.getElementById('total').textContent = 'TZS 0.00';
        updatePaymentSummary();
        return;
    }
    
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += item.price * item.quantity;
    });
    
    const discount = 0; // Can be enhanced later
    const afterDiscount = subtotal - discount;
    const tax = afterDiscount * (taxRate / 100);
    const total = afterDiscount + tax;
    
    document.getElementById('subtotal').textContent = `${currencyCode} ${subtotal.toFixed(2)}`;
    document.getElementById('discount').textContent = `${currencyCode} ${discount.toFixed(2)}`;
    document.getElementById('tax').textContent = `${currencyCode} ${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `${currencyCode} ${total.toFixed(2)}`;
    
    updatePaymentSummary();
}

// Update payment summary
function updatePaymentSummary() {
    const totalText = document.getElementById('total').textContent;
    const total = parseFloat(totalText.replace(/[^0-9.-]/g, '')) || 0;
    
    // Calculate total payment amount from all payment methods
    let totalPaymentAmount = 0;
    const paymentItems = document.querySelectorAll('.payment-method-item');
    
    paymentItems.forEach(item => {
        const method = item.dataset.method;
        const amountInput = item.querySelector('.payment-amount-input');
        const amount = parseFloat(amountInput?.value) || 0;
        
        if (method !== 'credit') {
            totalPaymentAmount += amount;
        }
    });
    
    const balance = total - totalPaymentAmount;
    let paymentStatus = 'Unpaid';
    
    if (totalPaymentAmount >= total) {
        paymentStatus = 'Paid';
    } else if (totalPaymentAmount > 0) {
        paymentStatus = 'Partial';
    }
    
    // Update displays
    document.getElementById('total_amount_display').textContent = `${currencyCode} ${total.toFixed(2)}`;
    document.getElementById('payment_amount_display').textContent = `${currencyCode} ${totalPaymentAmount.toFixed(2)}`;
    document.getElementById('balance_display').textContent = `${currencyCode} ${Math.abs(balance).toFixed(2)}`;
    
    const statusDisplay = document.getElementById('payment_status_display');
    statusDisplay.textContent = paymentStatus;
    
    // Update status color
    statusDisplay.className = 'text-sm font-bold';
    if (paymentStatus === 'Paid') {
        statusDisplay.classList.add('text-green-600');
    } else if (paymentStatus === 'Partial') {
        statusDisplay.classList.add('text-yellow-600');
    } else {
        statusDisplay.classList.add('text-red-600');
    }
}

// Add new payment method
function addPaymentMethod() {
    const paymentMethodsList = document.getElementById('payment_methods_list');
    const currentCount = paymentMethodsList.querySelectorAll('.payment-method-item').length;
    
    if (currentCount >= 5) {
        Swal.fire({
            icon: 'warning',
            title: 'Maximum Payment Methods',
            text: 'You can add up to 5 payment methods.',
            confirmButtonColor: '#3B82F6'
        });
        return;
    }
    
    const newPaymentMethod = document.createElement('div');
    newPaymentMethod.className = 'payment-method-item border rounded-lg p-3 bg-gray-50';
    newPaymentMethod.dataset.method = 'cash';
    
    // Get current total for auto-fill
    const totalText = document.getElementById('total').textContent;
    const total = parseFloat(totalText.replace(/[^0-9.-]/g, '')) || 0;
    
    newPaymentMethod.innerHTML = `
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center">
                <select class="payment-method-select mr-3 px-3 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="cash" selected>Cash</option>
                    <option value="card">Card</option>
                    <option value="mobile_money">Mobile Money</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="credit">Credit (Loan)</option>
                </select>
                <span class="text-sm font-medium">Cash</span>
            </div>
            <button onclick="removePaymentMethod(this)" class="text-red-600 hover:text-red-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="payment-amount-section">
            <input type="number" placeholder="Amount" step="0.01" min="0" 
                   class="payment-amount-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="${total > 0 ? total.toFixed(2) : ''}">
        </div>
    `;
    
    paymentMethodsList.appendChild(newPaymentMethod);
    attachPaymentMethodListeners(newPaymentMethod);
    updatePaymentSummary();
}

// Remove payment method
function removePaymentMethod(button) {
    const paymentItem = button.closest('.payment-method-item');
    const paymentMethodsList = document.getElementById('payment_methods_list');
    
    // Don't remove if it's the only payment method
    if (paymentMethodsList.querySelectorAll('.payment-method-item').length <= 1) {
        Swal.fire({
            icon: 'warning',
            title: 'Cannot Remove',
            text: 'You must have at least one payment method.',
            confirmButtonColor: '#3B82F6'
        });
        return;
    }
    
    paymentItem.remove();
    updatePaymentSummary();
}

// Attach event listeners to payment method
function attachPaymentMethodListeners(paymentMethodItem) {
    const select = paymentMethodItem.querySelector('.payment-method-select');
    const amountInput = paymentMethodItem.querySelector('.payment-amount-input');
    const label = paymentMethodItem.querySelector('.text-sm.font-medium');
    const amountSection = paymentMethodItem.querySelector('.payment-amount-section');
    
    // Function to auto-fill total amount
    const autoFillTotal = () => {
        const totalText = document.getElementById('total').textContent;
        const total = parseFloat(totalText.replace(/[^0-9.-]/g, '')) || 0;
        console.log('Auto-filling total:', total); // Debug log
        if (total > 0) {
            amountInput.value = total.toFixed(2);
            console.log('Set amount input to:', amountInput.value); // Debug log
        }
    };
    
    // Handle payment method change
    select.addEventListener('change', function() {
        const selectedMethod = this.value;
        paymentMethodItem.dataset.method = selectedMethod;
        label.textContent = this.options[this.selectedIndex].text;
        
        // Show/hide amount input based on method
        if (selectedMethod === 'credit') {
            amountSection.style.display = 'none';
            amountInput.value = '0';
        } else {
            amountSection.style.display = 'block';
            // Auto-fill total amount if field is empty or zero
            const currentAmount = parseFloat(amountInput.value) || 0;
            if (currentAmount === 0) {
                autoFillTotal();
            }
        }
        
        updatePaymentSummary();
    });
    
    // Handle amount input
    amountInput.addEventListener('input', function() {
        updatePaymentSummary();
    });
    
    // Auto-fill total amount on initial load if empty
    const currentAmount = parseFloat(amountInput.value) || 0;
    if (currentAmount === 0) {
        setTimeout(autoFillTotal, 100); // Small delay to ensure total is calculated
    }
}

// Update cart display
function updateCart() {
    const cartContainer = document.getElementById('cart_items');
    
    if (cart.length === 0) {
        cartContainer.innerHTML = '<p class="text-gray-500 text-center py-4">No items in cart</p>';
        document.getElementById('subtotal').textContent = 'TZS 0.00';
        document.getElementById('discount').textContent = 'TZS 0.00';
        document.getElementById('tax').textContent = 'TZS 0.00';
        document.getElementById('total').textContent = 'TZS 0.00';
        updatePaymentSummary();
        return;
    }
    
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += item.price * item.quantity;
    });
    
    const discount = 0; // Can be enhanced later
    const afterDiscount = subtotal - discount;
    const tax = afterDiscount * (taxRate / 100);
    const total = afterDiscount + tax;
    
    document.getElementById('subtotal').textContent = `${currencyCode} ${subtotal.toFixed(2)}`;
    document.getElementById('discount').textContent = `${currencyCode} ${discount.toFixed(2)}`;
    document.getElementById('tax').textContent = `${currencyCode} ${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `${currencyCode} ${total.toFixed(2)}`;
    
    console.log('Cart updated - Total:', total); // Debug log
    
    // Auto-fill payment amounts with new total - more aggressive approach
    const paymentItems = document.querySelectorAll('.payment-method-item');
    console.log('Found payment items:', paymentItems.length); // Debug log
    
    paymentItems.forEach((item, index) => {
        const method = item.dataset.method;
        const amountInput = item.querySelector('.payment-amount-input');
        
        console.log(`Payment item ${index}: method=${method}, amountInput=${amountInput}`); // Debug log
        
        if (method !== 'credit' && amountInput) {
            // Always auto-fill the first payment method, others only if empty
            const currentAmount = parseFloat(amountInput.value) || 0;
            console.log(`Payment method ${method}, current amount: ${currentAmount}, total: ${total}`); // Debug log
            
            if (index === 0 || currentAmount === 0) {
                amountInput.value = total.toFixed(2);
                console.log(`Auto-filled ${method} with: ${amountInput.value}`); // Debug log
                
                // Trigger input event to ensure payment summary updates
                const event = new Event('input', { bubbles: true });
                amountInput.dispatchEvent(event);
            }
        }
    });
    
    updatePaymentSummary();
    
    // Additional call to ensure payment status is updated after auto-fill
    setTimeout(() => {
        updatePaymentSummary();
    }, 100);
    
    cartContainer.innerHTML = cart.map((item, index) => `
        <div class="border border-gray-200 rounded-lg p-3">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h4 class="font-medium text-gray-900">${item.name}</h4>
                    <p class="text-xs text-gray-500">${item.sku}</p>
                </div>
                <button onclick="removeFromCart(${index})" class="text-red-600 hover:text-red-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <button onclick="updateQuantity(${index}, -1)" class="w-6 h-6 bg-gray-200 rounded flex items-center justify-center hover:bg-gray-300">-</button>
                    <span class="w-8 text-center">${item.quantity}</span>
                    <button onclick="updateQuantity(${index}, 1)" class="w-6 h-6 bg-gray-200 rounded flex items-center justify-center hover:bg-gray-300">+</button>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium text-gray-900">${currencyCode} ${(item.price * item.quantity).toFixed(2)}</div>
                    <div class="text-xs text-gray-500">${currencyCode} ${item.price.toFixed(2)} each</div>
                </div>
            </div>
        </div>
    `).join('');
}

// Update quantity
function updateQuantity(index, change) {
    const item = cart[index];
    const newQuantity = item.quantity + change;
    
    if (newQuantity > 0 && newQuantity <= item.stock) {
        item.quantity = newQuantity;
        updateCart();
    } else if (newQuantity > item.stock) {
        alert('Insufficient stock available');
    }
}

// Remove from cart
function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
}

// Clear cart
function clearCart() {
    if (cart.length > 0 && confirm('Are you sure you want to clear the cart?')) {
        cart = [];
        updateCart();
    }
}

// Update totals
function updateTotals() {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const discount = 0; // Can be implemented later
    const afterDiscount = subtotal - discount;
    const tax = afterDiscount * (taxRate / 100);
    const total = afterDiscount + tax;
    
    document.getElementById('subtotal').textContent = `${currencyCode} ${subtotal.toFixed(2)}`;
    document.getElementById('discount').textContent = `${currencyCode} ${discount.toFixed(2)}`;
    document.getElementById('tax').textContent = `${currencyCode} ${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `${currencyCode} ${total.toFixed(2)}`;
}

// Process sale
function processSale() {
    if (cart.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Cart Empty',
            text: 'Please add items to the cart before processing sale',
            confirmButtonColor: '#3B82F6'
        });
        return;
    }
    
    // Get customer information based on customer type
    const customerType = document.querySelector('input[name="customer_type"]:checked').value;
    let customerName, customerPhone, customerEmail;
    
    switch(customerType) {
        case 'walk_in':
            customerName = document.getElementById('customer_name').value;
            customerPhone = document.getElementById('customer_phone').value;
            customerEmail = document.getElementById('customer_email').value;
            break;
            
        case 'registered':
            // Use selected registered customer info
            customerName = document.getElementById('customer_name').value;
            customerPhone = document.getElementById('customer_phone').value;
            customerEmail = document.getElementById('customer_email').value;
            
            // Check if a registered customer is selected
            if (!customerName || !document.getElementById('selected_customer_details').classList.contains('hidden') === false) {
                const selectedId = document.getElementById('selected_id').textContent;
                if (!selectedId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing Customer',
                        text: 'Please select a registered customer',
                        confirmButtonColor: '#3B82F6'
                    });
                    return;
                }
            }
            break;
            
        case 'new':
            customerName = document.getElementById('new_customer_name').value;
            customerPhone = document.getElementById('new_customer_phone').value;
            customerEmail = document.getElementById('new_customer_email').value;
            
            // Validate required fields for new customer
            if (!customerName || !customerPhone) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Information',
                    text: 'Please fill in required fields for new customer',
                    confirmButtonColor: '#3B82F6'
                });
                return;
            }
            break;
            
        default:
            customerName = document.getElementById('customer_name').value;
            customerPhone = document.getElementById('customer_phone').value;
            customerEmail = document.getElementById('customer_email').value;
    }
    
    if (!customerName) {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please enter customer name',
            confirmButtonColor: '#3B82F6'
        });
        return;
    }
    
    // Show loading
    Swal.fire({
        title: 'Processing Sale...',
        text: 'Please wait while we process your sale',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Prepare sale data
    const paymentMethods = [];
    let totalPaymentAmount = 0;
    const paymentItems = document.querySelectorAll('.payment-method-item');
    
    paymentItems.forEach(item => {
        const method = item.dataset.method;
        const amountInput = item.querySelector('.payment-amount-input');
        const amount = parseFloat(amountInput?.value) || 0;
        
        if (method !== 'credit' && amount > 0) {
            paymentMethods.push({
                method: method,
                amount: amount
            });
            totalPaymentAmount += amount;
        } else if (method === 'credit') {
            paymentMethods.push({
                method: method,
                amount: 0
            });
        }
    });
    
    // Determine primary payment method for the sale record
    let primaryPaymentMethod = 'cash';
    if (paymentMethods.length > 0) {
        primaryPaymentMethod = paymentMethods[0].method;
    }
    
    const saleData = {
        customer_name: customerName,
        customer_email: document.getElementById('customer_email').value,
        customer_phone: document.getElementById('customer_phone').value,
        sale_type: document.querySelector('input[name="sale_type"]:checked').value,
        payment_method: primaryPaymentMethod,
        payment_amount: totalPaymentAmount,
        payment_methods: paymentMethods, // Send all payment methods
        items: cart.map(item => ({
            product_id: item.productId,
            quantity: item.quantity,
            unit_price: item.price,
            discount_percentage: 0
        }))
    };
    
    // Submit sale via AJAX
    // Get CSRF token safely
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Configuration Error',
            text: 'CSRF token not found. Please refresh the page.',
            confirmButtonColor: '#EF4444'
        });
        return;
    }
    
    fetch('/sales', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify(saleData)
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success) {
            let successMessage = `Sale #${data.sale_number} has been created`;
            let showInvoiceOption = false;
            
            // Check if this was a credit sale by checking payment methods
            const paymentItems = document.querySelectorAll('.payment-method-item');
            let hasCreditPayment = false;
            
            paymentItems.forEach(item => {
                if (item.dataset.method === 'credit') {
                    hasCreditPayment = true;
                }
            });
            
            if (hasCreditPayment) {
                successMessage += '\nInvoice generated for credit payment.';
                showInvoiceOption = true;
            }
            
            Swal.fire({
                icon: 'success',
                title: 'Sale Processed Successfully!',
                text: successMessage,
                confirmButtonColor: '#10B981',
                showCancelButton: true,
                confirmButtonText: 'View Sale',
                cancelButtonText: 'New Sale'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/sales/${data.sale_id}`;
                } else {
                    // Reset for new sale
                    cart = [];
                    updateCart();
                    // Clear customer info
                    document.getElementById('customer_name').value = '';
                    document.getElementById('customer_email').value = '';
                    document.getElementById('customer_phone').value = '';
                    // Clear payment amounts
                    ['cash', 'card', 'mobile_money', 'bank_transfer'].forEach(method => {
                        const input = document.getElementById(`${method}_amount`);
                        if (input) input.value = '';
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error Processing Sale',
                text: data.message || 'An error occurred while processing the sale',
                confirmButtonColor: '#EF4444'
            });
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        Swal.close();
        
        // More specific error messages
        let errorMessage = 'An error occurred while processing the sale';
        
        if (error.message.includes('HTTP error! status: 419')) {
            errorMessage = 'Session expired. Please refresh the page and try again.';
        } else if (error.message.includes('HTTP error! status: 422')) {
            errorMessage = 'Validation error. Please check all required fields.';
        } else if (error.message.includes('HTTP error! status: 500')) {
            errorMessage = 'Server error. Please try again later.';
        } else if (error.message.includes('Failed to fetch')) {
            errorMessage = 'Network error. Please check your connection and try again.';
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Error Processing Sale',
            text: errorMessage,
            confirmButtonColor: '#EF4444'
        });
    });
}

// Generate invoice
function generateInvoice() {
    if (cart.length === 0) {
        alert('Please add items to the cart first');
        return;
    }
    
    const customerName = document.getElementById('customer_name').value || 'Customer';
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = subtotal * (taxRate / 100);
    const total = subtotal + tax;
    
    const invoiceHTML = `
        <div class="space-y-6">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900">INVOICE</h2>
                <p class="text-gray-600">{{ App\Models\SystemSetting::getCompanyName() }}</p>
                <p class="text-sm text-gray-500">Date: ${new Date().toLocaleDateString()}</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Bill To:</h3>
                    <p class="text-gray-600">${customerName}</p>
                    ${document.getElementById('customer_phone').value ? `<p class="text-gray-600">${document.getElementById('customer_phone').value}</p>` : ''}
                    ${document.getElementById('customer_email').value ? `<p class="text-gray-600">${document.getElementById('customer_email').value}</p>` : ''}
                </div>
                <div class="text-right">
                    <p class="text-gray-600">Invoice #: INV-${Date.now()}</p>
                    <p class="text-gray-600">Date: ${new Date().toLocaleDateString()}</p>
                </div>
            </div>
            
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">Product</th>
                        <th class="text-center py-2">Qty</th>
                        <th class="text-right py-2">Price</th>
                        <th class="text-right py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    ${cart.map(item => `
                        <tr class="border-b">
                            <td class="py-2">${item.name}</td>
                            <td class="text-center py-2">${item.quantity}</td>
                            <td class="text-right py-2">${currencyCode} ${item.price.toFixed(2)}</td>
                            <td class="text-right py-2">${currencyCode} ${(item.price * item.quantity).toFixed(2)}</td>
                        </tr>
                    `).join('')}
                </tbody>
                <tfoot>
                    <tr class="border-t">
                        <td colspan="3" class="py-2 text-right">Subtotal:</td>
                        <td class="text-right py-2">${currencyCode} ${subtotal.toFixed(2)}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 text-right">Tax (${taxRate}%):</td>
                        <td class="text-right py-2">${currencyCode} ${tax.toFixed(2)}</td>
                    </tr>
                    <tr class="font-bold">
                        <td colspan="3" class="py-2 text-right">Total:</td>
                        <td class="text-right py-2">${currencyCode} ${total.toFixed(2)}</td>
                    </tr>
                </tfoot>
            </table>
            
            <div class="flex justify-end space-x-3">
                <button onclick="printInvoice()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Print</button>
                <button onclick="downloadInvoice()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Download</button>
            </div>
        </div>
    `;
    
    document.getElementById('invoiceContent').innerHTML = invoiceHTML;
    document.getElementById('invoiceModal').classList.remove('hidden');
}

// Generate receipt
function generateReceipt() {
    if (cart.length === 0) {
        alert('Please add items to the cart first');
        return;
    }
    
    const customerName = document.getElementById('customer_name').value || 'Customer';
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = subtotal * (taxRate / 100);
    const total = subtotal + tax;
    
    const receiptHTML = `
        <div class="space-y-4">
            <div class="text-center">
                <h2 class="text-xl font-bold text-gray-900">{{ App\Models\SystemSetting::getCompanyName() }}</h2>
                <p class="text-sm text-gray-600">RECEIPT</p>
                <p class="text-xs text-gray-500">${new Date().toLocaleString()}</p>
            </div>
            
            <div class="border-t border-b py-2">
                <p class="text-sm"><strong>Customer:</strong> ${customerName}</p>
                <p class="text-sm"><strong>Receipt #: </strong> RCP-${Date.now()}</p>
            </div>
            
            <div class="space-y-1">
                ${cart.map(item => `
                    <div class="flex justify-between text-sm">
                        <div>
                            <p class="font-medium">${item.name}</p>
                            <p class="text-xs text-gray-500">${item.quantity} x ${currencyCode} ${item.price.toFixed(2)}</p>
                        </div>
                        <p class="font-medium">${currencyCode} ${(item.price * item.quantity).toFixed(2)}</p>
                    </div>
                `).join('')}
            </div>
            
            <div class="border-t pt-2 space-y-1">
                <div class="flex justify-between text-sm">
                    <span>Subtotal:</span>
                    <span>${currencyCode} ${subtotal.toFixed(2)}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span>Tax (${taxRate}%):</span>
                    <span>${currencyCode} ${tax.toFixed(2)}</span>
                </div>
                <div class="flex justify-between font-bold text-lg">
                    <span>Total:</span>
                    <span>${currencyCode} ${total.toFixed(2)}</span>
                </div>
            </div>
            
            <div class="text-center">
                <button onclick="printReceipt()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Print Receipt</button>
            </div>
        </div>
    `;
    
    document.getElementById('receiptContent').innerHTML = receiptHTML;
    document.getElementById('receiptModal').classList.remove('hidden');
}

// Modal functions
function closeInvoiceModal() {
    document.getElementById('invoiceModal').classList.add('hidden');
}

function closeReceiptModal() {
    document.getElementById('receiptModal').classList.add('hidden');
}

function printInvoice() {
    window.print();
}

function printReceipt() {
    window.print();
}

function downloadInvoice() {
    // Implementation for downloading invoice as PDF
    alert('Download functionality will be implemented with PDF library');
}
</script>

<script>
// Add event listeners for payment method changes and amount inputs
document.addEventListener('DOMContentLoaded', function() {
    // Attach listeners to existing payment method
    const existingPaymentMethod = document.querySelector('.payment-method-item');
    if (existingPaymentMethod) {
        attachPaymentMethodListeners(existingPaymentMethod);
    }
    
    // Initial payment summary update
    updatePaymentSummary();
    
    // Trigger auto-fill after a short delay to ensure everything is loaded
    setTimeout(() => {
        const totalText = document.getElementById('total').textContent;
        const total = parseFloat(totalText.replace(/[^0-9.-]/g, '')) || 0;
        console.log('Initial auto-fill trigger, total:', total); // Debug log
        
        const paymentItems = document.querySelectorAll('.payment-method-item');
        paymentItems.forEach(item => {
            const method = item.dataset.method;
            const amountInput = item.querySelector('.payment-amount-input');
            
            if (method !== 'credit' && amountInput) {
                const currentAmount = parseFloat(amountInput.value) || 0;
                if (currentAmount === 0 && total > 0) {
                    amountInput.value = total.toFixed(2);
                    console.log(`Initial auto-fill ${method}: ${amountInput.value}`); // Debug log
                }
            }
        });
        updatePaymentSummary();
    }, 200);
});

// Manual trigger function for auto-fill
window.triggerAutoFill = function() {
    const totalText = document.getElementById('total').textContent;
    const total = parseFloat(totalText.replace(/[^0-9.-]/g, '')) || 0;
    
    const paymentItems = document.querySelectorAll('.payment-method-item');
    paymentItems.forEach(item => {
        const method = item.dataset.method;
        const amountInput = item.querySelector('.payment-amount-input');
        
        if (method !== 'credit' && amountInput) {
            amountInput.value = total.toFixed(2);
        }
    });
    updatePaymentSummary();
};
</script>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #invoiceModal, #receiptModal, #invoiceModal *, #receiptModal * {
        visibility: visible;
    }
    #invoiceModal, #receiptModal {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
</style>
@endsection
