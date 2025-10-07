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
Route::get('/stage-connect', [PagesController::class, 'stageconnect'])->name('stageconnect');

// Pagina inicial do admin
//// Route::get('/admin', [FilamentPanelProvider::class, 'adminIndex'])->name('admin');
Route::redirect('/admin', '/filament'); // Esta é a rota que criamos antes para o redirecionamento
// Route::get('/filament', function () {
//     return redirect()->route('filament.auth.login');
// })->name('filament');
// Rotas para a área do aluno
Route::middleware(['auth'])->prefix('aluno')->name('aluno.')->group(function () {

    // Rota para a página de 'Entrevistas e testes'
    // A URL será /aluno/entrevistas
    Route::get('/', [AlunoController::class, 'showIndex'])->name('index');
    Route::get('/entrevistas', [AlunoController::class, 'showEntrevistas'])->name('entrevistas');

    // Rota para a página de 'Áreas técnicas'
    // A URL será /aluno/areas-tecnicas
    Route::get('/areas-tecnicas', [AlunoController::class, 'showAreasTecnicas'])->name('areastecnicas');
    Route::get('/configuracoes', [AlunoController::class, 'showConfiguracoes'])->name('userSettings');

    // Você pode adicionar a home do aluno aqui também
    // Ex: Route::get('/home', [AlunoController::class, 'showHome'])->name('home');
});
