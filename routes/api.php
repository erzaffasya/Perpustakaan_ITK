<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookmarkController;
use App\Http\Controllers\API\DokumenController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\KursiBacaController;
use App\Http\Controllers\API\PeminjamanController;
use App\Http\Controllers\API\PeminjamanRuanganController;
use App\Http\Controllers\API\RuanganBacaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return abort(403, 'Dokumentasi ada di GRUP.');
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login-api', [AuthController::class, 'auth']);

//ruangan-baca
Route::controller(RuanganBacaController::class)->group(function () {
    Route::get('ruangan-baca', 'index');
    Route::post('ruangan-baca', 'store');
    Route::get('ruangan-baca/{id}', 'show');
    Route::put('ruangan-baca/{id}', 'update');
    Route::delete('ruangan-baca/{id}', 'destroy');
});

//ruangan-baca
Route::controller(KursiBacaController::class)->group(function () {
    Route::get('kursi-baca', 'index');
    Route::post('kursi-baca', 'store');
    Route::get('kursi-baca/{id}', 'show');
    Route::put('kursi-baca/{id}', 'update');
    Route::delete('kursi-baca/{id}', 'destroy');
});

//peminjaman-ruangan
Route::controller(PeminjamanRuanganController::class)->group(function () {
    Route::get('peminjaman-ruangan', 'index');
    Route::post('peminjaman-ruangan', 'store');
    Route::get('peminjaman-ruangan/{id}', 'show');
    Route::put('peminjaman-ruangan/{id}', 'update');
    Route::delete('peminjaman-ruangan/{id}', 'destroy');
    Route::get('ruang-kosong/{tanggal}', 'RuanganKosong');
});

//Kategori
Route::controller(KategoriController::class)->group(function () {
    Route::get('kategori', 'index');
    Route::post('kategori', 'store');
    Route::get('kategori/{id}', 'show');
    Route::put('kategori/{id}', 'update');
    Route::delete('kategori/{id}', 'destroy');
});

//Bookmark
Route::controller(BookmarkController::class)->group(function () {
    Route::get('bookmark', 'index');
    Route::post('bookmark', 'store');
    Route::get('bookmark/{id}', 'show');
    Route::put('bookmark/{id}', 'update');
    Route::delete('bookmark/{id}', 'destroy');
});


//Booking Progres

//Dokumen
Route::controller(DokumenController::class)->group(function () {
    Route::get('dokumen', 'index');
    Route::post('dokumen', 'store');
    Route::get('dokumen/{id}', 'show');
    Route::put('dokumen/{id}', 'update');
    Route::delete('dokumen/{id}', 'destroy');
});

// Route::get('/dokumen/{id}/download', [DokumenController::class, 'download']);
Route::get('/dokumen/{id}/view/{data}', [DokumenController::class, 'view']);
// Route::get('/view/{filename}', [DokumenController::class, 'view_dokumen'])->name('viewdoc');




//Protecting Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    //Peminjaman
    Route::controller(PeminjamanController::class)->group(function () {
        Route::get('peminjaman-dokumen', 'index');
        Route::post('peminjaman-dokumen', 'store');
        Route::get('peminjaman-dokumen/{id}', 'show');
        Route::put('peminjaman-dokumen/{id}', 'update');
        Route::delete('peminjaman-dokumen/{id}', 'destroy');
    });
});
