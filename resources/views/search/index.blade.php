@extends('layouts.app')

@section('title', 'Search Results - Business Management System')

@section('content')
<div class="p-4 lg:p-6">
    <!-- Search Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Search Results</h1>
        @if(request('q'))
            <p class="text-gray-600">Showing results for: <span class="font-medium">"{{ request('q') }}"</span></p>
        @else
            <p class="text-gray-600">Please enter a search term</p>
        @endif
    </div>

    <!-- Search Form -->
    <div class="mb-6">
        <form method="GET" action="{{ route('search') }}" class="max-w-2xl">
            <div class="relative">
                <input type="text" 
                       name="q" 
                       placeholder="Search products, customers, orders, reports..." 
                       value="{{ request('q') }}"
                       class="w-full px-4 py-3 pl-12 pr-20 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 placeholder-gray-500">
                <svg class="absolute left-4 top-3.5 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <button type="submit" class="absolute right-3 top-2.5 px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- Search Results -->
    @if(request('q'))
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Search functionality coming soon</h3>
                <p class="text-gray-500">Advanced search features will be implemented in the next update.</p>
            </div>
        </div>
    @endif
</div>
@endsection
