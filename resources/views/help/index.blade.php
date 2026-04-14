@extends('layouts.app')

@section('title', 'Help Center - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Help Center</h1>
                <p class="text-gray-600 mt-1">Find answers to your questions and get support</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Contact Support
                </button>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="relative max-w-2xl mx-auto">
            <input type="text" placeholder="Search for help articles, tutorials, and guides..." 
                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Getting Started</h3>
                    <p class="text-sm text-gray-600 mb-4">Learn the basics and set up your account</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Articles</a>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">User Guide</h3>
                    <p class="text-sm text-gray-600 mb-4">Complete documentation for all features</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Guide</a>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Video Tutorials</h3>
                    <p class="text-sm text-gray-600 mb-4">Watch step-by-step video guides</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Watch Videos</a>
                </div>
            </div>

            <!-- Popular Articles -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Popular Articles</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900 mb-1">How to add your first product</h4>
                                <p class="text-xs text-gray-500">Learn how to add products to your inventory</p>
                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                    <span>5 min read</span>
                                    <span class="mx-2">·</span>
                                    <span>1.2k views</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900 mb-1">Creating and managing invoices</h4>
                                <p class="text-xs text-gray-500">Complete guide to invoice management</p>
                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                    <span>8 min read</span>
                                    <span class="mx-2">·</span>
                                    <span>856 views</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900 mb-1">Understanding financial reports</h4>
                                <p class="text-xs text-gray-500">How to read and analyze your financial data</p>
                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                    <span>12 min read</span>
                                    <span class="mx-2">·</span>
                                    <span>642 views</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900 mb-1">Managing user accounts and permissions</h4>
                                <p class="text-xs text-gray-500">Set up user roles and access control</p>
                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                    <span>10 min read</span>
                                    <span class="mx-2">·</span>
                                    <span>523 views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Frequently Asked Questions</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-4 py-3 text-left flex items-center justify-between hover:bg-gray-50">
                                <span class="text-sm font-medium text-gray-900">How do I reset my password?</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                                <p class="text-sm text-gray-600">Click on "Forgot Password" on the login page and follow the instructions sent to your email.</p>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-4 py-3 text-left flex items-center justify-between hover:bg-gray-50">
                                <span class="text-sm font-medium text-gray-900">What payment methods do you accept?</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-4 py-3 text-left flex items-center justify-between hover:bg-gray-50">
                                <span class="text-sm font-medium text-gray-900">How do I export my data?</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-4 py-3 text-left flex items-center justify-between hover:bg-gray-50">
                                <span class="text-sm font-medium text-gray-900">Can I customize the dashboard?</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Categories</h3>
                </div>
                <div class="p-6">
                    <ul class="space-y-2">
                        <li><a href="#" class="flex items-center justify-between p-2 text-sm text-gray-700 hover:bg-gray-50 rounded">
                            <span>Getting Started</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">12</span>
                        </a></li>
                        <li><a href="#" class="flex items-center justify-between p-2 text-sm text-gray-700 hover:bg-gray-50 rounded">
                            <span>Account Management</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">8</span>
                        </a></li>
                        <li><a href="#" class="flex items-center justify-between p-2 text-sm text-gray-700 hover:bg-gray-50 rounded">
                            <span>Billing & Payments</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">15</span>
                        </a></li>
                        <li><a href="#" class="flex items-center justify-between p-2 text-sm text-gray-700 hover:bg-gray-50 rounded">
                            <span>Products & Inventory</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">23</span>
                        </a></li>
                        <li><a href="#" class="flex items-center justify-between p-2 text-sm text-gray-700 hover:bg-gray-50 rounded">
                            <span>Sales & Invoicing</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">18</span>
                        </a></li>
                        <li><a href="#" class="flex items-center justify-between p-2 text-sm text-gray-700 hover:bg-gray-50 rounded">
                            <span>Reports & Analytics</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">10</span>
                        </a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Need More Help?</h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-4">Can't find what you're looking for? Our support team is here to help.</p>
                    <div class="space-y-3">
                        <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                            Start Live Chat
                        </button>
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                            Email Support
                        </button>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">Response time: Usually within 2 hours</p>
                        <p class="text-xs text-gray-500">Available: Mon-Fri, 9AM-6PM EAT</p>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">System Status</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                        <span class="text-sm font-medium text-gray-900">All Systems Operational</span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">API Services</span>
                            <span class="text-green-600">Online</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Database</span>
                            <span class="text-green-600">Online</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Email Services</span>
                            <span class="text-green-600">Online</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Payment Gateway</span>
                            <span class="text-green-600">Online</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="#" class="text-xs text-blue-600 hover:text-blue-800">View detailed status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
