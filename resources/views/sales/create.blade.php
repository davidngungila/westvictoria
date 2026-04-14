@extends('layouts.app')

@section('title', 'Create Sale - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Create New Sale</h1>
                <p class="text-gray-600 mt-1">Add a new sales transaction</p>
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

    <!-- Success Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Create Sale Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <form method="POST" action="{{ route('sales.store') }}" id="saleForm">
            @csrf
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Sale Information</h3>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Sale Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sale Type *</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="sale_type" value="retail" {{ request('type') == 'retail' ? 'checked' : '' }} class="mr-2" required>
                            <span class="text-sm text-gray-700">Retail Sale</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="sale_type" value="wholesale" {{ request('type') == 'wholesale' ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm text-gray-700">Wholesale Sale</span>
                        </label>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name *</label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('customer_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                        <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('customer_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">Customer Phone</label>
                    <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('customer_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                    <select name="payment_method" id="payment_method" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Payment Method</option>
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                    </select>
                    @error('payment_method')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" id="notes" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sale Items Section -->
            <div class="border-t border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Sale Items</h3>
                        <button type="button" onclick="addSaleItem()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                            Add Item
                        </button>
                    </div>
                </div>
                
                <div class="p-6">
                    <div id="saleItems" class="space-y-4">
                        <!-- First Item -->
                        <div class="sale-item border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-medium text-gray-700">Item 1</h4>
                                <button type="button" onclick="removeSaleItem(this)" class="text-red-600 hover:text-red-800 text-sm">
                                    Remove
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Product *</label>
                                    <select name="items[0][product_id]" required onchange="updateProductInfo(0)"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->sku }} (Stock: {{ $product->quantity }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                                    <input type="number" name="items[0][quantity]" min="1" value="1" required onchange="calculateItemTotal(0)"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Unit Price *</label>
                                    <input type="number" name="items[0][unit_price]" step="0.01" min="0" required onchange="calculateItemTotal(0)"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Discount %</label>
                                    <input type="number" name="items[0][discount_percentage]" step="0.01" min="0" max="100" value="0" onchange="calculateItemTotal(0)"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            <div class="mt-4 text-right">
                                <span class="text-sm text-gray-600">Item Total: </span>
                                <span class="text-sm font-bold text-gray-900" id="item-total-0">TZS 0.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Totals Summary -->
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-right">
                                <span class="text-sm text-gray-600">Subtotal: </span>
                                <span class="text-sm font-bold text-gray-900" id="subtotal">TZS 0.00</span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-600">Discount: </span>
                                <span class="text-sm font-bold text-red-600" id="total-discount">TZS 0.00</span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-600">Tax (18%): </span>
                                <span class="text-sm font-bold text-gray-900" id="tax">TZS 0.00</span>
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <span class="text-lg text-gray-600">Total Amount: </span>
                            <span class="text-lg font-bold text-blue-600" id="total-amount">TZS 0.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="border-t border-gray-200 p-6">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('sales.dashboard') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Create Sale
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let itemCounter = 1;
const products = @json($products);
const taxRate = {{ App\Models\SystemSetting::isTaxEnabled() ? App\Models\SystemSetting::getTaxRate() : 0 }};
const currencyCode = '{{ App\Models\SystemSetting::getCurrencyCode() }}';

function addSaleItem() {
    const container = document.getElementById('saleItems');
    const itemHtml = `
        <div class="sale-item border border-gray-200 rounded-lg p-4">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-medium text-gray-700">Item ${itemCounter + 1}</h4>
                <button type="button" onclick="removeSaleItem(this)" class="text-red-600 hover:text-red-800 text-sm">
                    Remove
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product *</label>
                    <select name="items[${itemCounter}][product_id]" required onchange="updateProductInfo(${itemCounter})"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Product</option>
                        ${products.map(p => `<option value="${p.id}">${p.name} - ${p.sku} (Stock: ${p.quantity})</option>`).join('')}
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                    <input type="number" name="items[${itemCounter}][quantity]" min="1" value="1" required onchange="calculateItemTotal(${itemCounter})"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Unit Price *</label>
                    <input type="number" name="items[${itemCounter}][unit_price]" step="0.01" min="0" required onchange="calculateItemTotal(${itemCounter})"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Discount %</label>
                    <input type="number" name="items[${itemCounter}][discount_percentage]" step="0.01" min="0" max="100" value="0" onchange="calculateItemTotal(${itemCounter})"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="mt-4 text-right">
                <span class="text-sm text-gray-600">Item Total: </span>
                <span class="text-sm font-bold text-gray-900" id="item-total-${itemCounter}">${currencyCode} 0.00</span>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', itemHtml);
    itemCounter++;
}

function removeSaleItem(button) {
    const items = document.querySelectorAll('.sale-item');
    if (items.length > 1) {
        button.closest('.sale-item').remove();
        calculateTotals();
    } else {
        alert('You must have at least one item');
    }
}

function updateProductInfo(index) {
    const select = document.querySelector(`select[name="items[${index}][product_id]"]`);
    const productId = select.value;
    const product = products.find(p => p.id == productId);
    
    if (product) {
        document.querySelector(`input[name="items[${index}][unit_price]"]`).value = product.price;
        calculateItemTotal(index);
    }
}

function calculateItemTotal(index) {
    const quantity = parseFloat(document.querySelector(`input[name="items[${index}][quantity]"]`).value) || 0;
    const unitPrice = parseFloat(document.querySelector(`input[name="items[${index}][unit_price]"]`).value) || 0;
    const discountPercent = parseFloat(document.querySelector(`input[name="items[${index}][discount_percentage]"]`).value) || 0;
    
    const subtotal = quantity * unitPrice;
    const discountAmount = subtotal * (discountPercent / 100);
    const afterDiscount = subtotal - discountAmount;
    const taxAmount = afterDiscount * (taxRate / 100);
    const total = afterDiscount + taxAmount;
    
    document.getElementById(`item-total-${index}`).textContent = `${currencyCode} ${total.toFixed(2)}`;
    calculateTotals();
}

function calculateTotals() {
    const items = document.querySelectorAll('.sale-item');
    let subtotal = 0;
    let totalDiscount = 0;
    let tax = 0;
    
    items.forEach((item, index) => {
        const quantity = parseFloat(item.querySelector(`input[name="items[${index}][quantity]"]`).value) || 0;
        const unitPrice = parseFloat(item.querySelector(`input[name="items[${index}][unit_price]"]`).value) || 0;
        const discountPercent = parseFloat(item.querySelector(`input[name="items[${index}][discount_percentage]"]`).value) || 0;
        
        const itemSubtotal = quantity * unitPrice;
        const itemDiscount = itemSubtotal * (discountPercent / 100);
        const afterDiscount = itemSubtotal - itemDiscount;
        const itemTax = afterDiscount * (taxRate / 100);
        
        subtotal += itemSubtotal;
        totalDiscount += itemDiscount;
        tax += itemTax;
    });
    
    const total = subtotal - totalDiscount + tax;
    
    document.getElementById('subtotal').textContent = `${currencyCode} ${subtotal.toFixed(2)}`;
    document.getElementById('total-discount').textContent = `${currencyCode} ${totalDiscount.toFixed(2)}`;
    document.getElementById('tax').textContent = `${currencyCode} ${tax.toFixed(2)}`;
    document.getElementById('total-amount').textContent = `${currencyCode} ${total.toFixed(2)}`;
}
</script>
@endsection
