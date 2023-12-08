<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobil\MobilController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\user\SessionController;
use App\Http\Middleware\isLogin;

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

Route::get('/', function () {
    return view('welcome');
});



// 1. CRUD MOBIL__________________

// view dasboard dan get data mobil
Route::get('/dashboard', [MobilController::class, 'index']) ->name('admin.dashboard.index');
//view halaman add mobil
Route::get('/addMobil', [MobilController::class, 'AddMobil']) ->name('addMobil')->middleware('isLogin');

//insert mobil
Route::post('/insert', [MobilController::class, 'store']);

//view update data
Route::get('/{id}/edit', [MobilController::class, 'edit'])->middleware('isLogin');

//update data
Route::put('/{id}/update', [MobilController::class, 'update']);

//delete
//update data
Route::delete('/{id}/delete', [MobilController::class, 'destroy']);



//2. CRUD PEMINJAMAN____________
Route::get('/{id}/sewaMobil', [ PeminjamanController::class, 'index'])->middleware('isLogin');

Route::post('/peminjaman', [ PeminjamanController::class, 'insert']);

//view peminjaman by user
Route::get('/getPeminjaman', [ PeminjamanController::class, 'getPeminjaman'])->middleware('isLogin');

// penegembalian
Route::put('/{id}/pengembalianMobil', [ PeminjamanController::class, 'update']);



//3.CRUD USER__________

//view page register
Route::get('/register', [ SessionController::class, 'index']);

//view page register
Route::get('/login', [ SessionController::class, 'viewLogin']);

//register
Route::post('/users/register', [ SessionController::class, 'register']);

//login
Route::post('/users/login', [ SessionController::class, 'login']);

//logout
Route::get('/users/logout', [ SessionController::class, 'logout']);

//profile
Route::get('/users/profile', [ SessionController::class, 'profile'])->middleware('isLogin');