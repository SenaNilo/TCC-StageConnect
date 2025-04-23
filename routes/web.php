<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;


Route::get('/', function(){
    return view('welcome');
});
Route::get('/in', [PagesController::class, 'index']);
Route::get('/login', [PagesController::class, 'login']);
