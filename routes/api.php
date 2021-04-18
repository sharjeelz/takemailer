<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EmailController;


Route::get('email',[EmailController::class,'index']);
Route::post('email',[EmailController::class,'save']);

