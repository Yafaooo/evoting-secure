<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

Route::get('/', [VoteController::class, 'index'])->name('home');
Route::post('/vote', [VoteController::class, 'store'])->name('votes.store');