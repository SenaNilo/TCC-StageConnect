<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;
use App\Providers\Filament\FilamentPanelProvider;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ConfiguracoesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CurriculoController;
use App\Http\Controllers\NewsController;

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


// Pagina inicial do admin
Route::redirect('/admin', '/filament'); // Esta é a rota que criamos antes para o redirecionamento

// Rotas para a área do aluno
Route::middleware(['auth'])->prefix('aluno')->name('aluno.')->group(function () {

    Route::get('/orientacao', [PagesController::class, 'orientacaoProfissional'])->name('orientacao');
    Route::get('/requisitos', [PagesController::class, 'requisitosTecnicos'])->name('requisitos');
    Route::get('/tecnico', [PagesController::class, 'conteudoTecnico'])->name('tecnico');

    Route::get('curriculo', function () {
        return view('pages.aluno.curriculo');
    })->name('curriculo.form');

    Route::post('/curriculo/analisar', [CurriculoController::class, 'analisar'])->name('curriculo.analisar');

    Route::get('/', [AlunoController::class, 'showIndex'])->name('index');
    Route::get('/noticias-tech', [NewsController::class, 'index'])->name('noticias-tech');
    // Rotas para a seção de conteúdos
    Route::get('/conteudos', [PagesController::class, 'mostrarConteudos'])->name('conteudos');
    Route::get('/conteudo/{id}', [PagesController::class, 'mostrarDetalheConteudo'])->name('conteudo.detalhe');


    //Rotas de edição de configuração
    Route::get('/configuracoes', [ConfiguracoesController::class, 'edit'])->name('configuracoes-aluno');
    Route::put('/configuracoes/updated', [ConfiguracoesController::class, 'updatedProfile'])->name('config.updatedProfile');
    Route::delete('/configuracoes/deactivate', [ConfiguracoesController::class, 'deactivateAccount'])->name('config.deactivate');
});

Route::get('/esqueci-senha', [PagesController::class, 'mostrarFormEsqueciSenha'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/esqueci-senha', [PagesController::class, 'enviarLinkReset'])
    ->middleware('guest')
    ->name('password.email'); 

Route::get('/redefinir-senha/{token}', [PagesController::class, 'mostrarFormRedefinir'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/redefinir-senha', [PagesController::class, 'redefinirSenha'])
    ->middleware('guest')
    ->name('password.update');

Route::post('/contato', [ContactController::class, 'send'])->name('contato.send');
Route::get('/obrigado', function () {
    return view('obrigado');
});
