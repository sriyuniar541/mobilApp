<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
    return redirect ('/dashboard');
});



// 1. CRUD MOBIL__________________

// view dasboard
Route::get('/dashboard', [MobilController::class, 'index']) 
        ->name('admin.dashboard.index')
        ->middleware(['isLogin', 'verified']);

//view add mobil
Route::get('/addMobil', [MobilController::class, 'AddMobil']) 
        ->name('addMobil')
        ->middleware(['isLogin', 'verified']);

//insert mobil
Route::post('/insert', [MobilController::class, 'store']);

//view update data
Route::get('/{id}/edit', [MobilController::class, 'edit'])
        ->middleware(['isLogin', 'verified']);

//update data
Route::put('/{id}/update', [MobilController::class, 'update']);

//delete
Route::delete('/{id}/delete', [MobilController::class, 'destroy']);



//2. CRUD PEMINJAMAN____________
Route::get('/{id}/sewaMobil', [ PeminjamanController::class, 'index'])
        ->middleware(['isLogin', 'verified']);

Route::post('/peminjaman', [ PeminjamanController::class, 'insert']);

//view peminjaman by user
Route::get('/getPeminjaman', [ PeminjamanController::class, 'getPeminjaman'])
        ->middleware(['isLogin', 'verified']);

// penegembalian
Route::put('/{id}/pengembalianMobil', [ PeminjamanController::class, 'update']);

//update data
Route::delete('/{id}/deletePeminjaman', [PeminjamanController::class, 'deletePeminjaman']);



//3.CRUD USER__________

//view page register
Route::get('/register', [ SessionController::class, 'index']);

//view page register
Route::get('/login', [ SessionController::class, 'viewLogin'])
        ->name('login');

//register
Route::post('/users/register', [ SessionController::class, 'register']);

//verify email

Route::get('/email/verify', function () { return view('auth.verify-email');})
        ->middleware('auth')
        ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
 
        return redirect('/dashboard');

})
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

//login
Route::post('/users/login', [ SessionController::class, 'login']);

//logout
Route::get('/users/logout', [ SessionController::class, 'logout']);

//view profile
Route::get('/users/profile', [ SessionController::class, 'profile'])
        ->middleware(['isLogin', 'verified']);