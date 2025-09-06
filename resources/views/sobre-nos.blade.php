<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sobre nós - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
      <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}"/>
    <link rel="stylesheet" href="{{ asset('css/sobre-nos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script> --}}
</head>

<body>

    <header>
        <a href="{{ url('/') }}"><img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="logo-header"></a>
        <!-- <h2 class="titulo-header"> StageConnect </h2> -->

        <!-- Botão Hamburger -->
        <div class="btn-abrir-menu" id="btn-abrir-menu">
            <i class="bi bi-list"></i>
        </div>

        <!-- Menu desktop -->
        <nav class="nav-desktop">
            <ul class="menu-header">
                <li class="lista-header"><a href="{{ url('/') }}">Home</a></li>
                <li class="lista-header">Objetivo</li>
                <li class="lista-header">Informações</li>
                <li class="lista-header">Sobre nós</li>
            </ul>
            <div class="dropdown">
                <button class="botao-nav">Comece já</button>
                <div class="dropdown-content">
                    <a href="#">Login</a>
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
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#">Objetivo</a></li>
                    <li><a href="#">Informações</a></li>
                    <li><a href="#">Sobre nós</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Cadastro</a></li>
                </ul>
            </nav>
        </div>

        <div class="overlay-menu" id="overlay-menu"></div>
    </header>

    <section class="us-principal">
        <div class="container-principal">

            <div class="card-container">
                <div class="card__background">
                </div>
                <div class="card__avatar">
                    <img src="{{ asset('images/larissafoto.jpg') }}" alt="Larissa Fernanda">
                </div>
                <div class="card__title">Larissa Fernanda</div>
                <div class="card__subtitle">Desenvolvedora FullStack</div>
                <div class="card__wrapper">
                    <button class="card__btn">LinkedIn</button>
                    <button class="card__btn card__btn-solid"> Ver mais</button>
                </div>
            </div>

            <div class="card-container">
                <div class="card__background">
                </div>
                <div class="card__avatar">
                    <img src="{{ asset('images/danilofoto.jpg') }}" alt="Danilo Sena">
                </div>
                <div class="card__title">Danilo Sena</div>
                <div class="card__subtitle">Desenvolvedor FullStack</div>
                <div class="card__wrapper">
                    <button class="card__btn">LinkedIn</button>
                    <button class="card__btn card__btn-solid">Ver mais</button>
                </div>
            </div>

            <div class="card-container">
                <div class="card__background">
                </div>
                <div class="card__avatar">
                    <img src="{{ asset('images/cristoferfoto.jpg') }}" alt="Larissa Fernanda">
                </div>
                <div class="card__title">Cristhofer Chow </div>
                <div class="card__subtitle">Infraestrutura </div>
                <div class="card__wrapper">
                    <button class="card__btn">LinkedIn</button>
                    <button class="card__btn card__btn-solid">Ver mais</button>
                </div>
            </div>

        </div>
    </section>
    <!-- <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/sobre-nos.js') }}"></script>
    -->
    <footer class="footer footer-container">
        <div class="footer-logo">
            <img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect">
            <p>StageConnect</p>
        </div>
        <div class="footer-informacoes">
            <h3>Informações</h3>
            <ul>
                <li><a href="#">Objetivos</a></li>
                <li><a href="#">Sobre nós</a></li>
            </ul>
        </div>
        <div class="footer-informacoes">
            <h3>Informações</h3>
            <ul>
                <li><a href="#">Funcionamento</a></li>
            </ul>
        </div>
        <div class="footer-contatos">
            <h3>Contatos</h3>
            <p><i class="bi bi-telephone-fill"></i> 13 98890-2910</p>
            <p><i class="bi bi-envelope-fill"></i> email@gmail.com</p>
        </div>
    </footer>

   <script>
        const btnAbrir = document.getElementById("btn-abrir-menu");
        const btnFechar = document.getElementById("btn-fechar-menu");
        const menuMobile = document.getElementById("menu-mobile");
        const overlay = document.getElementById("overlay-menu");

        btnAbrir.addEventListener("click", () => {
            menuMobile.classList.add("abrir-menu");
            overlay.style.display = "block";
        });

        btnFechar.addEventListener("click", () => {
            menuMobile.classList.remove("abrir-menu");
            overlay.style.display = "none";
        });

        overlay.addEventListener("click", () => {
            menuMobile.classList.remove("abrir-menu");
            overlay.style.display = "none";
        });
    </script>
</body>

</html>