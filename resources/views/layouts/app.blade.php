<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Business Management System')</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Manrope:wght@200..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased" style="font-family: 'Lato', ui-sans-serif, system-ui, sans-serif;">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="lg:relative lg:translate-x-0 fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
            <!-- Mobile close button -->
            <button id="closeSidebar" class="lg:hidden absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Company Profile Section (Fixed) -->
            <div class="p-6 text-center border-b border-gray-700 flex-shrink-0">
                <div class="w-20 h-20 mx-auto mb-3 rounded-lg overflow-hidden bg-gray-300">
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium">Business System</p>
                <p class="text-xs text-gray-400">Management Portal</p>
            </div>
            
            <!-- Navigation (Scrollable) -->
            <nav class="p-4 flex-1 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('products.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>Products</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <button onclick="toggleDropdown('sales-dropdown')" class="w-full flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('sales.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors text-left">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span>Sales</span>
                            </div>
                            <svg id="sales-chevron" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <ul id="sales-dropdown" class="hidden mt-2 ml-4 space-y-1">
                            <li><a href="{{ route('sales.pos') }}" class="block px-4 py-2 text-sm font-semibold {{ request()->routeIs('sales.pos') ? 'text-white bg-blue-600' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} rounded">New Sale (POS)</a></li>
                            <li><a href="{{ route('sales.pricing') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('sales.pricing') ? 'text-white bg-gray-700' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} rounded">Pricing</a></li>
                            <li><a href="{{ route('sales.dashboard') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('sales.dashboard') ? 'text-white bg-gray-700' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} rounded">Sales Dashboard</a></li>
                            <li><a href="{{ route('sales.reports') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('sales.reports') ? 'text-white bg-gray-700' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} rounded">Sales Reports</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('purchases.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('purchases.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span>Purchases</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inventory.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('inventory.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>Inventory</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customers.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('customers.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Customers</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('suppliers.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('suppliers.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>Suppliers</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payments.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('payments.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Payments</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('reports.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a3 3 0 003 3h0a3 3 0 003-3v-1m3-10V4a2 2 0 00-2-2H8a2 2 0 00-2 2v3m0 0h8m-8 0l1 7h6l1-7"></path>
                                </svg>
                                <span>Reports</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quotation.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('quotation.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Quotation</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('invoice.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('invoice.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h13m-13-1l1.395-3.72C3.512 7.048 3.813 6.5 4.3 6.5h11.4c.487 0 .788.548 1.405 1.28L18.5 13.5m-13 0l1.395 3.72C7.048 16.952 7.349 17.5 7.836 17.5h11.4c.487 0 .788-.548 1.405-1.28L21.5 13.5m-13 0V7.5c0-.828.672-1.5 1.5-1.5S11 6.672 11 7.5v6m-8 0v6c0 .828.672 1.5 1.5 1.5s1.5-.672 1.5-1.5v-6"></path>
                                </svg>
                                <span>Invoice</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('expense.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('expense.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Expense</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('settings.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('settings.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-1.543-.94-3.31.826-2.37-2.37a1.724 1.724 0 00-2.572-1.065c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 00-1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Settings</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('users.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }} transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span>Users</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Advanced Header (Static/Fixed) -->
            <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg flex-shrink-0">
                <!-- Main Header -->
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center flex-1">
                            <button id="openSidebar" class="lg:hidden mr-4 text-white hover:text-gray-300 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <button id="desktopMenuToggle" class="hidden lg:block mr-4 text-white hover:text-gray-300 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            
                            <!-- Logo and Title -->
                            <div class="flex items-center">
                               
                                <div>
                                    <h1 class="text-xl font-semibold" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">
                                        @if(request()->routeIs('dashboard'))
                                            Dashboard
                                        @elseif(request()->routeIs('products.*'))
                                            Products
                                        @elseif(request()->routeIs('sales.*'))
                                            Sales
                                        @elseif(request()->routeIs('purchases.*'))
                                            Purchases
                                        @elseif(request()->routeIs('inventory.*'))
                                            Inventory
                                        @elseif(request()->routeIs('customers.*'))
                                            Customers
                                        @elseif(request()->routeIs('suppliers.*'))
                                            Suppliers
                                        @elseif(request()->routeIs('payments.*'))
                                            Payments
                                        @elseif(request()->routeIs('reports.*'))
                                            Reports
                                        @elseif(request()->routeIs('quotation.*'))
                                            Quotation
                                        @elseif(request()->routeIs('invoice.*'))
                                            Invoice
                                        @elseif(request()->routeIs('expense.*'))
                                            Expense
                                        @elseif(request()->routeIs('settings.*'))
                                            Settings
                                        @elseif(request()->routeIs('users.*'))
                                            Users
                                        @elseif(request()->routeIs('profile.*'))
                                            Profile
                                        @elseif(request()->routeIs('billing.*'))
                                            Billing
                                        @elseif(request()->routeIs('help.*'))
                                            Help
                                        @else
                                            {{ ucfirst(request()->path()) }}
                                        @endif
                                    </h1>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Search Bar - Centered -->
                        <div class="hidden md:flex flex-1 max-w-lg justify-center">
                            <div class="relative w-full">
                                <form method="GET" action="{{ route('search') }}" class="w-full">
                                    <input type="text" 
                                           name="q" 
                                           placeholder="Search products, customers, orders, reports..." 
                                           value="{{ request('q') }}"
                                           class="w-full px-4 py-2 pl-12 pr-20 text-sm text-gray-900 bg-white bg-opacity-90 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 placeholder-gray-500">
                                    <svg class="absolute left-4 top-2.5 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <button type="submit" class="absolute right-3 top-1.5 px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Right Side Actions -->
                        <div class="flex items-center space-x-4">
                            <!-- Mobile Search -->
                            <button class="md:hidden text-white hover:text-gray-300 transition-colors p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                            
                            <!-- Notification Center -->
                            <div class="relative">
                                <button onclick="toggleNotificationCenter()" class="text-white hover:text-gray-300 transition-colors relative p-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    @if(($unreadNotificationsCount ?? 0) > 0)
                                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 animate-pulse"></span>
                                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $unreadNotificationsCount }}</span>
                                    @endif
                                </button>
                                <div id="notificationCenter" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50">
                                    <div class="p-3 border-b border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                                            <button class="text-xs text-purple-600 hover:text-purple-700">Mark all read</button>
                                        </div>
                                    </div>
                                    <div class="max-h-96 overflow-y-auto">
                                        <div class="p-3 hover:bg-gray-50 border-b border-gray-100">
                                            <div class="flex items-start">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-gray-900">New Order Received</p>
                                                    <p class="text-xs text-gray-500">Order #1234 for TZS 450,000 from ABC Company</p>
                                                    <p class="text-xs text-gray-400">2 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 hover:bg-gray-50 border-b border-gray-100">
                                            <div class="flex items-start">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Payment Received</p>
                                                    <p class="text-xs text-gray-500">TZS 2,200,000 payment from XYZ Corporation</p>
                                                    <p class="text-xs text-gray-400">1 day ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 hover:bg-gray-50">
                                            <div class="flex items-start">
                                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Low Stock Alert</p>
                                                    <p class="text-xs text-gray-500">Wireless Mouse: Only 3 units remaining</p>
                                                    <p class="text-xs text-gray-400">3 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 border-t border-gray-200">
                                        <button class="w-full text-center text-xs text-purple-600 hover:text-purple-700 font-medium">View all notifications</button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Advanced User Profile Dropdown -->
                            <div class="relative">
                                @if(Auth::check())
                                <button onclick="toggleUserMenu()" class="flex items-center text-white hover:text-gray-300 transition-colors">
                                    <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-300 mr-2">
                                        <img src="{{ Auth::user()->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                                        <p class="text-xs opacity-90">{{ Auth::user()->role ?? 'User' }}</p>
                                    </div>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="userMenu" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-50">
                                    <!-- User Info Section -->
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full overflow-hidden">
                                                <img src="{{ Auth::user()->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                                <p class="text-xs text-green-600">Active</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Menu Items -->
                                    <div class="py-1">
                                        <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            My Profile
                                        </a>
                                        <a href="{{ route('settings.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Settings
                                        </a>
                                        <a href="{{ route('settings.dashboard') }}#system" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            System Settings
                                        </a>
                                        <a href="{{ route('billing.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Billing & Payments
                                        </a>
                                        <hr class="my-1">
                                        <a href="{{ route('help.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Help Center
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}" class="inline">
                                            @csrf
                                            <button type="submit" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                Log out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @else
                                <a href="{{ route('login') }}" class="flex items-center text-white hover:text-gray-300 transition-colors">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                                    </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-white flex flex-col">
                <div class="flex-1">
                    @yield('content')
                </div>
                
                <!-- Footer -->
                <footer class="bg-gray-800 text-white py-4 px-4 border-t border-gray-700 mt-auto">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center">
                            <p class="text-sm">© {{ date('Y') }} West Victoria BMS. All rights reserved. Empowering businesses through smart management solutions.</p>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <script>
        // Mobile sidebar toggle
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopMenuToggle = document.getElementById('desktopMenuToggle');

        openSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Desktop sidebar toggle
        desktopMenuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Dropdown toggle function
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const chevron = document.getElementById(dropdownId.replace('-dropdown', '-chevron'));
            
            dropdown.classList.toggle('hidden');
            chevron.classList.toggle('rotate-90');
        }

        // User menu toggle
        function toggleUserMenu() {
            const userMenu = document.getElementById('userMenu');
            userMenu.classList.toggle('hidden');
        }

        
        // Notification center toggle
        function toggleNotificationCenter() {
            const notificationCenter = document.getElementById('notificationCenter');
            notificationCenter.classList.toggle('hidden');
        }

        
        // Auto-expand dropdowns if active page is in that section
        document.addEventListener('DOMContentLoaded', function() {
            // Check if current route is in sales section
            const currentRoute = window.location.pathname;
            const salesDropdown = document.getElementById('sales-dropdown');
            const salesChevron = document.getElementById('sales-chevron');
            
            // Auto-expand sales dropdown if on any sales page
            if (currentRoute.includes('/sales/') && salesDropdown && salesChevron) {
                salesDropdown.classList.remove('hidden');
                salesChevron.classList.add('rotate-90');
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('[onclick*="toggleDropdown"]') && !event.target.closest('[id*="-dropdown"]')) {
                document.querySelectorAll('[id*="-dropdown"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
                document.querySelectorAll('[id*="-chevron"]').forEach(chevron => {
                    chevron.classList.remove('rotate-90');
                });
            }
            
            if (!event.target.closest('[onclick*="toggleUserMenu"]') && !event.target.closest('#userMenu')) {
                document.getElementById('userMenu').classList.add('hidden');
            }
            
            if (!event.target.closest('[onclick*="toggleNotificationCenter"]') && !event.target.closest('#notificationCenter')) {
                document.getElementById('notificationCenter').classList.add('hidden');
            }
        });
    </script>

    <!-- Toast Notifications -->
    @include('components.toast')

    </body>
</html>
