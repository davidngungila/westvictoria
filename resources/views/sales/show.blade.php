@extends('layouts.app')

@section('title', 'Sale Details - ' . $sale->sale_number . ' - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">{{ $sale->sale_number }}</h1>
                <p class="text-gray-600 mt-1">Sale details and information</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                @if($sale->sale_status !== 'completed' && $sale->sale_status !== 'cancelled')
                    <a href="{{ route('sales.edit', $sale) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Sale
                    </a>
                @endif
                @if($sale->payment_status === 'paid')
                    <button onclick="generateReceipt({{ $sale->id }})" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a3 3 0 003 3h0a3 3 0 003-3v-1m-6 0h12m-6 0a2 2 0 01-2-2v-4a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2m0 0h-6"></path>
                        </svg>
                        Generate Receipt
                    </button>
                @else
                    <button onclick="generateInvoice({{ $sale->id }})" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Generate Invoice
                    </button>
                @endif
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Sale Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Sale Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sale Number</label>
                            <p class="text-sm text-gray-900 font-medium">{{ $sale->sale_number }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sale Type</label>
                            <div>{!! $sale->sale_type_label !!}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                            <p class="text-sm text-gray-900">{{ ucfirst($sale->payment_method) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Created Date</label>
                            <p class="text-sm text-gray-900">{{ $sale->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($sale->notes)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <p class="text-sm text-gray-900">{{ $sale->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Customer Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
                            <p class="text-sm text-gray-900 font-medium">{{ $sale->customer_name }}</p>
                        </div>
                        @if($sale->customer_email)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <p class="text-sm text-gray-900">{{ $sale->customer_email }}</p>
                            </div>
                        @endif
                        @if($sale->customer_phone)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <p class="text-sm text-gray-900">{{ $sale->customer_phone }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sale Items -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Sale Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tax</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($sale->saleItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $item->product_sku }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->formatted_unit_price }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $item->discount_percentage }}%</div>
                                        <div class="text-sm text-red-600">{{ $item->formatted_discount_amount }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $item->tax_percentage }}%</div>
                                        <div class="text-sm text-gray-600">{{ $item->formatted_tax_amount }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->formatted_total_price }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Totals -->
                <div class="border-t border-gray-200 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-right">
                            <span class="text-sm text-gray-600">Subtotal: </span>
                            <span class="text-sm font-bold text-gray-900">{{ $sale->formatted_total_amount }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-600">Discount: </span>
                            <span class="text-sm font-bold text-red-600">{{ $sale->formatted_discount_amount }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-600">Tax: </span>
                            <span class="text-sm font-bold text-gray-900">{{ $sale->formatted_tax_amount }}</span>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <span class="text-lg text-gray-600">Final Amount: </span>
                        <span class="text-lg font-bold text-blue-600">{{ $sale->formatted_final_amount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Status Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Status</label>
                        <div>{!! $sale->payment_status_label !!}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sale Status</label>
                        <div>{!! $sale->sale_status_label !!}</div>
                    </div>
                    
                    @if($sale->sale_status !== 'completed' && $sale->sale_status !== 'cancelled')
                        <form method="POST" action="{{ route('sales.status.update', $sale) }}" class="mt-4">
                            @csrf
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Update Payment Status</label>
                                    <select name="payment_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="{{ $sale->payment_status }}" selected>{{ ucfirst($sale->payment_status) }}</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="partial">Partial</option>
                                        <option value="overdue">Overdue</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Update Sale Status</label>
                                    <select name="sale_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="{{ $sale->sale_status }}" selected>{{ ucfirst($sale->sale_status) }}</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            @if($sale->sale_status !== 'completed' && $sale->sale_status !== 'cancelled')
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('sales.edit', $sale) }}" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors block text-center">
                            Edit Sale
                        </a>
                        <form method="POST" action="{{ route('sales.destroy', $sale) }}" onsubmit="return confirm('Are you sure you want to delete this sale? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                Delete Sale
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Created By -->
            @if($sale->creator)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Created By</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 mr-3">
                                <img src="{{ $sale->creator->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $sale->creator->name }}</div>
                                <div class="text-sm text-gray-500">{{ $sale->creator->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

<script>
// Generate invoice for specific sale
function generateInvoice(saleId) {
    Swal.fire({
        title: 'Generating Invoice...',
        text: 'Please wait while we generate the invoice',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
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
    
    fetch(`/sales/${saleId}/invoice`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        }
    })
    .then(response => {
        console.log('Invoice response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('Invoice response data:', data);
        Swal.close();
        
        if (data.success) {
            // Open invoice in new window
            const invoiceWindow = window.open('', '_blank');
            invoiceWindow.document.write(data.html);
            invoiceWindow.document.close();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Failed to generate invoice',
                confirmButtonColor: '#EF4444'
            });
        }
    })
    .catch(error => {
        console.error('Invoice fetch error:', error);
        Swal.close();
        
        // More specific error messages
        let errorMessage = 'Failed to generate invoice';
        
        if (error.message.includes('HTTP error! status: 404')) {
            errorMessage = 'Invoice endpoint not found. Please check the route.';
        } else if (error.message.includes('HTTP error! status: 500')) {
            errorMessage = 'Server error while generating invoice. Please try again.';
        } else if (error.message.includes('Failed to fetch')) {
            errorMessage = 'Network error. Please check your connection and try again.';
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
            confirmButtonColor: '#EF4444'
        });
    });
}

// Generate receipt for specific sale
function generateReceipt(saleId) {
    Swal.fire({
        title: 'Generating Receipt...',
        text: 'Please wait while we generate the receipt',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
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
    
    fetch(`/sales/${saleId}/receipt`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        }
    })
    .then(response => {
        console.log('Receipt response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('Receipt response data:', data);
        Swal.close();
        
        if (data.success) {
            // Open receipt in new window
            const receiptWindow = window.open('', '_blank');
            receiptWindow.document.write(data.html);
            receiptWindow.document.close();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Failed to generate receipt',
                confirmButtonColor: '#EF4444'
            });
        }
    })
    .catch(error => {
        console.error('Receipt fetch error:', error);
        Swal.close();
        
        // More specific error messages
        let errorMessage = 'Failed to generate receipt';
        
        if (error.message.includes('HTTP error! status: 404')) {
            errorMessage = 'Receipt endpoint not found. Please check the route.';
        } else if (error.message.includes('HTTP error! status: 500')) {
            errorMessage = 'Server error while generating receipt. Please try again.';
        } else if (error.message.includes('Failed to fetch')) {
            errorMessage = 'Network error. Please check your connection and try again.';
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
            confirmButtonColor: '#EF4444'
        });
    });
}
</script>
