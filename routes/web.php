<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'showForm'])->name('home');

Route::post('/register', [RegistrationController::class, 'register'])->name('register');

Route::prefix('link')->group(function () {
    Route::get('{unique_link}', [LinkController::class, 'show'])->name('link.show');
    Route::post('{unique_link}/regenerate', [LinkController::class, 'regenerate'])->name('link.regenerate');
    Route::post('{unique_link}/deactivate', [LinkController::class, 'deactivate'])->name('link.deactivate');
});

Route::prefix('game')->group(function () {
    Route::post('play/{user}', [GameController::class, 'play'])->name('game.play');
    Route::get('history/{user}', [GameController::class, 'history'])->name('game.history');
});
