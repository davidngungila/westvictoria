@extends('layouts.app')

@section('title', 'My Profile - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Success Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">My Profile</h1>
                <p class="text-gray-600 mt-1">Manage your personal information and preferences</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Personal Information</h3>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ $user->phone ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <select name="department" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Management" {{ $user->department == 'Management' ? 'selected' : '' }}>Management</option>
                                <option value="Sales" {{ $user->department == 'Sales' ? 'selected' : '' }}>Sales</option>
                                <option value="Purchases" {{ $user->department == 'Purchases' ? 'selected' : '' }}>Purchases</option>
                                <option value="Inventory" {{ $user->department == 'Inventory' ? 'selected' : '' }}>Inventory</option>
                                <option value="Finance" {{ $user->department == 'Finance' ? 'selected' : '' }}>Finance</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                            <input type="text" name="position" value="{{ $user->position ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Security Settings -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Security Settings</h3>
                </div>
                <form method="POST" action="{{ route('profile.password.update') }}" class="p-6">
                    @csrf
                    @error('current_password')
                        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" name="current_password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Two-Factor Authentication</label>
                                <p class="text-xs text-gray-500">Add extra security to your account</p>
                            </div>
                            <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200" disabled>
                                <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-1"></span>
                            </button>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Preferences -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Preferences</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
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
                                <label class="text-sm font-medium text-gray-700">Dark Mode</label>
                                <p class="text-xs text-gray-500">Use dark theme for the interface</p>
                            </div>
                            <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200">
                                <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-1"></span>
                            </button>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option selected>English</option>
                                <option>Swahili</option>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Picture -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Profile Picture</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden mb-4">
                            <img src="{{ $user->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <form method="POST" action="{{ route('profile.picture.update') }}" enctype="multipart/form-data" class="mb-2">
                            @csrf
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="image/*" onchange="this.form.submit()">
                            <button type="button" onclick="document.getElementById('profile_picture').click()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm mb-2">
                                Upload Photo
                            </button>
                        </form>
                        @if($user->profile_picture)
                            <form method="POST" action="{{ route('profile.picture.remove') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                                    Remove Photo
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Account Statistics -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Account Statistics</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Member Since</span>
                            <span class="text-sm font-bold text-gray-900">{{ $statistics['member_since'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Last Login</span>
                            <span class="text-sm font-bold text-gray-900">{{ $statistics['last_login'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Logins</span>
                            <span class="text-sm font-bold text-gray-900">{{ $statistics['total_logins'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Account Status</span>
                            <span class="text-sm font-bold {{ $statistics['account_status'] == 'Active' ? 'text-green-600' : 'text-red-600' }}">{{ $statistics['account_status'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800" style="font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-3">
                    <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                        Download Profile Data
                    </button>
                    <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                        Export Activity Log
                    </button>
                    <button class="w-full px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition-colors text-sm">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
