<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::post('/calculate',[HomeController::class,'calculateTrappedWater']);
