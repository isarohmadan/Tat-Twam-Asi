<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnakController;
use App\Http\Controllers\Admin\BannerControllerNew;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KeseluruhanDataController;
use App\Http\Controllers\Admin\KunjunganController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserKegiatanController;
use App\Http\Controllers\User\UserKunjunganController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

Route::get('/', function () {
    return view('user.home');
})->name('home');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', [UserController::class, 'index'])->name('home');

// Group routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

    // Admin routes dengan FQCN (tanpa alias)
    Route::prefix('admin')
        ->name('admin.')
        ->middleware([AdminMiddleware::class])
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
            Route::get('/keseluruhandata', [KeseluruhanDataController::class, 'index'])->name('keseluruhandata');
            Route::get('/dataanak', [AnakController::class, 'index'])->name('dataanak');
            Route::get('/tambahanak', [AnakController::class, 'create'])->name('tambahanak');
            Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan');
            Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
            Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
            Route::get('/tambahberita', [BeritaController::class, 'create'])->name('tambahberita');
            
        });

    // User routes dengan FQCN juga (jika middleware UserMiddleware tidak didaftarkan)
    Route::prefix('user')->name('user.')
        ->group(function () {
            Route::get('/userkegiatan', [UserKegiatanController::class, 'index'])->name('userkegiatan');
            Route::get('/tambahsuratkegiatan', [UserKegiatanController::class, 'create'])->name('tambahsuratkegiatan');
            Route::get('/userkunjungan', [UserKunjunganController::class, 'index'])->name('userkunjungan');
            Route::get('/tambahsuratkunjungan', [UserKunjunganController::class, 'create'])->name('tambahsuratkunjungan');
        });

        Route::middleware(['auth'])->group(function () {
            // Banner Routes
            Route::prefix('banners')->group(function () {
                Route::get('/', [BannerControllerNew::class, 'index'])->name('banners.index');
                Route::post('/', [BannerControllerNew::class, 'store'])->name('banners.store');
                Route::put('/{id}', [BannerControllerNew::class, 'update'])->name('banners.update');
                Route::delete('/{id}', [BannerControllerNew::class, 'destroy'])->name('banners.destroy');
            });
        });
        
});
