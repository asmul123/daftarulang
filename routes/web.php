<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/pendaftar');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::resource('/pendaftar', PendaftarController::class)->middleware('auth');