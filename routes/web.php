<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

use App\Http\Controllers\AuthController;
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('loginProcess');

use App\Http\Controllers\CafeController;
Route::get('/recommend', [CafeController::class, 'recommend']);
Route::get('/cafe/{id}', [CafeController::class, 'show'])->name('cafe.details');
Route::post('/cafe/{id}/review', [CafeController::class, 'storeReview'])->name('cafe.review.store');
// Rekomendasi context-aware (waktu), untuk homepage
Route::get('/', [CafeController::class, 'recommendByTimeContext'])->name('home');
Route::get('/home', [CafeController::class, 'recommendByTimeContext'])->name('home');

// use App\Http\Controllers\HomeController;
// Route::get('/home', [CafeController::class, 'view'])->name('home');
