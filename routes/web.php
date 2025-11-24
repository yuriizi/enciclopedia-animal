<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnimalController::class, 'index'])->name('animais.index');
Route::get('/animais/{slug}', [AnimalController::class, 'show'])->name('animais.show');

// Área para gerenciar imagens dos animais
Route::prefix('admin')->group(function () {
    Route::get('/animais/{animal:slug}/images', [AnimalImageController::class, 'index'])->name('admin.animais.images.index');
    Route::post('/animais/{animal:slug}/images', [AnimalImageController::class, 'store'])->name('admin.animais.images.store');
    Route::delete('/animais/{animal:slug}/images/{image}', [AnimalImageController::class, 'destroy'])->name('admin.animais.images.destroy');
    Route::post('/animais/{animal:slug}/images/{image}/feature', [AnimalImageController::class, 'setFeatured'])->name('admin.animais.images.feature');
});