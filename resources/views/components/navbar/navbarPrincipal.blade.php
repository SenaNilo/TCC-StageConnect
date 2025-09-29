<div class="headernav-container">
    <a href="{{ url('/') }}"><img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="logo-header"></a>
    <!-- <h2 class="titulo-header"> StageConnect </h2> -->

    <!-- Botão Hamburger -->
    <div class="btn-abrir-menu" id="btn-abrir-menu">
        <i class="bi bi-list"></i>
    </div>

    <!-- Menu desktop -->
    <nav class="nav-desktop">
        <ul class="menu-header">
            <li class="lista-header">Home</li>
            <li class="lista-header">Objetivo</li>
            <li class="lista-header">Informações</li>
            <li class="lista-header"><a href="{{ url('/sobre-nos') }}">Sobre nós</a></li>
        </ul>
        <div class="dropdown">
            <button class="botao-nav">Comece já</button>
            <div class="dropdown-content">
                <a href="{{ route('login') }}">Login</a>
                <a href="#">Cadastro</a>
            </div>
        </div>
    </nav>

    <!-- Menu mobile -->
    <div class="menu-mobile" id="menu-mobile">
        <div class="btn-fechar" id="btn-fechar-menu">
            <i class="bi bi-x-lg"></i>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Objetivo</a></li>
                <li><a href="#">Informações</a></li>
                <li><a href="{{ url('/sobre-nos') }}">Sobre nós</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="#">Cadastro</a></li>
            </ul>
        </nav>
    </div>

    <div class="overlay-menu" id="overlay-menu"></div>
</div>