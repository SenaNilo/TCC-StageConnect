<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>Análise de currículo - StageConnect </title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    @vite(['resources/css/alunos/aluno.css', 'resources/css/alunos/curriculo.css', 'resources/js/alunos/script-aluno.js', 'resources/js/alunos/modalSair.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <script src='script-aluno.js'></script> --}}
</head>

<body>
    <!-- Responsividade -->
    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>

    <div class="container">
        <x-aluno.sidebarAluno />

        <div class="main-content">
            <div class="main-inicial">
                <div class="upload-card">
                    <div class="card-content">
                        <h1 class="card-title">Analise seu Currículo com IA</h1>
                        <p class="card-description">
                            Esta ferramenta usa Inteligência Artificial para fazer uma pré-análise do seu currículo em PDF. Ela foi treinada para identificar pontos fortes, sugerir melhorias e extrair as principais habilidades (soft skills e hard skills) do seu documento.
                        </p>
                        <p class="card-description">
                            Adicionamos também a opção de você colar a descrição da vaga desejada, o que vai adicionar sugestões personalizadas para aquela oportunidade específica.
                        </p>

                        <!-- O AVISO IMPORTANTE -->
                        <div class="aviso">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div class="aviso-content">
                                <h4>Aviso Importante (Leia antes de enviar)</h4>
                                <ul>
                                    <li>Esta é uma análise <strong>automática</strong>, é gerada por IA e pode ter imprecisões.</li>
                                    <li> Ela serve apenas como <strong>sugestão</strong>.</li>
                                    <li>Ela <strong>não substitui</strong> a análise de um recrutador humano.</li>
                                
                                </ul>
                            </div>
                        </div>

                        <hr class="divider">

                        <!-- O FORMULÁRIO (Aponte para sua rota 'aluno.curriculo.analisar') -->
                        <form id="upload-form" action="{{ route('aluno.curriculo.analisar') }}" method="POST" enctype="multipart/form-data">

                            <!-- Adicione o @csrf aqui no seu Blade -->
                            @csrf

                            <label for="curriculo-input" class="form-label">Anexar seu Currículo <span class="simbolo-required"> * </span> </label>

                            <label for="curriculo-input" class="file-upload-wrapper">
                                <svg class="file-upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-4-4V7a4 4 0 014-4h.5A3.5 3.5 0 0111 2.037a3.5 3.5 0 011.66.964M12 12v4m4-4H8m4 0l3-3m-3 3l-3-3" />
                                </svg>
                                <p class="file-upload-text">
                                    <span>Clique para enviar</span> ou arraste e solte
                                </p>
                                <p id="file-name-display" class="file-name-display">Formato PDF, máx 2MB</p>

                                <input id="curriculo-input" name="curriculo" type="file" class="file-input" accept=".pdf" required>
                            </label>

                            <div class="form-group-vaga" style="margin-top: 1.5rem;">
                                <label for="descricao_vaga" class="form-label">
                                    Cole a Descrição da Vaga (Opcional)
                                </label>
                                <textarea id="descricao_vaga" name="descricao_vaga" rows="8"
                                    class="textarea-vaga"
                                    placeholder="Ex: 'Buscamos Desenvolvedor PHP Pleno com 3 anos de experiência em Laravel, API REST, testes unitários...'"></textarea>
                            </div>

                            <button type="submit" id="submit-button" class="btn-submit">
                                <svg id="spinner" class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span id="button-text">Analisar Agora</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('upload-form');
                    const fileInput = document.getElementById('curriculo-input');
                    const fileNameDisplay = document.getElementById('file-name-display');
                    const submitButton = document.getElementById('submit-button');
                    const spinner = document.getElementById('spinner');
                    const buttonText = document.getElementById('button-text');


                    fileInput.addEventListener('change', () => {
                        if (fileInput.files.length > 0) {
                            fileNameDisplay.textContent = fileInput.files[0].name;
                        } else {
                            fileNameDisplay.textContent = 'Formato PDF, máx 2MB';
                        }
                    });


                    form.addEventListener('submit', () => {
                        submitButton.disabled = true;
                        spinner.style.display = 'inline-block';
                        buttonText.textContent = 'Analisando...';
                    });
                });
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