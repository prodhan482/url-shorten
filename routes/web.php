<?php

use App\Http\Controllers\URLController;
use Illuminate\Support\Facades\Route;

Route::get('/', [URLController::class, 'index'])->name('shortener');
Route::post('/shorten', [URLController::class, 'shorten'])->name('shorten');
Route::get('/{shortCode}', [URLController::class, 'redirect'])->name('redirect');
