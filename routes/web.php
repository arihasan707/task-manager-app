<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('home', [HomeController::class, 'index'])->name('home')
    ->middleware('auth');

Route::post('simpan-task', [HomeController::class, 'simpanTask'])->name('simpanTask')
    ->middleware('auth');

Route::resource('home', HomeController::class)
    ->middleware('auth');