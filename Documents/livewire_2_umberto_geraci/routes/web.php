<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', );

Route::get('/', [PublicController::class,'homepage'])->name('homepage');
