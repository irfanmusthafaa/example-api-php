<?php

use App\Http\Controllers\Api\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('test', function () {
    return 'API route works!';
});

// Route::apiResource('buku', BukuController::class);

// Route untuk BukuController satu per satu
