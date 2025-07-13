<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\LoginController;


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

//Route::get('/user/create', [PenggunaController::class, 'create']);
Route::middleware(['auth'])->group(function () {
    Route::get('/user', 'UserController@index');
});

Route::post('/user', [PenggunaController::class, 'store']);
Route::get('/user', [PenggunaController::class, 'index']);
Route::get('/user/create', [PenggunaController::class, 'create']);
Route::get('/register', [PenggunaController::class, 'create']);
Route::get('/user/change-password', [PenggunaController::class, 'edit']);
Route::put('/user/change-password', [PenggunaController::class, 'update']);
Route::delete('/user/delete/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');


Route::get('/', [LoginController::class, 'index']);
Route::get('/user/logout', [LoginController::class, 'logout']);
Route::post('/user/login', [LoginController::class, 'login']);


Route::get('/nft/create', [NftController::class, 'create']);
Route::post('/nft', [NftController::class, 'store'])->name('nft.store');
Route::get('/nft', [NftController::class, 'index']);
Route::get('/nft/{nft}/edit', [NftController::class, 'edit'])->name('nft.edit');
Route::put('/nft/{id}/edit', [NftController::class, 'update'])->name('nft.update');
Route::delete('/nft/{nft}', [NftController::class, 'destroy'])->name('nft.destroy');

/*Route::get('/', function () {
    return view('welcome');
});
*/