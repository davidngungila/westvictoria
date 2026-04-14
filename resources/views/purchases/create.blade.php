@extends('layouts.app')

@section('title', 'New Purchase Order - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">New Purchase Order</h1>
                <p class="text-gray-600 mt-1">Create a new purchase order for your suppliers</p>
            </div>
            <div class="flex space-x-3">
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
                    <h2 class="text-lg font-semibold text-gray-800">Purchase Order Details</h2>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <!-- Order Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="po_number" class="block text-sm font-medium text-gray-700 mb-1">
                                    PO Number <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="po_number" name="po_number" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                       placeholder="Auto-generated or manual">
                            </div>
                            
                            <div>
                                <label for="order_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Order Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="order_date" name="order_date" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>

                        <!-- Supplier Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-800 mb-4">Supplier Information</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <label for="supplier" class="block text-sm font-medium text-gray-700 mb-1">
                                        Supplier <span class="text-red-500">*</span>
                                    </label>
                                    <select id="supplier" name="supplier" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <option value="">Select a supplier</option>
                                        <option value="techpro">TechPro Supplies</option>
                                        <option value="global">Global Materials Ltd</option>
                                        <option value="office">Office Depot Pro</option>
                                        <option value="premium">Premium Supplies</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-1">
                                        Contact Person
                                    </label>
                                    <input type="text" id="contact_person" name="contact_person"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                           placeholder="Supplier contact">
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="delivery_address" class="block text-sm font-medium text-gray-700 mb-1">
                                    Delivery Address
                                </label>
                                <textarea id="delivery_address" name="delivery_address" rows="2"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                          placeholder="Enter delivery address"></textarea>
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
                                        <tr class="order-item-row">
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <select class="w-full px-2 py-1 border border-gray-300 rounded text-sm">
                                                    <option>Select Product</option>
                                                    <option>Laptop Pro 15"</option>
                                                    <option>Wireless Mouse</option>
                                                    <option>Office Chair</option>
                                                    <option>Coffee Maker</option>
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
                                                <span class="text-sm font-medium text-gray-900">$0.00</span>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <button type="button" onclick="removeOrderItem(this)" class="text-red-600 hover:text-red-800 text-sm">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Payment Terms -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-800 mb-4">Payment Terms</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <label for="payment_terms" class="block text-sm font-medium text-gray-700 mb-1">
                                        Payment Terms <span class="text-red-500">*</span>
                                    </label>
                                    <select id="payment_terms" name="payment_terms" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <option value="net15">Net 15</option>
                                        <option value="net30">Net 30</option>
                                        <option value="net60">Net 60</option>
                                        <option value="immediate">Immediate</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="expected_delivery" class="block text-sm font-medium text-gray-700 mb-1">
                                        Expected Delivery Date <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" id="expected_delivery" name="expected_delivery" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                    Order Notes
                                </label>
                                <textarea id="notes" name="notes" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                          placeholder="Add any special instructions or notes"></textarea>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-800 mb-4">Order Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Subtotal:</span>
                                    <span id="subtotal" class="text-sm font-medium text-gray-900">$0.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Tax (10%):</span>
                                    <span id="tax" class="text-sm font-medium text-gray-900">$0.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Shipping:</span>
                                    <input type="number" id="shipping" class="w-24 px-2 py-1 border border-gray-300 rounded text-sm text-right" value="0" step="0.01" min="0">
                                </div>
                                <div class="border-t pt-2 mt-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Total:</span>
                                        <span id="total" class="text-lg font-bold text-gray-900">$0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <button type="button" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Save as Draft
                            </button>
                            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                Create Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Budget Information</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Monthly Budget</span>
                                <span class="text-sm font-bold text-gray-900">$50,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 43%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">$21,500 spent (43%)</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Remaining Budget</span>
                                <span class="text-sm font-bold text-green-600">$28,500</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Suppliers -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Suppliers</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2h-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">TechPro Supplies</p>
                                    <p class="text-xs text-gray-500">Last order: 3 days ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2h-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Global Materials Ltd</p>
                                    <p class="text-xs text-gray-500">Last order: 1 week ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2h-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Office Depot Pro</p>
                                    <p class="text-xs text-gray-500">Last order: 2 weeks ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Templates -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Order Templates</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            Office Supplies
                        </button>
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            Electronics
                        </button>
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            Furniture
                        </button>
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            Cleaning Supplies
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addOrderItem() {
    const tbody = document.getElementById('order-items');
    const newRow = document.createElement('tr');
    newRow.className = 'order-item-row';
    newRow.innerHTML = `
        <td class="px-4 py-3 whitespace-nowrap">
            <select class="w-full px-2 py-1 border border-gray-300 rounded text-sm">
                <option>Select Product</option>
                <option>Laptop Pro 15"</option>
                <option>Wireless Mouse</option>
                <option>Office Chair</option>
                <option>Coffee Maker</option>
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
            <span class="text-sm font-medium text-gray-900">$0.00</span>
        </td>
        <td class="px-4 py-3 whitespace-nowrap">
            <button type="button" onclick="removeOrderItem(this)" class="text-red-600 hover:text-red-800 text-sm">
                Remove
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
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
                    totalCell.textContent = `$${(quantity * price).toFixed(2)}`;
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
    const shipping = parseFloat(document.getElementById('shipping').value) || 0;
    const total = subtotal + tax + shipping;
    
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    attachItemListeners();
    
    document.getElementById('shipping').addEventListener('input', calculateTotals);
    
    // Set today's date as default
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('order_date').value = today;
});
</script>
@endsection
