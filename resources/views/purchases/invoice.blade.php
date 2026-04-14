@extends('layouts.app')

@section('title', 'Purchase Invoice - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Purchase Invoice</h1>
                <p class="text-gray-600 mt-1">Invoice for purchase order {{ $purchase->purchase_number }}</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print Invoice
                </button>
                <a href="{{ route('purchases.show', $purchase->id) }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Order
                </a>
            </div>
        </div>
    </div>

    <!-- Invoice Content -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 print:shadow-none print:border-none">
        <div class="p-8">
            <!-- Invoice Header -->
            <div class="border-b border-gray-200 pb-6 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">INVOICE</h2>
                        <p class="text-gray-600 mt-1">Invoice Number: INV-{{ $purchase->purchase_number }}</p>
                        <p class="text-gray-600">Date: {{ now()->format('M d, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-600">Purchase Order</div>
                        <div class="text-lg font-bold text-gray-900">{{ $purchase->purchase_number }}</div>
                        <div class="text-sm text-gray-600 mt-1">Status: 
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($purchase->status == 'received') bg-green-100 text-green-800
                                @elseif($purchase->status == 'in_transit') bg-blue-100 text-blue-800
                                @elseif($purchase->status == 'ordered') bg-yellow-100 text-yellow-800
                                @elseif($purchase->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($purchase->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supplier and Company Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">SUPPLIER</h3>
                    @if($purchase->supplier)
                        <div class="space-y-1">
                            <p class="text-gray-900 font-medium">{{ $purchase->supplier->name }}</p>
                            <p class="text-gray-600 text-sm">{{ $purchase->supplier->supplier_id }}</p>
                            <p class="text-gray-600 text-sm">{{ $purchase->supplier->address }}</p>
                            <p class="text-gray-600 text-sm">{{ $purchase->supplier->phone }}</p>
                            <p class="text-gray-600 text-sm">{{ $purchase->supplier->email }}</p>
                        </div>
                    @else
                        <p class="text-gray-500">No supplier information available</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">BILL TO</h3>
                    <div class="space-y-1">
                        <p class="text-gray-900 font-medium">Your Company Name</p>
                        <p class="text-gray-600 text-sm">123 Business Street</p>
                        <p class="text-gray-600 text-sm">Dar es Salaam, Tanzania</p>
                        <p class="text-gray-600 text-sm">Phone: +255 123 456 789</p>
                        <p class="text-gray-600 text-sm">Email: info@company.co.tz</p>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">ORDER DATE</h3>
                    <p class="text-gray-900">{{ $purchase->order_date ? $purchase->order_date->format('M d, Y') : 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">EXPECTED DELIVERY</h3>
                    <p class="text-gray-900">{{ $purchase->expected_date ? $purchase->expected_date->format('M d, Y') : 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">PAYMENT TERMS</h3>
                    <p class="text-gray-900">Net 30</p>
                </div>
            </div>

            <!-- Items Table -->
            <div class="mb-8">
                <h3 class="text-sm font-medium text-gray-700 mb-4">ORDER ITEMS</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($purchase->purchaseItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->product ? $item->product->name : 'Unknown Product' }}
                                        </div>
                                        @if($item->product)
                                            <div class="text-xs text-gray-500">SKU: {{ $item->product->sku }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900">
                                        TZS {{ number_format($item->unit_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
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

            <!-- Summary -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex justify-end">
                    <div class="w-64">
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
            </div>

            <!-- Notes -->
            @if($purchase->notes)
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">NOTES</h3>
                    <p class="text-gray-600 text-sm">{{ $purchase->notes }}</p>
                </div>
            @endif

            <!-- Footer -->
            <div class="border-t border-gray-200 pt-6 mt-8">
                <div class="text-center text-sm text-gray-500">
                    <p>Thank you for your business!</p>
                    <p class="mt-2">This is a computer-generated invoice. No signature required.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white !important;
        color: black !important;
    }
    
    .bg-white {
        background: white !important;
    }
    
    .border-gray-200 {
        border-color: #e5e7eb !important;
    }
    
    .text-gray-900 {
        color: #111827 !important;
    }
    
    .text-gray-600 {
        color: #6b7280 !important;
    }
}
</style>
@endsection
