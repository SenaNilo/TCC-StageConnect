<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Área do aluno - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    @vite(['resources/css/alunos/aluno.css', 'resources/js/alunos/script-aluno.js',  'resources/js/alunos/modalSair.js'])
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
                {{-- <img src="{{ asset('images/larissafoto.jpg') }}" alt="Imagem de boas-vindas" class="perfil-img"> --}}
    
                {{-- LÓGICA DA FOTO DE PERFIL --}}
                @if (Auth::user()->foto_perfil)
                    <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" 
                        alt="Foto de perfil do usuário" 
                        class="perfil-img">
                @else
                    <div class="perfil-img perfil-placeholder">
                        <i class="fas fa-user-circle fa-4x"></i> 
                    </div>
                @endif
            </div>


            <div class="cards-principais">
                <div class="card">Conteúdo</div>
                <div class="card"> Saiba Mais </div>
                <div class="card"> Sei la</div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

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


    <script>
        // Seleciona os elementos que vamos usar
        const openModalBtn = document.getElementById('open-modal-btn');
        const logoutModal = document.getElementById('logout-modal');
        const cancelLogoutBtn = document.getElementById('cancel-logout-btn');
        const confirmLogoutBtn = document.getElementById('confirm-logout-btn');
        const logoutForm = document.getElementById('logout-form');

        // Quando o usuário clicar no botão "Sair" da sidebar
        openModalBtn.addEventListener('click', () => {
            logoutModal.classList.remove('modal-hidden'); // Mostra o modal
        });

        // Quando o usuário clicar em "Cancelar"
        cancelLogoutBtn.addEventListener('click', () => {
            logoutModal.classList.add('modal-hidden'); // Esconde o modal
        });

        // Quando o usuário clicar no fundo escuro (overlay)
        logoutModal.addEventListener('click', (event) => {
            // Se o clique foi no overlay (fundo) e não no card
            if (event.target === logoutModal) {
                logoutModal.classList.add('modal-hidden'); // Esconde o modal
            }
        });

        // Quando o usuário clicar em "Confirmar"
        confirmLogoutBtn.addEventListener('click', () => {
            logoutForm.submit(); // Envia o formulário de logout!
        });
    </script>

</body>

</html>