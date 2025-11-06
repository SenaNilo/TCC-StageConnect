@php
    use Illuminate\Support\Str; 
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Conteúdos - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> -->
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    @vite(['resources/css/alunos/aluno.css', 'resources/css/alunos/conteudos.css', 'resources/js/alunos/script-aluno.js', 'resources/js/alunos/modalSair.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <script src='script-aluno.js'></script> --}}

</head>

<body>
    {{-- Responsividade --}}
    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>

    <div class="container">
        <x-aluno.sidebarAluno />


        <div class="main-content">
            <div class="main-inicial">
                <h1 class="page-title">{{ $titulo }}</h1>
                {{-- <img src="{{ asset('images/larissafoto.jpg') }}" alt="Imagem de boas-vindas" class="perfil-img"> --}}
                {{-- LÓGICA DA FOTO DE PERFIL --}}
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

            <div class="content-header">
            {{-- Título da Seção (Opcional, pode remover se redundante com page-title) --}}
            {{-- <h1 class="content-title">Todos os Conteúdos</h1> --}} 
            
            {{-- Container para Busca e Filtros --}}
            <div class="search-and-filters">
                {{-- Barra de Busca --}}
                <div class="search-bar">
                    <span class="material-symbols-rounded">search</span>
                    <input type="search" placeholder="Buscar Conteúdos..." name="search" id="content-search"> 
                </div>
                {{-- Botões de Filtro --}}
                <div class="filter-buttons">
                    <button class="filter-btn" type="button"> 
                        <span class="material-symbols-rounded">schedule</span>
                        Mais Recentes
                    </button>
                    <button class="filter-btn" type="button"> 
                        <span class="material-symbols-rounded">filter_list</span>
                        Filtrar por Área
                    </button>
                    {{-- Adicione mais botões aqui se precisar --}}
                </div>
            </div>
        </div>

        {{-- Linha Divisória (Opcional) --}}
        <hr class="content-divider">
        <div class="content-grid">
                {{-- Loop @forelse para exibir cada conteúdo ou a mensagem de vazio --}}
                @forelse ($conteudos as $conteudo) 
                    <article class="content-item-card">
                        {{-- Thumbnail (Imagem ou Ícone Padrão) --}}
                        <div class="card-thumbnail">
                            {{-- Usa o campo 'img' --}}
                            @if ($conteudo->img) 
                                <img src="{{ asset('storage/' . $conteudo->img) }}" alt="Thumbnail para {{ $conteudo->titulo }}"> 
                            @else
                                <span class="material-symbols-rounded"> description </span> 
                            @endif
                        </div>
                        
                        {{-- Corpo do Card --}}
                        <div class="card-body">
                            
                            {{-- Título --}}
                            <h2 class="card-title">{{ $conteudo->titulo }}</h2> 

                            {{-- Metadados (Autor e Data) --}}
                            <div class="card-meta">
                                <span class="meta-item">
                                    <span class="material-symbols-rounded icon">person</span> 
                                    {{-- Ajuste 'name' se o campo for 'name_user' --}}
                                    {{ $conteudo->autor?->name ?? 'Autor Desconhecido' }} 
                                </span>
                                <span class="meta-item">
                                    <span class="material-symbols-rounded icon">calendar_month</span>
                                    {{-- Usa 'dt_created' e formata --}}
                                    {{ $conteudo->dt_created ? \Carbon\Carbon::parse($conteudo->dt_created)->format('d/m/Y') : 'Data Indisponível' }} 
                                </span>
                            </div>
                            {{-- Tags --}}
                            @if ($conteudo->tags && $conteudo->tags->isNotEmpty())
                                <div class="card-tags">
                                    <span class="material-symbols-rounded icon">sell</span>
                                    @foreach ($conteudo->tags as $tag)
                                        {{-- Ajuste 'name' para o campo da sua tag --}}
                                        <span class="tag-item">{{ $tag->name }}</span> 
                                    @endforeach
                                </div>
                            @endif
                            <p class="card-description">
                                {{ Str::limit(strip_tags($conteudo->descricao ?? ''), 100) }}
                            </p> 
                            
                            {{-- Botão "Ver mais" --}}
                        <a href="{{ route('aluno.conteudo.detalhe', ['id' => $conteudo->id, 'from' => $origem ?? 'todos']) }}" class="card-button">Ver mais</a>
                            
                        </div> 
                    </article>
                @empty
                    <div class="empty-state-message" style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--color-text-secondary);">
                        <span class="material-symbols-rounded" style="font-size: 48px; display: block; margin-bottom: 10px;">sentiment_dissatisfied</span>
                        <p>Nenhum conteúdo encontrado no momento para esta seção.</p>
                    </div>
                @endforelse 

            </div> 
        </div>
    </div> 
    </div>
    </div>

    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    
    {{-- Modal de Logout --}}
    <div id="logout-modal" class="modal-overlay modal-hidden">
       <div class="card-cancelar">
           <div class="header-cancelar">
               <div class="image">
                   <span class="material-symbols-rounded">warning</span>
               </div>
               <div class="content">
                   <span class="title">Sair da Conta</span>
                   <p class="message">Você tem certeza que deseja sair?</p>
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