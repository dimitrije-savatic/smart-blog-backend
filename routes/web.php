<?php

use Illuminate\Support\Facades\Route;

Route::get('/posts', [\App\Http\Controllers\UserController::class, 'index'])->name('home');
