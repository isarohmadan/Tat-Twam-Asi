<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnakController;
use App\Http\Controllers\Admin\BannerControllerNew;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KeseluruhanDataController;
use App\Http\Controllers\Admin\KunjunganController;
use App\Http\Controllers\Admin\BiodataController;

use App\Http\Controllers\KetuaYayasan\KetuaYayasanController;
use App\Http\Controllers\KetuaYayasan\KetuaBannerControllerNew;
use App\Http\Controllers\KetuaYayasan\KetuaBeritaController;
use App\Http\Controllers\KetuaYayasan\KetuaKegiatanController;
use App\Http\Controllers\KetuaYayasan\KetuaKeseluruhanDataController;
use App\Http\Controllers\KetuaYayasan\KetuaKunjunganController;
use App\Http\Controllers\KetuaYayasan\KetuaAnakController;
use App\Http\Controllers\KetuaYayasan\JadwalController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserKegiatanController;
use App\Http\Controllers\User\UserKunjunganController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\KetuaYayasanMiddleware;




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

// Route untuk lupa password
Route::get('forgot-password', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route untuk reset password
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Group routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

 
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
            Route::get('/anak/export', [AnakController::class, 'export'])->name('anak.export');
            Route::get('/anak/export-pdf/{id}', [AnakController::class, 'exportPdf'])->name('anak.exportpdf');
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
        });
    Route::prefix('admin/kunjungan')->middleware([AdminMiddleware::class])
        ->name('admin.kunjungan.')
        ->group(function () {
            Route::get('/', [KunjunganController::class, 'index'])->name('index');
        });





    // User routes dengan FQCN juga (jika middleware UserMiddleware tidak didaftarkan)
    Route::prefix('user')->name('user.')->middleware([UserMiddleware::class])
        ->group(function () {
            Route::get('/userkegiatan', [UserKegiatanController::class, 'index'])->name('userkegiatan');
            Route::get('/tambahpengajuankegiatan', [UserKegiatanController::class, 'create'])->name('tambahpengajuankegiatan'); // Diubah
            Route::post('/tambahpengajuankegiatan', [UserKegiatanController::class, 'store'])->name('storekegiatan');
           Route::post('/user/kegiatan/{id}/batalkan', [UserKegiatanController::class, 'batalkan'])->name('batalkan.kegiatan');

            Route::get('/userkunjungan', [UserKunjunganController::class, 'index'])->name('userkunjungan');
            Route::get('/tambahpengajuankunjungan', [UserKunjunganController::class, 'create'])->name('tambahpengajuankunjungan');
            Route::post('/tambahpengajuankunjungan', [UserKunjunganController::class, 'store'])->name('storekunjungan');
            
        });
});


Route::middleware(['auth'])->group(function () {
    Route::prefix('ketua_yayasan')
        ->name('ketua_yayasan.')
        ->middleware([KetuaYayasanMiddleware::class])
        ->group(function () {
            Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
            Route::get('/dataanak', [KetuaAnakController::class, 'index'])->name('anak.dataanak');
            Route::get('/dashboard', [KetuaYayasanController::class, 'index'])->name('dashboard');
            Route::get('/keseluruhandata', [KetuaKeseluruhanDataController::class, 'index'])->name('keseluruhandata');
            Route::get('/anak/export', [KetuaAnakController::class, 'export'])->name('anak.export');
            Route::get('/anak/export-pdf/{id}', [KetuaAnakController::class, 'exportPdf'])->name('anak.exportpdf');
        });

    Route::prefix('ketua_yayasan')->name('ketua_yayasan.')->middleware([KetuaYayasanMiddleware::class])->group(function () {
        Route::get('/beritas', [KetuaBeritaController::class, 'index'])->name('beritas.index');
        Route::post('/beritas', [KetuaBeritaController::class, 'store'])->name('beritas.store');
        Route::put('/beritas{id}', [KetuaBeritaController::class, 'update'])->name('beritas.update');
        Route::delete('/beritas{id}', action: [KetuaBeritaController::class, 'destroy'])->name('beritas.destroy');
    });

    Route::prefix('ketua_yayasan')->name('ketua_yayasan.')->middleware([KetuaYayasanMiddleware::class])->group(function () {
        Route::get('/banners', [KetuaBannerControllerNew::class, 'index'])->name('banners.index');
        Route::post('/banners', [KetuaBannerControllerNew::class, 'store'])->name('banners.store');
        Route::put('/banners{id}', [KetuaBannerControllerNew::class, 'update'])->name('banners.update');
        Route::delete('/banners{id}', action: [KetuaBannerControllerNew::class, 'destroy'])->name('banners.destroy');
    });

    Route::prefix('ketua_yayasan/kegiatan')->middleware([KetuaYayasanMiddleware::class])
        ->name('ketua_yayasan.kegiatan.')
        ->group(function () {
            Route::get('/', [KetuaKegiatanController::class, 'index'])->name('index');
            Route::post('/approve/{id}', [KetuaKegiatanController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}', [KetuaKegiatanController::class, 'reject'])->name('reject');
 Route::post('/ketua_yayasan/kegiatan/{id}/setujui-pembatalan', [KetuaKegiatanController::class, 'setujuiPembatalan'])->name('setujuiPembatalan');
Route::post('/ketua_yayasan/kegiatan/{id}/tolak-pembatalan', [KetuaKegiatanController::class, 'tolakPembatalan'])->name('tolakPembatalan');

        });
    Route::prefix('ketua_yayasan/kunjungan')->middleware([KetuaYayasanMiddleware::class])
        ->name('ketua_yayasan.kunjungan.')
        ->group(function () {
            Route::get('/', [KetuaKunjunganController::class, 'index'])->name('index');
            Route::post('/approve/{id}', [KetuaKunjunganController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}', [KetuaKunjunganController::class, 'reject'])->name('reject');
        });
});