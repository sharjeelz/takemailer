<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EmailController;

Route::post('email',[EmailController::class,'save']);

