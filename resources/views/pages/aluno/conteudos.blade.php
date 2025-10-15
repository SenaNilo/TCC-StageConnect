<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Conteúdos - StageConnect</title>
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
{{-- Responsividade --}}
    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>

    <div id="container">
        {{-- Sidebar --}}
        @include('components.navbar.alunoNavbar')


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
                        <i class="fas fa-user-circle fa-4x"></i> 
                    </div>
                @endif
            </div>
            
            <div class="posts-grid">

                <div class="blog-card">
                    <div class="meta">
                        <div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-1.jpg)"></div>
                        <ul class="details">
                            <li class="author">John Doe</li>
                            <li class="date">Aug. 24, 2015</li>
                            <li class="tags">
                            <ul>
                                <li>Learn</li>
                                <li>Code</li>
                                <li>HTML</li>
                                <li>CSS</li>
                            </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="description">
                        <h1>Learning to Code</h1>
                        <h2>Opening a door to the future</h2>
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                        <p class="read-more">
                            <a href="#">Read More</a>
                        </p>
                    </div>
                </div>


                @forelse ($conteudos as $conteudo)

                    <div class="blog-card">
                        <div class="meta">
                            @if ($conteudo->img)
                                <div class="photo" style="background-image: url({{ asset('storage/' . $conteudo->img) }})"></div>
                                {{-- <img class="photo" src="{{ asset('storage/' . $conteudo->img) }}" alt="Imagem do Conteúdo"> --}}
                            @else
                                <div class="photo photo-placeholder">
                                    <span>--sem imagem--</span>
                                </div>
                            @endif

                            <ul class="details">
                                <li class="author"> {{ Str::limit($conteudo->autor->name_user, 25) }} </li>
                                <li class="date"> {{ $conteudo->dt_created->format('M. d, Y') }} </li>
                                <li class="tags">
                                    <ul>
                                        @foreach ($conteudo->tags as $tag)
                                            <li>{{ $tag->name_tag }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <div class="description">
                            <h1>{{ $conteudo->titulo }}</h1>
                            {{-- <h2>Opening a door to the future</h2> SUBTITULO --}}
                            <p> {{ Str::limit($conteudo->descricao, 100) }} </p>
                            <p class="read-more">
                                <a href="#">Read More</a>
                            </p>
                        </div>
                    </div>

                @empty

                    <p class="no-content-message">Nenhum conteúdo ativo encontrado nesta categoria ainda.</p>

                @endforelse
            </div>
        </div>

    </div>

    

</body>
</html>