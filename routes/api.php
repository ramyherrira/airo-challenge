<?php

use App\Http\Controllers\CreateQuotationController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// @todo Make this route
// Route::post('auth', LoginController::class);

Route::post('quotation', CreateQuotationController::class);


