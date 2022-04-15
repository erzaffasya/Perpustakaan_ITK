<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
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

//Protecting Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::controller(KategoriController::class)->group(function () {
        Route::get('lihat-kategori', 'index');
        Route::post('tambah-kategori', 'store');
        Route::get('detail-kategori/{id}', 'show');
        Route::put('ubah-kategori/{id}', 'update');
        Route::post('hapus-kategori/{id}', 'destroy');
    });

    
});