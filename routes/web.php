<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;
use App\Providers\Filament\FilamentPanelProvider;
use App\Http\Controllers\AlunoController;



Route::get('/', action: function () {
    return view('index');
});

Route::get('/sobre-nos', function () {
    return view('sobre-nos');
});
// Route::get('/in', [PagesController::class, 'index']);

// Login
Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/login', [PagesController::class, 'authenticate'])->name('login.authenticate');

// Cadastro
Route::get('/cadastro', [PagesController::class, 'cadastro'])->name('cadastro');
// Aponta para o método 'storeCadastro' no PagesController
Route::post('/cadastro', [PagesController::class, 'storeCadastro'])->name('storeCadastro');

// Logout
Route::post('/logout', [PagesController::class, 'logout'])->name('logout');


// Middleware para barrar usuarios nao autenticados
// Route::get('/stage-connect', [PagesController::class, 'stageconnect'])->name('stageconnect');
//     Route::get('/stage-connect/orientacao', [PagesController::class, 'orientacaoProfissional'])->name('aluno.orientacao');
//     Route::get('/stage-connect/requisitos', [PagesController::class, 'requisitosTecnicos'])->name('aluno.requisitos');
//     Route::get('/stage-connect/tecnico', [PagesController::class, 'conteudoTecnico'])->name('aluno.tecnico');
//     Route::get('/stage-connect/conteudo/{id}', [PagesController::class, 'mostrarDetalheConteudo'])->name('aluno.conteudo.detalhe');

// Pagina inicial do admin
Route::redirect('/admin', '/filament'); // Esta é a rota que criamos antes para o redirecionamento

// Rotas para a área do aluno
Route::middleware(['auth'])->prefix('aluno')->name('aluno.')->group(function () {

    Route::get('/orientacao', [PagesController::class, 'orientacaoProfissional'])->name('orientacao');
    Route::get('/requisitos', [PagesController::class, 'requisitosTecnicos'])->name('requisitos');
    Route::get('/tecnico', [PagesController::class, 'conteudoTecnico'])->name('tecnico');
    
    Route::get('/', [AlunoController::class, 'showIndex'])->name('index');
    Route::get('/entrevistas', [AlunoController::class, 'showEntrevistas'])->name('entrevistas');

    // Rotas para a seção de conteúdos
    Route::get('/conteudos', [PagesController::class, 'mostrarConteudos'])->name('conteudos');
    Route::get('/conteudo/{id}', [PagesController::class, 'mostrarDetalheConteudo'])->name('conteudo.detalhe');

    // Rota para a página de 'Áreas técnicas'
    Route::get('/areas-tecnicas', [AlunoController::class, 'showAreasTecnicas'])->name('areastecnicas');
    Route::get('/configuracoes', [AlunoController::class, 'showConfiguracoes'])->name('userSettings');

});
