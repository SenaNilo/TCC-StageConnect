<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Página Inicial</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script> --}}
</head>

<body>

    <header>
        <img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="logo-header"> 
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
                    <li><a href="#">Home</a></li>
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

    <section class="principal-container">

        <div class="parte-direita-principal">
            <h1 class="titulo-principal"> StageConnect: </h1>
            <p class="descricao-principal">
                Conectando você à sua jornada na tecnologia!
            </p>
        </div>

        <div class="logo-principal">
            <img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="logo-principal">
        </div>

    </section>

    <section class="section-objetivos">
        <h1 class="titulo-objetivos"> Qual é o nosso objetivo? </h1>
        <div class="container-objetivos">

            <div class="card bloco-orientar">
                <div class="tools">
                    <div class="circle"><span class="red box"></span></div>
                    <div class="circle"><span class="yellow box"></span></div>
                    <div class="circle"><span class="green box"></span></div>
                </div>
                <div class="card__content">
                    <i class="bi bi-compass icone-bloco"></i>
                    <h2 class="titulo-blocos">Orientar</h2>
                    <p class="descricao-blocos">
                        Ajudar estudantes de TI a entender melhor as áreas da tecnologia, com conteúdo prático sobre entrevistas, testes técnicos e o dia a dia da profissão.
                    </p>
                </div>
            </div>

            <div class="card bloco-conectar">
                <div class="tools">
                    <div class="circle"><span class="red box"></span></div>
                    <div class="circle"><span class="yellow box"></span></div>
                    <div class="circle"><span class="green box"></span></div>
                </div>
                <div class="card__content">
                    <i class="bi bi-link icone-bloco"> </i>
                    <h2 class="titulo-blocos">Conectar</h2>
                    <p class="descricao-blocos">
                        Aproximar estudantes do mundo profissional, apresentando conteúdos e ferramentas que ligam teoria à prática, com foco em preparação real para o mercado de TI.
                    </p>
                </div>
            </div>

            <div class="card bloco-impulsionar">
                <div class="tools">
                    <div class="circle"><span class="red box"></span></div>
                    <div class="circle"><span class="yellow box"></span></div>
                    <div class="circle"><span class="green box"></span></div>
                </div>
                <div class="card__content">
                    <i class="bi bi-rocket icone-bloco"></i>
                    <h2 class="titulo-blocos">Impulsionar</h2>
                    <p class="descricao-blocos">
                        Despertar a confiança e o protagonismo de aspirantes na área por meio de conteúdo que motiva, informa e direciona para um futuro profissional promissor.
                    </p>
                </div>
            </div>

        </div>

    </section>

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