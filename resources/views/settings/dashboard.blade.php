@extends('layouts.app')

@section('title', 'Settings Dashboard - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Settings Dashboard</h1>
                <p class="text-gray-600 mt-1">System configuration and preferences management</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-1.543-.94-3.31.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-2.572-1.065c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 00-1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    System Settings
                </button>
                <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Settings
                </button>
            </div>
        </div>
    </div>

    <!-- Settings Overview Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">System Status</p>
                    <p class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">Healthy</p>
                    <p class="text-xs text-green-600">All systems operational</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Users</p>
                    <p class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">12</p>
                    <p class="text-xs text-blue-600">Currently online</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="#9CA3AF" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Database Size</p>
                    <p class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">2.4 GB</p>
                    <p class="text-xs text-orange-600">Growing slowly</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Last Backup</p>
                    <p class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; font-weight: 700;">2 hrs</p>
                    <p class="text-xs text-green-600">Successful</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12m0 0h12"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- System Settings -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">System Configuration</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <!-- General Settings -->
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">General Settings</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                                    <input type="text" value="West Victoria Business Ltd" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option selected>TZS - Tanzanian Shilling</option>
                                        <option>USD - US Dollar</option>
                                        <option>EUR - Euro</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Time Zone</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option selected>Africa/Dar es Salaam</option>
                                        <option>Africa/Nairobi</option>
                                        <option>UTC</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option selected>English</option>
                                        <option>Swahili</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Settings -->
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Notification Settings</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-sm font-medium text-gray-700">Email Notifications</label>
                                        <p class="text-xs text-gray-500">Receive email alerts for important events</p>
                                    </div>
                                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-blue-600">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-6"></span>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-sm font-medium text-gray-700">SMS Notifications</label>
                                        <p class="text-xs text-gray-500">Get SMS alerts for critical updates</p>
                                    </div>
                                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-1"></span>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-sm font-medium text-gray-700">Push Notifications</label>
                                        <p class="text-xs text-gray-500">Browser push notifications</p>
                                    </div>
                                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-blue-600">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-6"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div>
                            <h4 class="text-md font-medium text-gray-900 mb-4">Security Settings</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-sm font-medium text-gray-700">Two-Factor Authentication</label>
                                        <p class="text-xs text-gray-500">Add extra security to your account</p>
                                    </div>
                                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-blue-600">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-6"></span>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-sm font-medium text-gray-700">Session Timeout</label>
                                        <p class="text-xs text-gray-500">Auto-logout after inactivity</p>
                                    </div>
                                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option>30 minutes</option>
                                        <option selected>1 hour</option>
                                        <option>2 hours</option>
                                        <option>4 hours</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Recent System Activity</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">System backup completed successfully</p>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">User John Smith logged in</p>
                                <p class="text-xs text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-orange-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">System settings updated</p>
                                <p class="text-xs text-gray-500">5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Database optimization completed</p>
                                <p class="text-xs text-gray-500">1 day ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Quick Links</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm text-left">
                            User Management
                        </button>
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            Backup & Restore
                        </button>
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            System Logs
                        </button>
                        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-left">
                            API Settings
                        </button>
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">System Information</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Version</span>
                            <span class="text-sm font-bold text-gray-900">v2.4.1</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Environment</span>
                            <span class="text-sm font-bold text-green-600">Production</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Server Uptime</span>
                            <span class="text-sm font-bold text-gray-900">99.9%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Last Update</span>
                            <span class="text-sm font-bold text-gray-900">2 days ago</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Storage Usage -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Storage Usage</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Database</span>
                                <span class="text-sm font-bold text-gray-900">1.2 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 50%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Files</span>
                                <span class="text-sm font-bold text-gray-900">0.8 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 33%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Logs</span>
                                <span class="text-sm font-bold text-gray-900">0.4 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-600 h-2 rounded-full" style="width: 17%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
