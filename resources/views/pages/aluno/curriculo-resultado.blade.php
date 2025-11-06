<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>Análise de currículo - StageConnect </title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    @vite(['resources/css/alunos/aluno.css', 'resources/css/alunos/curriculo-resultado.css', 'resources/js/alunos/script-aluno.js', 'resources/js/alunos/modalSair.js'])
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

            <main class="main-curriculo">

                <div class="page-header-container">

                    <div class="page-header-left">
                        <h1 class="main-header">Análise Concluída</h1>
                        <p class="main-subheader">Aqui está o que nossa IA encontrou no seu currículo. Use estas dicas para melhorá-lo!</p>
                        <a href="{{ route('aluno.curriculo.form') }}" class="btn-voltar">Analisar Outro Currículo</a>
                    </div>


                    <div class="mini-aviso">
                        <h4 class="mini-aviso-title">
                            <svg class="icon-orange" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Aviso: NÃO MINTA!
                        </h4>
                        <p class="mini-aviso-text">
                            As sugestões são para <span class="negrito"> reescrever e destacar </span> o que você <span class="negrito">já possui </span>. O objetivo é otimizar, não inventar.
                        </p>
                    </div>

                </div>


                <!-- O Grid do Dashboard -->
                <div class="dashboard-grid">

                    <!-- Coluna da Esquerda (Maior) -->
                    <div class="left-column grid-col-span-2">

                        @if (isset($analise['sugestoes_com_base_na_vaga']))


                        <div class="ia-card">
                            <h2 class="card-title">
                                <svg class="icon-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.23a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                                Sugestões com Base na Vaga
                            </h2>
                            <ul>
                                @foreach($analise['sugestoes_com_base_na_vaga'] as $sugestao)
                                <li>
                                    <svg class="icon-arrow-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $sugestao }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <!-- Card: Pontos Fortes -->
                        @if (isset($analise['pontos_fortes']) && is_array($analise['pontos_fortes']))
                        <div class="ia-card">
                            <h2 class="card-title">
                                <svg class="icon-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pontos Fortes
                            </h2>
                            <ul>
                                @foreach($analise['pontos_fortes'] as $ponto)
                                <li>
                                    <svg class="icon-arrow-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $ponto }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Card: Pontos a Melhorar -->
                        @if (isset($analise['pontos_a_melhorar']) && is_array($analise['pontos_a_melhorar']))
                        <div class="ia-card">
                            <h2 class="card-title">
                                <svg class="icon-orange" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pontos a Melhorar
                            </h2>
                            <ul>
                                @foreach($analise['pontos_a_melhorar'] as $ponto)
                                <li>
                                    <svg class="icon-arrow-orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $ponto }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>


                    <!-- Coluna da Direita (Menor) -->
                    <div class="right-column">

                        <!-- Card de Área Sugerida -->
                        @if (isset($analise['possivel_area']))
                        <div class="ia-card">
                            <h2 class="card-subheader">
                                Área de Atuação Sugerida
                            </h2>
                            <p class="area-text">
                                {{ $analise['possivel_area'] }}
                            </p>
                        </div>
                        @endif

                        <!-- Card: Habilidades Identificadas -->
                        @if (isset($analise['habilidades_encontradas']) && is_array($analise['habilidades_encontradas']))
                        <div class="ia-card">
                            <h2 class="card-subheader">
                                Habilidades Identificadas
                            </h2>
                            <div class="tags-container">
                                @foreach($analise['habilidades_encontradas'] as $habilidade)
                                <span class="tag">{{ $habilidade }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                </div>

            </main>
        </div>

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