<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Área do aluno - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    @vite(['resources/css/alunos/aluno.css', 'resources/js/alunos/script-aluno.js', 'resources/js/alunos/modalSair.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Sidebar-nav mobile -->
    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>
    <!-- Sidebar-nav mobile Fim -->

    <!-- Sidebar -->
    <div class="container">
        <x-aluno.sidebarAluno />

        <!-- Começo do main content (Site) -->
        <div class="main-content">
            <div class="main-inicial">
                <h1 class="page-title">Olá, {{ Auth::user()->name }}! </h1>

                @if (Auth::user()->foto_perfil)
                <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}"
                    alt="Foto de perfil do usuário"
                    class="perfil-img">
                @else
                <div class="perfil-img perfil-placeholder">
                    <span class="material-symbols-rounded"> account_circle </span>
                </div>
                @endif
            </div>


            <div class="cards-principais">
                <div class="card">
                    <h2 class="title-card"> Conteúdo </h2>
                    <p class="description-card"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    <a href="{{ route('aluno.conteudos') }}" class="btn-card"> Acessar </a>
                </div>

                <div class="card">
                    <h2 class="title-card"> Saiba Mais </h2>
                    <p class="description-card"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed </p>
                    <a href="{{ route('aluno.orientacao' )}}" class="btn-card"> Acessar </a>

                </div>
                <div class="card">
                    <h2 class="title-card"> Entrevistas </h2>
                    <p class="description-card"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    <a href="{{ route('aluno.entrevistas') }}" class="btn-card"> Acessar </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim do main content (Site) -->

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Modal de Sair -->
    <div id="logout-modal" class="modal-overlay modal-hidden">
        <div class="card-cancelar">
            <div class="header-cancelar">
                <div class="image">
                    <span class="material-symbols-rounded">warning</span>
                </div>
                <div class="content">
                    <span class="title">Sair da Conta</span>
                    <p class="message">
                        Você tem certeza que deseja sair?
                    </p>
                </div>
                <div class="actions">
                    <button id="confirm-logout-btn" class="desactivate" type="button">Confirmar</button>
                    <button id="cancel-logout-btn" class="cancel" type="button">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Final de Modal de Sair -->

</body>

</html>