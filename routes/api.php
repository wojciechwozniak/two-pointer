<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::post('/',[HomeController::class,'calculateTrappedWater']);
