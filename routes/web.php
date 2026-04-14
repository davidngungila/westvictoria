<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLink'])->name('password.email');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/users/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
    Route::get('/users/management', [UserController::class, 'index'])->name('users.management');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
    
    Route::get('/settings/dashboard', [SettingsController::class, 'dashboard'])->name('settings.dashboard');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.preferences.update');
    Route::post('/settings/system', [SettingsController::class, 'updateSystem'])->name('settings.system.update');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.picture.update');
    Route::post('/profile/picture/remove', [ProfileController::class, 'removePicture'])->name('profile.picture.remove');
    
    Route::get('/billing', function () {
        return view('billing.index');
    })->name('billing.index');
    
    Route::get('/help', function () {
        return view('help.index');
    })->name('help.index');
    
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Products Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::patch('/products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.status.update');
Route::post('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk.delete');
Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');

// Sales Routes
Route::get('/sales/dashboard', [SaleController::class, 'dashboard'])->name('sales.dashboard');
Route::get('/sales/pos', [SaleController::class, 'pos'])->name('sales.pos');
Route::get('/sales/pricing', [SaleController::class, 'pricing'])->name('sales.pricing');
Route::get('/sales/reports', [SaleController::class, 'reports'])->name('sales.reports');

Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
Route::put('/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
Route::patch('/sales/{sale}/status', [SaleController::class, 'updateStatus'])->name('sales.status.update');
Route::get('/sales/{sale}/invoice', [SaleController::class, 'generateInvoice'])->name('sales.invoice');
Route::get('/sales/{sale}/receipt', [SaleController::class, 'generateReceipt'])->name('sales.receipt');
Route::get('/sales/export', [SaleController::class, 'export'])->name('sales.export');

// Customer CRUD Routes
Route::get('/customers/dashboard', function () {
    return view('customers.dashboard');
})->name('customers.dashboard');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/api/customers/search', [CustomerController::class, 'search'])->name('customers.search');

// Supplier CRUD Routes
Route::get('/suppliers/dashboard', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

// Category CRUD Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Brand CRUD Routes
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

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
Route::get('/settings/dashboard', [SettingsController::class, 'dashboard'])->name('settings.dashboard');
Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
Route::post('/settings/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.preferences.update');
Route::post('/settings/system', [SettingsController::class, 'updateSystem'])->name('settings.system.update');

// Users Routes
Route::get('/users/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
Route::get('/users/management', [UserController::class, 'index'])->name('users.management');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::patch('/users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');

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
