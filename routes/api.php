<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transactions\CreateTransactionController;
use App\Http\Controllers\Transactions\GetExcelController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/createTransaction', [CreateTransactionController::class, 'createTransaction'])->name('createTransaction');
Route::post('/getExcelFile', [GetExcelController::class, 'getExcelFile'])->name('exportExcel');
