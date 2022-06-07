<?php

use App\Http\Controllers\API\DokumenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return abort(403, 'Sabar yak.');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Protecting Routes
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/logout', [AuthController::class, 'logout']);
//     Route::get('/profile', [AuthController::class, 'profile']);

//     Route::get('/dokumen/{id}/download', [DokumenController::class, 'download']);
//     Route::get('/dokumen/{id}/view', [DokumenController::class, 'view']);
//     Route::get('{id}/view/{filename}', [DokumenController::class, 'view_dokumen']);
// });
require __DIR__.'/auth.php';
