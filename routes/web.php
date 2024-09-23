<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
{
    return view('welcome');
};

Route::get('/test', [HomeController::class, 'index']); 
