<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Área do aluno - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    @vite(['resources/css/alunos/configuracoes.css', 'resources/css/alunos/aluno.css','resources/js/alunos/script-aluno.js', 'resources/js/alunos/modalSair.js', 'resources/js/alunos/modalSucesso.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body data-success-message="{{ session('success') ?? '' }}">
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


                @if ($errors->any())
                <div class="notifications-container" style="margin-bottom: 20px;">
                    <div class="error-alert">
                        <div class="flex">
                            <div class="flex-shrink-0">

                                <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="error-svg">
                                    <path clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" fill-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="error-prompt-container">
                                <p class="error-prompt-heading">Opa! Encontramos alguns problemas:</p>
                                <div class="error-prompt-wrap">
                                    <ul class="error-prompt-list" role="list">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <form class="form-configuracoes" method="POST" action="{{ route('aluno.config.updatedProfile') }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-fields">
                        <div class="group-labels">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="group-labels">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="password-input-wrapper">
                            <div class="group-labels">
                                <label for="current_password">Senha Atual</label>
                                <input type="password" id="current_password" name="current_password" placeholder="Digite sua senha atual">

                            </div>
                            <span class="material-symbols-rounded password-toggle-icon"> visibility </span>
                        </div>

                        <div class="password-input-wrapper">
                            <div class="group-labels">
                                <label for="password">Nova Senha</label>
                                <input type="password" id="password" name="password" placeholder="Alterar senha">
                            </div>
                            <span class="material-symbols-rounded password-toggle-icon"> visibility </span>
                        </div>

                        <div class="password-input-wrapper">
                            <div class="group-labels">
                                <label for="confirmPassword">Confirmar Nova Senha</label>
                                <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirme a nova senha">
                            </div>
                            <span class="material-symbols-rounded password-toggle-icon"> visibility </span>
                        </div>
                    </div>


                    <div class="profile-picture-section">
                        <img src="{{ $user->getAvatarUrl() }}" alt="Foto de Perfil" class="profile-picture-preview">
                        <label for="profilePicture" class="file-upload-label">Alterar Foto</label>
                        <input type="file" id="profilePicture" name="profilePicture" accept="image/*" style="display: none;">
                    </div>

                   
                    <button type="submit" class="confirm-button">Confirmar Alterações</button>

                    <button id="open-deactivate-modal-btn" type="button" class="deactivate-button" style="margin-top: -30px;">
                        Desativar Minha Conta
                    </button>
                </form>


            </section>

        </div>
    </div>

    <form id="deactivate-form" action="{{ route('aluno.config.deactivate') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE') 
    </form>

    <div id="deactivate-modal" class="modal-overlay modal-hidden"> 
      <div class="card-cancelar"> <div class="header-cancelar"> 
          <div class="image"> 
             <span class="material-symbols-rounded">dangerous</span> 
          </div> 
          <div class="content">
             <span class="title">Desativar Conta</span> 
             <p class="message">
               Você tem certeza? Esta ação é permanente e marcará sua conta como inativa.
             </p> 
          </div> 
          <div class="actions"> 
             <button id="confirm-deactivate-btn" class="desactivate" type="button">Confirmar Desativação</button> 
            <button id="cancel-deactivate-btn" class="cancel" type="button">Cancelar</button> 
          </div> 
        </div> 
      </div> 
    </div>
    <!--modal de sucesso --> 
    <div id="success-modal" class="modal-overlay modal-hidden">
        <div class="card-success">
            <button id="success-modal-close-btn" type="button" class="dismiss">
                <span class="material-symbols-rounded"> close </span>
            </button>
            <div class="header">
                <div class="image">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                        <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#066e29" d="M20 7L9.00004 18L3.99994 13"></path>
                        </g>
                    </svg>
                </div>
                <div class="content">
                    <span id="success-modal-title" class="title">Sucesso!</span>
                    <p id="success-modal-message" class="message">Suas alterações foram salvas.</p>
                </div>
            </div>
            <div id="success-modal-progress" class="progress-bar"></div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => { // Garante que o HTML carregou

    /* === LÓGICA PARA O MODAL DE DESATIVAR CONTA === */
    
    // Seleciona os elementos pelo ID
    const openBtn = document.getElementById('open-deactivate-modal-btn');
    const modal = document.getElementById('deactivate-modal');
    const cancelBtn = document.getElementById('cancel-deactivate-btn');
    const confirmBtn = document.getElementById('confirm-deactivate-btn');
    const form = document.getElementById('deactivate-form');

    // Verifica se todos os elementos existem nesta página antes de adicionar eventos
    if (openBtn && modal && cancelBtn && confirmBtn && form) {

        // 1. Abrir o modal
        openBtn.addEventListener('click', () => {
            modal.classList.remove('modal-hidden'); 
        });

        // 2. Fechar no botão Cancelar
        cancelBtn.addEventListener('click', () => {
            modal.classList.add('modal-hidden'); 
        });

        // 3. Fechar clicando no fundo (overlay)
        modal.addEventListener('click', (event) => {
            // Verifica se o clique foi diretamente no overlay
            if (event.target === modal) { 
                modal.classList.add('modal-hidden');
            }
        });

        // 4. Confirmar e enviar o formulário escondido
        confirmBtn.addEventListener('click', () => {
            form.submit(); // Envia o <form id="deactivate-form">
        });

    } 
    // Se os elementos não forem encontrados, não faz nada (evita erros em outras páginas)

    /* === FIM DA LÓGICA DE DESATIVAR === */

    // (Aqui pode vir a lógica do seu modal de LOGOUT, se estiver no mesmo arquivo)

}); // Fim do DOMContentLoaded
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- Lógica do Modal de Sucesso ---
    // ... (seu código do modal de sucesso aqui) ...

    // --- LÓGICA DO PREVIEW DA FOTO DE PERFIL ---
    const fileInput = document.getElementById('profilePicture');
    const imagePreview = document.querySelector('.profile-picture-preview'); // Pega pela classe

    if (fileInput && imagePreview) { // Garante que ambos elementos existem
        fileInput.addEventListener('change', function(event) {
            // Pega o arquivo selecionado (o primeiro, se houver)
            const file = event.target.files[0]; 

            if (file) { // Verifica se um arquivo foi realmente selecionado
                // 1. Cria um objeto FileReader
                const reader = new FileReader();

                // 2. Define o que fazer QUANDO o arquivo for lido
                reader.onload = function(e) {
                    // 'e.target.result' contém a Data URL da imagem
                    imagePreview.src = e.target.result; 
                }

                // 3. Pede ao FileReader para LER o arquivo como Data URL
                // Isso vai disparar o 'onload' quando terminar
                reader.readAsDataURL(file); 
            } else {
                // Opcional: Se o usuário cancelar a seleção, 
                // você pode voltar para a imagem original ou um placeholder
                // imagePreview.src = "{{ $user->getAvatarUrl() }}"; // Exemplo
            }
        });
    }
    // --- FIM DA LÓGICA DO PREVIEW ---

}); // Fim do DOMContentLoaded
</script>
    <!-- modal de sair --> 
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