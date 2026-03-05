<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

Route::get('/', function () {
    return view('voting'); // Kita arahkan ke file voting.blade.php
});

Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');