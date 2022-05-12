<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookmarkController;
use App\Http\Controllers\API\DokumenController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\PeminjamanController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login-api', [AuthController::class, 'auth']);

//Kategori
Route::controller(KategoriController::class)->group(function () {
    Route::get('kategori', 'index');
    Route::post('kategori', 'store');
    Route::get('kategori/{id}', 'show');
    Route::put('kategori/{id}', 'update');
    Route::post('kategori/{id}', 'destroy');
});

//Bookmark
Route::controller(BookmarkController::class)->group(function () {
    Route::get('bookmark', 'index');
    Route::post('bookmark', 'store');
    Route::get('bookmark/{id}', 'show');
    Route::put('bookmark/{id}', 'update');
    Route::post('bookmark/{id}', 'destroy');
});

//Peminjaman
Route::controller(PeminjamanController::class)->group(function () {
    Route::get('peminjaman', 'index');
    Route::post('peminjaman', 'store');
    Route::get('peminjaman/{id}', 'show');
    Route::put('peminjaman/{id}', 'update');
    Route::post('peminjaman/{id}', 'destroy');
});

//Dokumen
Route::controller(DokumenController::class)->group(function () {
    Route::get('dokumen', 'index');
    Route::post('dokumen', 'store');
    Route::get('dokumen/{id}', 'show');
    Route::put('dokumen/{id}', 'update');
    Route::post('dokumen/{id}', 'destroy');
});

//Protecting Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

 
    
});