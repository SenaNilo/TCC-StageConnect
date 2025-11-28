<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sobre nós - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/sobre-nos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script> --}}
</head>

<body>

    <header class="finisher-header" style="position: relative;">
        <x-navbar.principal />
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
                    <button class="card__btn"> <a href="https://www.linkedin.com/in/larissafsantos685/" target="_blank"> LinkedIn </a></button>
                    <button class="card__btn card__btn-solid"><a href="https://larifsantos685.github.io/larissafportfolio/"> Ver mais </a></button>
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
                    <button class="card__btn"> <a href="https://www.linkedin.com/in/danilo-s-s/" target="_blank"> LinkedIn </a></button>
                    <button class="card__btn card__btn-solid"> <a href="https://senanilo.github.io/MeuPortfolio/"> Ver mais </a></button>
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
                    <button class="card__btn"><a href="https://www.linkedin.com/in/cristhoferchow/"> LinkedIn </a></button>
                    <button class="card__btn card__btn-solid"> <a href="https://www.linkedin.com/in/cristhoferchow/"> Ver mais </a></button>
                </div>
            </div>


        </div>
    </section>
    <section class="formulario" id="contato">
        <div class="interface">
            <h2 class="titulo">Ficou com alguma <span>dúvida?</span></h2>

            <p class="subtitulo">Preencha o formulário e envie para entrar em contato conosco.</p>

            <form method="POST" action="https://formsubmit.co/stageconnect8@gmail.com">
                <input type="hidden" name="_next" value="{{ url('/obrigado') }}">
                <input type="hidden" name="_captcha" value="false">

                <input type="text" name="nome" id="nome" placeholder="Seu nome completo *" required>
                <input type="email" name="email" id="email" placeholder="Seu e-mail *" required>
                <input type="tel" name="telefone" id="telefone" placeholder="Seu telefone (opcional)">
                <textarea name="mensagem" id="mensagem" placeholder="Escreva sua mensagem aqui..." required></textarea>

                <div class="btn-enviar">
                    <input type="submit" value="ENVIAR MENSAGEM">
                </div>
            </form>
        </div>
    </section>

    <x-footer />
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
    <script src="{{ asset('js/finisher-header.es5.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        new FinisherHeader({
            "count": 150,
            "size": {
                "min": 2,
                "max": 6,
                "pulse": 0.1
            },
            "speed": {
                "x": {
                    "min": 0,
                    "max": 0.5
                },
                "y": {
                    "min": 0,
                    "max": 0.6
                }
            },
            "colors": {
                "background": "#000000",
                "particles": [
                    "#c30a19",
                    "#224e59",
                    "#00ca4e"
                ]
            },
            "blending": "overlay",
            "opacity": {
                "center": 1,
                "edge": 0.35
            },
            "skew": 0,
            "shapes": [
                "s",
                "t"
            ]
        });
    </script>
</body>

</html>