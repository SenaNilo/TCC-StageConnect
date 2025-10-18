<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Área do aluno - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    @vite(['resources/css/alunos/configuracoes.css', 'resources/css/alunos/aluno.css','resources/js/alunos/script-aluno.js', 'resources/js/alunos/modalSair.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>

    <div class="container">
        <x-aluno.sidebarAluno />

        <!-- Site main content - corpo do site -->
        <div class="main-content">
            <section class="card-principal">
                <h1 class="titulo-configuracoes">Configurações do Usuário</h1>
        
                <form class="form-configuracoes" method="#" action="#">
                    <div class="form-fields">
                        <div class="group-labels">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" value="{{ Auth::user()->name }}" disabled>
                        </div>

                        <div class="group-labels">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>

                        <div class="group-labels">
                            <label for="password">Nova Senha</label>
                            <input type="password" id="password" name="password" placeholder="Alterar senha">
                        </div>

                        <div class="group-labels">
                            <label for="confirmPassword">Confirmar Nova Senha</label>
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirme a nova senha">
                        </div>
                    </div>

                    <div class="profile-picture-section">
                        <img src="{{ asset('images/larissafoto.jpg') }}" alt="Foto de Perfil" class="profile-picture-preview">
                        <label for="profilePicture" class="file-upload-label">Alterar Foto</label>
                        <input type="file" id="profilePicture" name="profilePicture" accept="image/*" style="display: none;">
                    </div>

                    <button type="submit" class="confirm-button">Confirmar Alterações</button>
                </form>
            </section>

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

</body>

</html>