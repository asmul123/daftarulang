<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DapoController;
use App\Http\Controllers\PendaftarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('countdown.index');
});


Route::get('/dapo', [DapoController::class, 'index'])->name('dapo')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/admin', [LoginController::class, 'admin'])->name('admin')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/admin', [LoginController::class, 'authadmin']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::resource('/pendaftar', PendaftarController::class)->middleware('auth');
Route::get('/rekap', [PendaftarController::class, 'rekap'])->middleware('auth');