<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Área do aluno - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> -->
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    {{-- Adicione a diretiva Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <script src='script-aluno.js'></script> --}}
</head>

<body>

    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar collapsed">
            <div class="sidebar-header">
                <img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="header-logo">
                <h2 class="titulo-sidebar"> StageConnect </h2>
                <button class="sidebar-toggle">
                    <span class="material-symbols-rounded"> chevron_left </span>
                </button>
            </div>




            <div class="sidebar-content">
                <!-- search form -->
                <!-- <form action="#" class="search-form">
            <span class="material-symbols-rounded">search</span>
            <input type="search" placeholder="Search..." required />
          </form> -->

                <!-- sidebar menu -->
                <ul class="menu-list">
                    <li class="menu-item">
                        <a href="#" class="menu-link active">
                            <span class="material-symbols-rounded">home</span>
                            <span class="menu-label">Página inicial</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="material-symbols-rounded">insert_chart</span>
                            <span class="menu-label">Conteúdo</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="material-symbols-rounded">notifications</span>
                            <span class="menu-label">Conteúdo</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="material-symbols-rounded">star</span>
                            <span class="menu-label">Conteúdo</span>
                        </a>
                    </li>

                </ul>
            </div>



            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <button class="theme-toggle">
                    <div class="theme-label">
                        <span class="theme-icon material-symbols-rounded">dark_mode</span>
                        <span class="theme-text">Dark Mode</span>
                    </div>
                    <div class="theme-toggle-track">
                        <div class="theme-toggle-indicator"></div>
                    </div>
                </button>


                <div>


                    <button id="open-modal-btn" type="button" class="menu-link btn-sair">
                        <span class="material-symbols-rounded">login</span>
                        <span class="menu-label"> Sair </span>
                    </button>

                    </form>
                </div>
                <!-- @auth
             <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
        @csrf
        <button type="submit" class="menu-link" style="width: 100%; border: none; background: none;">
            <span class="material-symbols-rounded">logout</span>
            <span class="menu-label">Sair</span>
        </button>
    </form>
    @endauth -->


            </div>
        </aside>

        <!-- Site main content -->
        <div class="main-content">
            <div class="main-inicial">
                <h1 class="page-title">Olá, {{ Auth::user()->name }}! </h1>
                <img src="{{ asset('images/larissafoto.jpg') }}" alt="Imagem de boas-vindas" class="perfil-img">
            </div>


            <div class="cards-principais">
                <div class="card">Orientação Profissional/Material de Apoio</div>
                <div class="card">Áreas de Atuação e Requisitos Técnicos</div>
                <div class="card">Conteúdo Técnico Específico</div>
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


<!-- <h1>Vai se matricular </h1>

{{-- Exemplo de botão de Logout --}}
{{-- Coloque este código onde você deseja que o botão apareça, por exemplo, em um cabeçalho ou menu --}}

@auth {{-- Verifica se o usuário está logado para mostrar o botão --}}
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf {{-- Token CSRF para segurança --}}
        <button type="submit" class="button-logout" style="
            background-color: #dc3545; /* Cor vermelha para logout */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none; /* Para parecer um botão, não um link */
            display: inline-block; /* Permite padding e margem */
            margin-left: 10px; /* Espaçamento, se necessário */
        ">
            Sair
        </button>
    </form>
@endauth -->