@extends('layouts.app')

@section('title', 'Purchase Order Details - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Purchase Order Details</h1>
                <p class="text-gray-600 mt-1">View and manage purchase order information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('purchases.orders') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Orders
                </a>
                @if($purchase->status === 'ordered')
                    <a href="{{ route('purchases.edit', $purchase->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Order
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Order Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Details -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Order Information</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">PO Number</label>
                            <p class="text-lg font-bold text-gray-900">{{ $purchase->purchase_number }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Order Date</label>
                            <p class="text-gray-900">{{ $purchase->order_date ? $purchase->order_date->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Expected Delivery</label>
                            <p class="text-gray-900">{{ $purchase->expected_date ? $purchase->expected_date->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>
                    @if($purchase->notes)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <p class="text-gray-900">{{ $purchase->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Order Items</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($purchase->purchaseItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->product ? $item->product->name : 'Unknown Product' }}
                                        </div>
                                        @if($item->product)
                                            <div class="text-xs text-gray-500">SKU: {{ $item->product->sku }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        TZS {{ number_format($item->unit_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        TZS {{ number_format($item->total_price, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No items found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Supplier Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Supplier Information</h3>
                </div>
                <div class="p-6">
                    @if($purchase->supplier)
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Supplier Name</p>
                                <p class="text-gray-900">{{ $purchase->supplier->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Supplier ID</p>
                                <p class="text-gray-900">{{ $purchase->supplier->supplier_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Contact</p>
                                <p class="text-gray-900">{{ $purchase->supplier->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Email</p>
                                <p class="text-gray-900">{{ $purchase->supplier->email }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">No supplier information available.</p>
                    @endif
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Order Summary</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Subtotal:</span>
                            <span class="text-sm font-medium text-gray-900">TZS {{ number_format($purchase->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Tax (10%):</span>
                            <span class="text-sm font-medium text-gray-900">TZS {{ number_format($purchase->total_amount * 0.1, 2) }}</span>
                        </div>
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-700">Total:</span>
                                <span class="text-lg font-bold text-gray-900">TZS {{ number_format($purchase->final_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @if(in_array($purchase->status, ['ordered', 'draft']))
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <div class="space-y-3">
                            @if($purchase->status === 'ordered')
                                <button onclick="updatePurchaseStatus({{ $purchase->id }}, 'in_transit')" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    Mark as In Transit
                                </button>
                                <button onclick="updatePurchaseStatus({{ $purchase->id }}, 'received')" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    Mark as Received
                                </button>
                            @endif
                            <button onclick="deletePurchase({{ $purchase->id }})" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                Cancel Order
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function updatePurchaseStatus(purchaseId, newStatus) {
    SweetAlertUtils.confirmAction(
        'Update Purchase Status',
        'Are you sure you want to update the status of this purchase order?',
        function() {
            SweetAlertUtils.loading('Updating status...');
            
            fetch(`/purchases/${purchaseId}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    SweetAlertUtils.formSuccess(
                        'Status Updated',
                        data.message,
                        window.location.href
                    );
                } else {
                    SweetAlertUtils.createError('Status Update Error', data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                SweetAlertUtils.networkError();
            });
        }
    );
}

function deletePurchase(purchaseId) {
    SweetAlertUtils.confirmAction(
        'Delete Purchase Order',
        'Are you sure you want to delete this purchase order? This action cannot be undone.',
        function() {
            SweetAlertUtils.loading('Deleting purchase order...');
            
            fetch(`/purchases/${purchaseId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    SweetAlertUtils.formSuccess(
                        'Purchase Order Deleted',
                        data.message,
                        '{{ route("purchases.orders") }}'
                    );
                } else {
                    SweetAlertUtils.createError('Delete Error', data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                SweetAlertUtils.networkError();
            });
        }
    );
}
</script>
@endsection
