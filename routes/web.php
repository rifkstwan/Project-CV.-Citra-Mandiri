<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminDashboardController,
    OrdersController,
    UserDashboardController,
    ProfileController,
    PermissionController,
    RoleController,
    UserController,
    PaketController,
    MessageController,
    DeviceController,
    MonitoringController,
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PaketController::class, 'showGuestPackages'])->name('guest.dashboard');

/*
|--------------------------------------------------------------------------
| User Dashboard Routes (Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.index');
});

/*
|--------------------------------------------------------------------------
| Shared Routes (Admin & User dapat akses)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'permission:admin-access|user-access', 'verified'])->group(function () {
    // Transactions
    Route::get('/transactions', [OrdersController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/{orderId}', [OrdersController::class, 'detailTransaction']);
    Route::get('/transactions/sync/{id}', [OrdersController::class, 'syncTransaction'])->name('transactions.sync');
    Route::get('/admin/transactions/pdf', [OrdersController::class, 'exportPdf'])->name('transactions.pdf');
});

/*
|--------------------------------------------------------------------------
| Admin Only Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'permission:admin-access', 'verified'])->group(function () {

    // ===== DASHBOARD =====
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin.index');

    // ===== PERMISSIONS =====
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/', [PermissionController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::post('/{id}', [PermissionController::class, 'update'])->name('update');
        Route::delete('/', [PermissionController::class, 'destroy'])->name('destroy');
    });

    // ===== ROLES =====
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::post('/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/', [RoleController::class, 'destroy'])->name('destroy');
    });

    // ===== USERS & CUSTOMERS (GABUNGAN) =====
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/', [UserController::class, 'destroy'])->name('destroy');

        // ===== PDF ROUTES =====
        Route::get('/pdf', [UserController::class, 'exportPdf'])->name('pdf'); // Semua users
        Route::get('/customers/pdf', [UserController::class, 'exportCustomersPdf'])->name('customers.pdf'); // Khusus customer
    });

    // ===== HAPUS MENU CUSTOMERS (sudah digabung ke Users) =====
    // Route::prefix('customers')->name('customers.')->group(function () {
    //     Route::get('/', [CustomerController::class, 'index'])->name('index');
    //     Route::get('/pdf', [CustomerController::class, 'exportPdf'])->name('pdf');
    // });

    // ===== PAKETS (Admin Only - CRUD) =====
    Route::prefix('pakets')->name('pakets.')->group(function () {
        Route::get('/', [PaketController::class, 'index'])->name('index');
        Route::get('/create', [PaketController::class, 'create'])->name('create');
        Route::post('/', [PaketController::class, 'store'])->name('store');
        Route::get('/{paket}/edit', [PaketController::class, 'edit'])->name('edit');
        Route::put('/{paket}', [PaketController::class, 'update'])->name('update');
        Route::delete('/{paket}', [PaketController::class, 'destroy'])->name('destroy');
    });

    // ===== TRANSACTIONS (Admin Only) =====
    Route::post('/transactions/notification', [OrdersController::class, 'notificationHandler']);

    // ===== ORDERS - ADMIN ACTIONS =====
    Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
        Route::post('/{id}/mark-activated', [OrdersController::class, 'markActivated'])->name('markActivated');
        Route::post('/{id}/confirm-payment', [OrdersController::class, 'confirmPayment'])->name('confirmPayment');
        Route::post('/mark-all-activated', [OrdersController::class, 'markAllActivated'])->name('markAllActivated');
    });

    // ===== FONNTE - MESSAGES & DEVICES =====
    Route::resource('messages', MessageController::class);
    Route::resource('devices', DeviceController::class);

    Route::prefix('devices')->name('devices.')->group(function () {
        Route::post('/status', [DeviceController::class, 'checkDeviceStatus']);
        Route::post('/activate', [DeviceController::class, 'activateDevice'])->name('activate');
        Route::post('/disconnect', [DeviceController::class, 'disconnect'])->name('disconnect');
    });

    Route::post('send-message', [DeviceController::class, 'sendMessage'])->name('send.message');

    // ===== MONITORING =====
    Route::prefix('monitorings')->name('monitorings.')->group(function () {
        Route::get('/', [MonitoringController::class, 'index'])->name('index');
        Route::get('/stats', [MonitoringController::class, 'stats'])->name('stats');
        Route::post('/connect', [MonitoringController::class, 'connect'])->name('connect');
    });
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (User Biasa & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ===== PROFILE =====
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/profile-photos', [ProfileController::class, 'deletePhoto'])->name('delete-photo');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // ===== PAKET - USER BISA LIHAT & BELI =====
    Route::get('/paket', [PaketController::class, 'userIndex'])->name('user.pakets.index');
    Route::get('/paket/{id}', [PaketController::class, 'show'])->name('pakets.show');
    Route::get('/paket/{id}/pembayaran', [PaketController::class, 'pembayaran'])->name('pakets.pembayaran');
    Route::post('/Checkout', [OrdersController::class, 'checkout'])->name('pakets.checkout');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
