<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transactions\CreateTransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/createTransaction', [CreateTransactionController::class, 'createTransaction'])->name('createTransaction');
