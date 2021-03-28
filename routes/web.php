<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {return view('home');})->name('home');



Route::get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard')
->middleware('auth');

Route::post('/dashboard/{product}/remind', [DashboardController::class, 'dontremind'])->name('dashboard.remind');
Route::post('/dashboard/{product}/buy', [DashboardController::class, 'buyitem'])->name('dashboard.buy');

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('user.posts');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');

	
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});