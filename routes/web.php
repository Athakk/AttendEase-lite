<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HariKerjaController;
use App\Http\Controllers\HariKerjaDetailController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftDetailController;
use App\Http\Controllers\UserController;
use App\Models\HariKerja;
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

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'createRegister')->name('createRegister');
    });
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::middleware('auth')->group(function() {
    Route::middleware('admin')->group(function() {
        Route::prefix('admin')->group(function() {
            
            Route::resources([
            'user' => UserController::class,
            'hariKerja' => HariKerjaController::class,
            'shift' => ShiftController::class,
            ]);

            Route::controller(ShiftDetailController::class)->group(function () {
                Route::get('/shiftDetail/{id}', 'detail')->name('shiftDetail.detail');    
                Route::put('/shiftDetail/{id}/update', 'update')->name('shiftDetail.update');    
            });

            Route::controller(AbsensiController::class)->group(function () {
                Route::get('/absensi', 'indexAdmin')->name('admin.absensi');    
            });

            Route::controller(LaporanController::class)->group(function () {
                Route::get('/laporan', 'index')->name('laporan.index');    
                Route::post('/cetakAbsensi', 'cetakAbsensi')->name('laporan.cetakAbsensi');    
            });
        });

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard');    
        });
        
    });
    
    
    Route::controller(MyProfileController::class)->group(function () {
        Route::get('/myprofile/{user}', 'index')->name('myprofile.index');    
        Route::put('/myprofile/update/{user}', 'update')->name('myprofile.update');    
    });
    
    Route::controller(AbsensiController::class)->group(function () {
        Route::get('/absensi', 'indexUser')->name('user.absensi');    
        Route::get('/hariKerjaShift', 'indexHariKerjaShift')->name('hariKerjaShift.index');    
        Route::get('/absensi/masuk', 'absenMasuk')->name('absensi.absenMasuk');    
        Route::get('/absensi/keluar', 'absenKeluar')->name('absensi.absenKeluar');    
    });

    Route::get('/chooseShift/{id}', [ShiftController::class, 'choose'])->name('shift.choose');    
    Route::get('/chooseHariKerja/{id}', [HariKerjaController::class, 'choose'])->name('hariKerja.choose');    
});

