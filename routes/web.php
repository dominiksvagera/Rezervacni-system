<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'index');


Route::get('/login', [AuthController::class, 'show']);
