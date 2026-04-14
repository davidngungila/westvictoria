@extends('layouts.app')

@section('title', 'Dashboard - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Business Overview Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg p-4 shadow-lg">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-4 lg:mb-0">
                    <h1 class="text-2xl font-bold mb-2">Business Overview</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-sm">
                        <div>
                            <span class="opacity-90">Today:</span> April 14, 2026
                        </div>
                        <div>
                            <span class="opacity-90">Business:</span> West Victoria Trading Ltd
                        </div>
                        <div>
                            <span class="opacity-90">Status:</span> Operational
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="text-right">
                        <p class="text-sm opacity-90">Today's Revenue</p>
                        <p class="text-2xl font-bold">TZS 2,450,000</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm text-gray-500">
        <span>Home</span>
        <span class="mx-2">/</span>
        <span class="text-gray-700">Dashboard</span>
    </nav>

    <!-- Enhanced Business Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Sales</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">TZS 45,280,000</h1>
                    <p class="text-xs text-green-600">+12% from last month</p>
                    <div class="mt-2">
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>15% growth this week</span>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Products</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">8,456</h1>
                    <p class="text-xs text-green-600">+23 new items</p>
                    <div class="mt-2">
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>2.7% increase in stock</span>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Customers</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">2,145</h1>
                    <p class="text-xs text-green-600">+45 this month</p>
                    <div class="mt-2">
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>89% retention rate</span>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Orders</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">28</h1>
                    <p class="text-xs text-orange-600">8 urgent</p>
                    <div class="mt-2">
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Avg. 2.3h processing time</span>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center relative">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Revenue Today</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">TZS 2,450,000</h1>
                    <p class="text-xs text-green-600">+8% from yesterday</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Expenses</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">TZS 12,450,000</h1>
                    <p class="text-xs text-red-600">+3% from last month</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Suppliers</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">156</h1>
                    <p class="text-xs text-green-600">+12 new this quarter</p>
                </div>
                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Inventory Value</p>
                    <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">TZS 284,500,000</h1>
                    <p class="text-xs text-green-600">+8.5% from last month</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Revenue Trend</h3>
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
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="#9CA3AF" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-500">Revenue trend chart will be displayed here</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Performance -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Sales Performance</h3>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full">Today</button>
                        <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-full">Week</button>
                        <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-full">Month</button>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="#9CA3AF" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                        <p class="text-gray-500">Sales performance chart will be displayed here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Top Products -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Top Products</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-bold text-blue-600">1</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Laptop Dell XPS 15</p>
                                <p class="text-xs text-gray-500">245 sold</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-900">TZS 45M</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-bold text-green-600">2</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">iPhone 15 Pro</p>
                                <p class="text-xs text-gray-500">189 sold</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-900">TZS 38M</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-bold text-purple-600">3</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Samsung Galaxy S24</p>
                                <p class="text-xs text-gray-500">156 sold</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-900">TZS 28M</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Recent Orders</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">#ORD-2024-0892</p>
                            <p class="text-xs text-gray-500">John Smith</p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-900">TZS 450,000</span>
                            <p class="text-xs text-green-600">Completed</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">#ORD-2024-0891</p>
                            <p class="text-xs text-gray-500">Mary Johnson</p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-900">TZS 320,000</span>
                            <p class="text-xs text-orange-600">Processing</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">#ORD-2024-0890</p>
                            <p class="text-xs text-gray-500">David Wilson</p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-900">TZS 180,000</span>
                            <p class="text-xs text-blue-600">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Alerts -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Inventory Alerts</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-red-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Wireless Mouse</p>
                                <p class="text-xs text-gray-500">3 units left</p>
                            </div>
                        </div>
                        <button class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Reorder</button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">USB Cable 2m</p>
                                <p class="text-xs text-gray-500">8 units left</p>
                            </div>
                        </div>
                        <button class="text-xs bg-orange-100 text-orange-800 px-2 py-1 rounded">Low Stock</button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Desk Lamp</p>
                                <p class="text-xs text-gray-500">15 units left</p>
                            </div>
                        </div>
                        <button class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Monitor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Quick Actions</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <a href="{{ route('products.create') }}" class="flex flex-col items-center p-3 text-center hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700">Add Product</span>
                </a>
                <a href="{{ route('purchases.create') }}" class="flex flex-col items-center p-3 text-center hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700">New Purchase</span>
                </a>
                <button class="flex flex-col items-center p-3 text-center hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700">Payment</span>
                </button>
                <a href="{{ route('sales.reports') }}" class="flex flex-col items-center p-3 text-center hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700">Sales Report</span>
                </a>
                <button class="flex flex-col items-center p-3 text-center hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700">Add Customer</span>
                </button>
                <button class="flex flex-col items-center p-3 text-center hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a3 3 0 003 3h0a3 3 0 003-3v-1m3-10V4a2 2 0 00-2-2H8a2 2 0 00-2 2v3m0 0h8m-8 0l1 7h6l1-7"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700">Inventory</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Business Activities -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Recent Business Activities</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">New Order Received</p>
                                <p class="text-xs text-gray-500">Order #1234 for $2,450 from ABC Company</p>
                                <p class="text-xs text-gray-400">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Payment Received</p>
                                <p class="text-xs text-gray-500">$5,200 payment from XYZ Corporation</p>
                                <p class="text-xs text-gray-400">1 day ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Stock Updated</p>
                                <p class="text-xs text-gray-500">150 units of Product A added to inventory</p>
                                <p class="text-xs text-gray-400">3 days ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-orange-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">New Customer Added</p>
                                <p class="text-xs text-gray-500">Global Trading Ltd registered as wholesale client</p>
                                <p class="text-xs text-gray-400">1 week ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-red-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Supplier Invoice</p>
                                <p class="text-xs text-gray-500">Invoice #789 from Main Supplier for $8,750</p>
                                <p class="text-xs text-gray-400">2 weeks ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Business Alerts & Performance -->
        <div class="space-y-6">
            <!-- Business Alerts -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Business Alerts</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="p-3 bg-red-50 border-l-4 border-red-400 rounded">
                            <p class="text-sm font-medium text-red-900">Low Stock Alert</p>
                            <p class="text-xs text-red-700 mt-1">Product B: Only 5 units remaining</p>
                            <p class="text-xs text-red-600 mt-1">2 hours ago</p>
                        </div>
                        <div class="p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                            <p class="text-sm font-medium text-yellow-900">Pending Payment</p>
                            <p class="text-xs text-yellow-700 mt-1">Customer ABC: $3,200 overdue 5 days</p>
                            <p class="text-xs text-yellow-600 mt-1">1 day ago</p>
                        </div>
                        <div class="p-3 bg-blue-50 border-l-4 border-blue-400 rounded">
                            <p class="text-sm font-medium text-blue-900">New Supplier</p>
                            <p class="text-xs text-blue-700 mt-1">Premium Materials Ltd approved as supplier</p>
                            <p class="text-xs text-blue-600 mt-1">3 days ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Performance -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Monthly Performance</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm text-gray-600">Sales Target</span>
                                <span class="text-sm font-medium">$50,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 90%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">90% Achieved ($45,280)</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm text-gray-600">Customer Acquisition</span>
                                <span class="text-sm font-medium">50 new</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 90%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">45 new customers (90%)</p>
                        </div>
                        <div class="pt-2 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Profit Margin</span>
                                <span class="text-sm font-medium text-green-600">22.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
