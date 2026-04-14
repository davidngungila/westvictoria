<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Simple login logic for demonstration
    $email = request('email');
    $password = request('password');
    
    // For demo purposes, accept any email/password
    // In production, implement proper authentication
    if ($email && $password) {
        return redirect('/dashboard');
    }
    
    return back()->with('error', 'Invalid credentials');
})->name('login.submit');

Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');

// Password Reset Routes
Route::get('/password/reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/password/email', function () {
    $email = request('email');
    
    // For demo purposes, just show success message
    // In production, implement actual password reset email sending
    return back()->with('status', 'Password reset link has been sent to your email.');
})->name('password.email');

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Products Routes
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/products/create', function () {
    return view('products.create');
})->name('products.create');

Route::get('/products/{id}', function ($id) {
    return view('products.show');
})->name('products.show');

Route::get('/products/{id}/edit', function ($id) {
    return view('products.edit');
})->name('products.edit');

// Sales Routes
Route::get('/sales/dashboard', function () {
    return view('sales.dashboard');
})->name('sales.dashboard');

Route::get('/sales/retail', function () {
    return view('sales.retail');
})->name('sales.retail');

Route::get('/sales/wholesale', function () {
    return view('sales.wholesale');
})->name('sales.wholesale');

Route::get('/sales/reports', function () {
    return view('sales.reports');
})->name('sales.reports');

// Purchases Routes
Route::get('/purchases/dashboard', function () {
    return view('purchases.dashboard');
})->name('purchases.dashboard');

Route::get('/purchases/orders', function () {
    return view('purchases.orders');
})->name('purchases.orders');

Route::get('/purchases/create', function () {
    return view('purchases.create');
})->name('purchases.create');

Route::get('/purchases/suppliers', function () {
    return view('purchases.suppliers');
})->name('purchases.suppliers');

// Inventory Routes
Route::get('/inventory/dashboard', function () {
    return view('inventory.dashboard');
})->name('inventory.dashboard');

Route::get('/inventory/stock', function () {
    return view('inventory.stock');
})->name('inventory.stock');

Route::get('/inventory/warehouses', function () {
    return view('inventory.warehouses');
})->name('inventory.warehouses');

// Customers Routes
Route::get('/customers/dashboard', function () {
    return view('customers.dashboard');
})->name('customers.dashboard');

Route::get('/customers/management', function () {
    return view('customers.management');
})->name('customers.management');

// Suppliers Routes
Route::get('/suppliers/dashboard', function () {
    return view('suppliers.dashboard');
})->name('suppliers.dashboard');

Route::get('/suppliers/management', function () {
    return view('suppliers.management');
})->name('suppliers.management');

// Payments Routes
Route::get('/payments/dashboard', function () {
    return view('payments.dashboard');
})->name('payments.dashboard');

Route::get('/payments/management', function () {
    return view('payments.management');
})->name('payments.management');

// Reports Routes
Route::get('/reports/dashboard', function () {
    return view('reports.dashboard');
})->name('reports.dashboard');

Route::get('/reports/management', function () {
    return view('reports.management');
})->name('reports.management');

// Quotation Routes
Route::get('/quotation/dashboard', function () {
    return view('quotation.dashboard');
})->name('quotation.dashboard');

Route::get('/quotation/management', function () {
    return view('quotation.management');
})->name('quotation.management');

// Invoice Routes
Route::get('/invoice/dashboard', function () {
    return view('invoice.dashboard');
})->name('invoice.dashboard');

Route::get('/invoice/management', function () {
    return view('invoice.management');
})->name('invoice.management');

// Expense Routes
Route::get('/expense/dashboard', function () {
    return view('expense.dashboard');
})->name('expense.dashboard');

Route::get('/expense/management', function () {
    return view('expense.management');
})->name('expense.management');

// Settings Routes
Route::get('/settings/dashboard', function () {
    return view('settings.dashboard');
})->name('settings.dashboard');

Route::get('/settings/management', function () {
    return view('settings.management');
})->name('settings.management');

// Users Routes
Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->name('users.dashboard');

Route::get('/users/management', function () {
    return view('users.management');
})->name('users.management');

// Profile Routes
Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');

// Billing Routes
Route::get('/billing', function () {
    return view('billing.index');
})->name('billing.index');

// Help Routes
Route::get('/help', function () {
    return view('help.index');
})->name('help.index');

Route::get('/registered-courses', function () {
    return view('registered-courses');
})->name('registered-courses');
