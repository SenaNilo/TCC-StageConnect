<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;


Route::get('/', function(){
    return view('index');
});

// Login
Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/login', [PagesController::class, 'authenticate'])->name('login.authenticate');

// Cadastro
Route::get('/cadastro', [PagesController::class, 'cadastro'])->name('cadastro');
// Aponta para o método 'storeCadastro' no PagesController
Route::post('/cadastro', [PagesController::class, 'storeCadastro'])->name('storeCadastro');

// Logout
Route::post('/logout', [PagesController::class, 'logout'])->name('logout');


// Route::get('/stage-connect', [PagesController::class, 'stageconnect'])->name('stageconnect');

Route::get('/stage-connect', [PagesController::class, 'stageconnect'])      
->middleware('auth')
->name('stageconnect');


