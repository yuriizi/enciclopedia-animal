<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnimalController::class, 'index'])->name('animais.index');
Route::get('/animais/{slug}', [AnimalController::class, 'show'])->name('animais.show');