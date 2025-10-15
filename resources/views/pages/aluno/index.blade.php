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

    <div class="" id="container">
        <!-- Sidebar -->
        @include('components.navbar.alunoNavbar')

        <!-- Site main content -->
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
                <div class="card"><a href="{{ route('aluno.orientacao') }}">Orientação Profissional/Material de Apoio</a></div>
                <div class="card"><a href="{{ route('aluno.requisitos') }}">Áreas de Atuação e Requisitos Técnicos</a></div>
                <div class="card"><a href="{{ route('aluno.tecnico') }}">Conteúdo Técnico Específico</a></div>
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