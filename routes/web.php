<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;


Route::get('/', function(){
    return view('index');
});
// Route::get('/in', [PagesController::class, 'index']);
Route::get('/login', [PagesController::class, 'login']);

Route::get('/cadastro', [PagesController::class, 'cadastro']);
