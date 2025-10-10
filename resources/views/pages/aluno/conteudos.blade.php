{{-- resources/views/pages/aluno/conteudos.blade.php --}}
 {{-- orientacaoProfissional Use o layout base do aluno se tiver um --}}
<head>
    <title>Conteúdos - StageConnect</title>
</head>
<body>

    <div class="content-wrapper">
        <h1 class="page-title">{{ $titulo }}</h1>
        <p class="page-subtitle">Navegue pelos guias e materiais de apoio desta área.</p>
        
        <div class="posts-grid">
            @forelse ($conteudos as $conteudo)
                <div class="post-card post-style-feed">
                    
                    {{-- Imagem de Destaque (Estilo de Post/Feed) --}}
                    @if ($conteudo->img)
                        <div class="post-image-container">
                            <img src="{{ asset('storage/' . $conteudo->img) }}" alt="Imagem do Conteúdo" class="post-image">
                        </div>
                    @endif

                    <div class="post-details">
                        {{-- Título --}}
                        <h2 class="post-title">{{ $conteudo->titulo }}</h2>
                        
                        {{-- Descrição Resumida --}}
                        <p class="post-description">{{ Str::limit($conteudo->descricao, 100) }}</p> 
                        
                        {{-- Tags --}}
                        <div class="post-tags">
                            @foreach ($conteudo->tags as $tag)
                                <span class="badge tag-badge">{{ $tag->name_tag }}</span>
                            @endforeach
                        </div>
                        
                        {{-- Botão de Acesso --}}
                        {{-- <a href="{{ route('conteudo.detalhe', $conteudo->id) }}" class="btn btn-primary">Ver Guia Completo</a> --}}
                    </div>
                </div>
            @empty
                <p class="no-content-message">Nenhum conteúdo ativo encontrado nesta categoria ainda.</p>
            @endforelse
        </div>
    </div>

</body>