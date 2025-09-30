<?php

use App\Http\Controllers\Api\BukuController;
use Illuminate\Support\Facades\Route;

// Route::apiResource('testApi', BukuController::class);

// Route::get('test', function () {
//     return 'API route works!';
// });


Route::get('buku', [BukuController::class, 'index']);           // List all books
Route::post('buku', [BukuController::class, 'store']);          // Create new book
Route::get('buku/{id}', [BukuController::class, 'show']);       // Show book by id
Route::put('buku/{id}', [BukuController::class, 'update']);     // Update book by id
Route::patch('buku/{id}', [BukuController::class, 'update']);   // Partial update
Route::delete('buku/{id}', [BukuController::class, 'destroy']); // Delete book by id