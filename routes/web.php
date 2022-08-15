<?php

use App\Http\Controllers\MockupController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MockupController::class, 'make'])->name('make');
Route::post('/generate', [MockupController::class, 'generate'])->name('generate');

Route::resource('player', PlayerController::class);