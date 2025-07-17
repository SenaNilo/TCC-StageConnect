<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;


Route::get('/', function(){
    return view('index');
});
// Route::get('/in', [PagesController::class, 'index']);
Route::get('/login', [PagesController::class, 'login'])->name('login');

Route::get('/cadastro', [PagesController::class, 'cadastro'])->name('storeCadastro');

// Aponta para o método 'storeCadastro' no PagesController
Route::post('/cadastro', [PagesController::class, 'storeCadastro'])->name('storeCadastro');

Route::get('/stage-connect', [PagesController::class, 'stageconnect'])->name('stageconnect');