<?php

use App\Http\Controllers\CreateQuotationController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class);

Route::post('quotation', CreateQuotationController::class)
    ->middleware(['auth']);
