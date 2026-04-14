@extends('layouts.app')

@section('title', 'Edit Purchase Order - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Purchase Order</h1>
                <p class="text-gray-600 mt-1">Update purchase order information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('purchases.show', $purchase->id) }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View Order
                </a>
                <a href="{{ route('purchases.orders') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Orders
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Edit Purchase Order</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Order Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="po_number" class="block text-sm font-medium text-gray-700 mb-1">
                                    PO Number
                                </label>
                                <input type="text" id="po_number" name="po_number" value="{{ $purchase->purchase_number }}" readonly
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="order_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Order Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="order_date" name="order_date" value="{{ $purchase->order_date ? $purchase->order_date->format('Y-m-d') : '' }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>

                        <!-- Supplier Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-800 mb-4">Supplier Information</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Supplier <span class="text-red-500">*</span>
                                    </label>
                                    <select id="supplier_id" name="supplier_id" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <option value="">Select a supplier</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }} ({{ $supplier->supplier_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="expected_date" class="block text-sm font-medium text-gray-700 mb-1">
                                        Expected Delivery Date
                                    </label>
                                    <input type="date" id="expected_date" name="expected_date" 
                                           value="{{ $purchase->expected_date ? $purchase->expected_date->format('Y-m-d') : '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                    Order Notes
                                </label>
                                <textarea id="notes" name="notes" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                          placeholder="Add any special instructions or notes">{{ $purchase->notes }}</textarea>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-md font-medium text-gray-800">Order Items</h3>
                                <button type="button" onclick="addOrderItem()" class="px-3 py-1 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-colors">
                                    + Add Item
                                </button>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order-items" class="bg-white divide-y divide-gray-200">
                                        @forelse($purchase->purchaseItems as $index => $item)
                                            <tr class="order-item-row">
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <select class="w-full px-2 py-1 border border-gray-300 rounded text-sm product-select" name="items[{{ $index }}][product_id]">
                                                        <option value="">Select Product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}" 
                                                                    data-price="{{ $product->cost_price }}" 
                                                                    data-name="{{ $product->name }}"
                                                                    {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                                {{ $product->name }} ({{ $product->sku }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm" 
                                                           name="items[{{ $index }}][description]" 
                                                           value="{{ $item->description }}" placeholder="Description">
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="number" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm" 
                                                           name="items[{{ $index }}][quantity]" 
                                                           value="{{ $item->quantity }}" placeholder="0" min="1">
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="number" class="w-24 px-2 py-1 border border-gray-300 rounded text-sm" 
                                                           name="items[{{ $index }}][unit_price]" 
                                                           value="{{ $item->unit_price }}" placeholder="0.00" step="0.01" min="0">
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <span class="text-sm font-medium text-gray-900">TZS {{ number_format($item->total_price, 2) }}</span>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <button type="button" onclick="removeOrderItem(this)" class="text-red-600 hover:text-red-800 text-sm">
                                                        Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="order-item-row">
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <select class="w-full px-2 py-1 border border-gray-300 rounded text-sm product-select">
                                                        <option value="">Select Product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}" data-price="{{ $product->cost_price }}" data-name="{{ $product->name }}">{{ $product->name }} ({{ $product->sku }})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm" placeholder="Description">
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="number" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm" placeholder="0" min="1">
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <input type="number" class="w-24 px-2 py-1 border border-gray-300 rounded text-sm" placeholder="0.00" step="0.01" min="0">
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <span class="text-sm font-medium text-gray-900">TZS 0.00</span>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <button type="button" onclick="removeOrderItem(this)" class="text-red-600 hover:text-red-800 text-sm">
                                                        Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('purchases.show', $purchase->id) }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                Update Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Order Summary</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Subtotal:</span>
                            <span id="subtotal" class="text-sm font-medium text-gray-900">TZS {{ number_format($purchase->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Tax (10%):</span>
                            <span id="tax" class="text-sm font-medium text-gray-900">TZS {{ number_format($purchase->total_amount * 0.1, 2) }}</span>
                        </div>
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-700">Total:</span>
                                <span id="total" class="text-lg font-bold text-gray-900">TZS {{ number_format($purchase->final_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Status Information</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Current Status</p>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($purchase->status == 'received') bg-green-100 text-green-800
                                @elseif($purchase->status == 'in_transit') bg-blue-100 text-blue-800
                                @elseif($purchase->status == 'ordered') bg-yellow-100 text-yellow-800
                                @elseif($purchase->status == 'cancelled') bg-red-100 text-red-800
                                @elseif($purchase->status == 'draft') bg-gray-100 text-gray-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($purchase->status) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Created By</p>
                            <p class="text-gray-900">{{ $purchase->creator ? $purchase->creator->name : 'Unknown' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Created At</p>
                            <p class="text-gray-900">{{ $purchase->created_at ? $purchase->created_at->format('M d, Y H:i') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let itemIndex = {{ $purchase->purchaseItems->count() }};

function addOrderItem() {
    const tbody = document.getElementById('order-items');
    const newRow = document.createElement('tr');
    newRow.className = 'order-item-row';
    newRow.innerHTML = `
        <td class="px-4 py-3 whitespace-nowrap">
            <select class="w-full px-2 py-1 border border-gray-300 rounded text-sm product-select" name="items[${itemIndex}][product_id]">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->cost_price }}" data-name="{{ $product->name }}">{{ $product->name }} ({{ $product->sku }})</option>
                @endforeach
            </select>
        </td>
        <td class="px-4 py-3 whitespace-nowrap">
            <input type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm" name="items[${itemIndex}][description]" placeholder="Description">
        </td>
        <td class="px-4 py-3 whitespace-nowrap">
            <input type="number" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm" name="items[${itemIndex}][quantity]" placeholder="0" min="1">
        </td>
        <td class="px-4 py-3 whitespace-nowrap">
            <input type="number" class="w-24 px-2 py-1 border border-gray-300 rounded text-sm" name="items[${itemIndex}][unit_price]" placeholder="0.00" step="0.01" min="0">
        </td>
        <td class="px-4 py-3 whitespace-nowrap">
            <span class="text-sm font-medium text-gray-900">TZS 0.00</span>
        </td>
        <td class="px-4 py-3 whitespace-nowrap">
            <button type="button" onclick="removeOrderItem(this)" class="text-red-600 hover:text-red-800 text-sm">
                Remove
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
    itemIndex++;
    attachItemListeners();
}

function removeOrderItem(button) {
    const row = button.closest('tr');
    row.remove();
    calculateTotals();
}

function attachItemListeners() {
    const rows = document.querySelectorAll('.order-item-row');
    rows.forEach(row => {
        const quantityInput = row.querySelector('input[type="number"]:nth-of-type(1)');
        const priceInput = row.querySelector('input[type="number"]:nth-of-type(2)');
        const totalCell = row.querySelector('td:nth-child(5) span');
        
        [quantityInput, priceInput].forEach(input => {
            if (input) {
                input.addEventListener('input', () => {
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    totalCell.textContent = `TZS ${(quantity * price).toFixed(2)}`;
                    calculateTotals();
                });
            }
        });
    });
}

function calculateTotals() {
    const rows = document.querySelectorAll('.order-item-row');
    let subtotal = 0;
    
    rows.forEach(row => {
        const quantityInput = row.querySelector('input[type="number"]:nth-of-type(1)');
        const priceInput = row.querySelector('input[type="number"]:nth-of-type(2)');
        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        subtotal += quantity * price;
    });
    
    const tax = subtotal * 0.1;
    const total = subtotal + tax;
    
    document.getElementById('subtotal').textContent = `TZS ${subtotal.toFixed(2)}`;
    document.getElementById('tax').textContent = `TZS ${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `TZS ${total.toFixed(2)}`;
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    attachItemListeners();
    calculateTotals();
    
    // Handle product selection auto-fill
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select')) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const name = selectedOption.getAttribute('data-name');
            const row = e.target.closest('tr');
            const priceInput = row.querySelector('input[type="number"]:nth-of-type(2)');
            const descriptionInput = row.querySelector('input[type="text"]');
            
            if (price && priceInput) {
                priceInput.value = price;
                // Trigger input event to recalculate total
                priceInput.dispatchEvent(new Event('input'));
            }
            
            if (name && descriptionInput) {
                descriptionInput.value = name;
            }
        }
    });
    
    // Handle form submission
    const form = document.querySelector('form[action="{{ route('purchases.update', $purchase->id) }}"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate that at least one item is added
            const items = document.querySelectorAll('.order-item-row');
            if (items.length === 0) {
                SweetAlertUtils.showError('Validation Error', 'Please add at least one item to the purchase order.');
                return;
            }
            
            // Validate items
            let validItems = true;
            
            items.forEach((row, index) => {
                const productSelect = row.querySelector('.product-select');
                const quantityInput = row.querySelector('input[type="number"]:nth-of-type(1)');
                const priceInput = row.querySelector('input[type="number"]:nth-of-type(2)');
                
                if (!productSelect.value || !quantityInput.value || !priceInput.value) {
                    validItems = false;
                    return;
                }
            });
            
            if (!validItems) {
                SweetAlertUtils.showError('Validation Error', 'Please fill in all required fields for each item.');
                return;
            }
            
            // Show loading
            SweetAlertUtils.loading('Updating Purchase Order...');
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    SweetAlertUtils.formSuccess(
                        'Purchase Order Updated',
                        data.message,
                        data.redirect_url
                    );
                } else {
                    SweetAlertUtils.createError('Update Order Error', data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                SweetAlertUtils.networkError();
            });
        });
    }
});
</script>
@endsection
