@extends('layouts.app')

@section('title', 'Purchases Dashboard - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">TZS {{ number_format($monthlyPurchases, 2) }}</h1>
                <p class="text-gray-600 mt-1">Overview of your purchase orders and supplier management</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <a href="{{ route('purchases.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Purchase Order
                </a>
                <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Report
                </button>
            </div>
        </div>
    </div>

    <!-- Purchase Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Today's Purchases</p>
                    <p class="text-2xl font-bold text-gray-900">TZS {{ number_format($todayPurchases, 2) }}</p>
                    <p class="text-xs text-green-600">Live data from database</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Monthly Purchases</p>
                    <p class="text-2xl font-bold text-gray-900">TZS {{ number_format($monthlyPurchases, 2) }}</p>
                    <p class="text-xs text-green-600">Current month</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $activeOrders }}</p>
                    <p class="text-xs text-orange-600">{{ $pendingApprovals }} pending approval</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Suppliers</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalSuppliers }}</p>
                    <p class="text-xs text-green-600">Total suppliers</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Purchase Chart -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Purchase Trend</h3>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">7 Days</button>
                            <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-full">30 Days</button>
                            <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-full">3 Months</button>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="text-gray-500">Purchase trend chart will be displayed here</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Purchase Orders -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Recent Purchase Orders</h3>
                        <a href="{{ route('purchases.orders') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PO Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expected Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentPurchases as $purchase)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $purchase->purchase_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $purchase->supplier ? $purchase->supplier->name : 'No Supplier' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">TZS {{ number_format($purchase->final_amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {!! $purchase->status_label !!}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $purchase->expected_date ? $purchase->expected_date->format('M d, Y') : 'Not set' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                        <span class="text-gray-300">|</span>
                                        @if($purchase->status === 'in_transit')
                                            <a href="#" class="text-green-600 hover:text-green-900">Track</a>
                                        @elseif($purchase->status === 'ordered')
                                            <a href="#" class="text-orange-600 hover:text-orange-900">Cancel</a>
                                        @else
                                            <a href="#" class="text-green-600 hover:text-green-900">Invoice</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No purchase orders found. <a href="{{ route('purchases.create') }}" class="text-blue-600 hover:text-blue-800">Create your first purchase order</a>
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
            <!-- Top Suppliers -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Top Suppliers</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @forelse($topSuppliers as $supplier)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2h-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $supplier->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $supplier->purchases_count ?? 0 }} orders</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-gray-900">TZS {{ number_format($supplier->purchases_sum_final_amount ?? 0, 2) }}</span>
                        </div>
                        @empty
                        <div class="text-center text-gray-500 py-4">
                            <p class="text-sm">No suppliers found</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Order Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Order Status</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700">Ordered</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900">{{ $purchaseStatuses['ordered'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700">In Transit</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900">{{ $purchaseStatuses['in_transit'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700">Received</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900">{{ $purchaseStatuses['received'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700">Cancelled</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900">{{ $purchaseStatuses['cancelled'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('purchases.create') }}" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm inline-block text-center">
                        Create Purchase Order
                    </a>
                    <a href="{{ route('suppliers.dashboard') }}" class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm inline-block text-center">
                        Manage Suppliers
                    </a>
                    <div class="relative">
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            Pending Approvals
                            @if($pendingApprovals > 0)
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $pendingApprovals }}</span>
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
