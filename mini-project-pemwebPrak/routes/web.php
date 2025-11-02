<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route yang berhubungan dengan tampilan web ada di sini.
| Middleware 'web' otomatis aktif (karena diatur di bootstrap/app.php),
| dan SessionTimeout juga udah global, jadi gak perlu ditulis manual lagi.
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// ==================== AUTH ==================== //
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== DASHBOARD + CRUD ITEMS ==================== //
// Middleware 'auth' wajib login
// Middleware SessionTimeout aktif otomatis (global di bootstrap/app.php)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('items', ItemController::class);
});