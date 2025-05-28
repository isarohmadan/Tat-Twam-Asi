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
use App\Http\Controllers\Admin\BiodataController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserKegiatanController;
use App\Http\Controllers\User\UserKunjunganController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/berita/{id}', [UserController::class, 'show'])->name('berita.show');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Group routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

    // Admin routes dengan FQCN (tanpa alias)
    Route::prefix('admin')
        ->name('admin.')
        ->middleware([AdminMiddleware::class])
        ->group(function () {

            //anak
            Route::get('/dataanak', [AnakController::class, 'index'])->name('anak.dataanak');
            Route::get('/tambahanak', [AnakController::class, 'create'])->name('anak.tambahanak');
            Route::post('/anak', [AnakController::class, 'store'])->name('anak.store');
            Route::put('/anak/update/{id}', [AnakController::class, 'update'])->name('anak.update');
            Route::delete('/anak/{id}', [AnakController::class, 'destroy'])->name('anak.destroy');
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
            Route::get('/keseluruhandata', [KeseluruhanDataController::class, 'index'])->name('keseluruhandata');
            });

       Route::prefix('beritas')->middleware([AdminMiddleware::class])
        ->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('beritas.index');
    Route::post('/', [BeritaController::class, 'store'])->name('beritas.store');
    Route::put('/{id}', [BeritaController::class, 'update'])->name('beritas.update');
    Route::delete('/{id}', action: [BeritaController::class, 'destroy'])->name('beritas.destroy');
});

    Route::prefix('banners')->middleware([AdminMiddleware::class])
        ->group(function () {
            Route::get('/', [BannerControllerNew::class, 'index'])->name('banners.index');
            Route::post('/', [BannerControllerNew::class, 'store'])->name('banners.store');
            Route::put('/{id}', [BannerControllerNew::class, 'update'])->name('banners.update');
            Route::delete('/{id}', action: [BannerControllerNew::class, 'destroy'])->name('banners.destroy');
        });

    Route::prefix('admin/kegiatan')->middleware([AdminMiddleware::class])
        ->name('admin.kegiatan.')
        ->group(function () {
            Route::get('/', [KegiatanController::class, 'index'])->name('index');
            Route::post('/approve/{id}', [KegiatanController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}', [KegiatanController::class, 'reject'])->name('reject');
        });
    Route::prefix('admin/kunjungan')->middleware([AdminMiddleware::class])
        ->name('admin.kunjungan.')
        ->group(function () {
            Route::get('/', [KunjunganController::class, 'index'])->name('index');
            Route::post('/approve/{id}', [KunjunganController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}', [KunjunganController::class, 'reject'])->name('reject');
        });


    // User routes dengan FQCN juga (jika middleware UserMiddleware tidak didaftarkan)
    Route::prefix('user')->name('user.')->middleware([UserMiddleware::class])
        ->group(function () {
            Route::get('/userkegiatan', [UserKegiatanController::class, 'index'])->name('userkegiatan');
            Route::get('/tambahpengajuankegiatan', [UserKegiatanController::class, 'create'])->name('tambahpengajuankegiatan'); // Diubah
            Route::post('/tambahpengajuankegiatan', [UserKegiatanController::class, 'store'])->name('storekegiatan');


            Route::get('/userkunjungan', [UserKunjunganController::class, 'index'])->name('userkunjungan');
            Route::get('/tambahpengajuankunjungan', [UserKunjunganController::class, 'create'])->name('tambahpengajuankunjungan');
            Route::post('/tambahpengajuankunjungan', [UserKunjunganController::class, 'store'])->name('storekunjungan');
        });
});
