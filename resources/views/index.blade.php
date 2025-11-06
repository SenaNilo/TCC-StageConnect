<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Página inicial - StageConnect </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script> --}}
</head>

<body>

    <header class="finisher-header index">
        <x-navbar.principal />

        <section class="principal-container">

            <div class="parte-direita-principal">
                <h1 class="titulo-principal"> StageConnect: </h1>
                <p class="descricao-principal">
                    <span class="typed-text"> </span> <span class="cursor">&nbsp; </span>
                </p>
            </div>

            <div class="logo-principal">
                <img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="logo-principal">
            </div>

        </section>
    </header>

    <section id="objetivos" class="section-objetivos">
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

    <section id="proposta" class="section-jornada">
        <div class="jornada-container">
            <h1 class="titulo-jornada"> Por que e para que a StageConnect existe?</h1>
            <div class="jornada-passo">
                <div class="jornada-imagem">
                    <img src="{{ asset('images/figura-index-question.svg') }}" alt="Ilustração de um estudante de TI perdido em uma encruzilhada">
                </div>
                <div class="jornada-texto">
                    <span class="jornada-etapa"></span>
                    <h2>Por onde começar</h2>
                    <p>
                        O mundo da tecnologia é gigante e a área tem crescido. "ADS, SI ou CD?", "Front ou Back?", "O que faz um DevOps?", "O que se faz na área de dados?", "Que experiência/projetos posso ter fazer para melhorar meu prossionalismo". Se você não tem quem indique ou quem aconselhe, você começa a faculdade sem saber para onde ir, ou as vezes nem começa, e também não sabe como avaçar pra ser um profissional de ti  econseguir talvez sua primeira vaga. <span class="negrito-texto"> O StageConnect nasceu para ser o seu guia. </span>
                    </p>
                </div>
            </div>

            <div class="jornada-passo reverse">
                <div class="jornada-imagem">
                    <img src="{{ asset('images/foto-home-usuario.png') }}" alt="Print da tela de conteúdos do StageConnect">
                </div>
                <div class="jornada-texto">
                    <span class="jornada-etapa"></span>
                    <h2>Encontre a sua direção</h2>
                    <p>
                       Como estudantes de TI, nós sentimos essa mesma confusão. Por isso criamos o StageConnect: um espaço que traz as informações que você procura sobre a área de tecnologia. Aqui você encontra guias claros sobre o que cada área faz, dicas sobre entrevistas técnicas, portfólios, e muito mais para te em toda sua jornada.
                    </p>
                </div>
            </div>

            <div class="jornada-passo">
                <div class="jornada-imagem">
                    <img src="{{ asset('images/foto-ferramenta-ia.png') }}" alt="Print do Analisador de Currículo com IA do StageConnect">
                </div>
                <div class="jornada-texto">
                    <span class="jornada-etapa"></span>
                    <h2>Prepare-se com ferramentas reais</h2>
                    <p>
                        Não é só teoria. Use nosso <span class="negrito-texto"> Analisador de Currículo com IA </span> para otimizar seu currículo. Ele lê seu PDF, identifica pontos fortes, sugere melhorias e (na versão completa) até compara seu perfil com a descrição de uma vaga real!
                    </p>
                </div>
            </div>

        </div>
    </section>

    <x-footer />
    <script src="{{ asset('js/write-effect.js') }}"></script>
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
            "skew": 1,
            "shapes": [
                "s",
                "t"
            ]
        });
    </script>

    <script src="https://unpkg.com/scrollreveal"></script>

    <script>
        const sr = ScrollReveal({
            distance: '30px',
            origin: 'bottom',
            duration: 800,
            easing: 'ease-in-out',
            reset: false
        });

        sr.reveal('.titulo-objetivos', {
            delay: 100 // Um pequeno atraso
        });

        sr.reveal('.container-objetivos .card', {
            delay: 200,
            interval: 200
        });

        // Revela o seu footer
        sr.reveal('.footer-container', {
            delay: 100,
            origin: 'top'
        });

        sr.reveal('.jornada-passo', {
            delay: 200, // Atraso
            interval: 100, // Um passo de cada vez
            origin: 'right', // Vem da direita
            distance: '50px' // Um pouco mais de distância
        });
        sr.reveal('.jornada-passo.reverse', {
            delay: 200,
            interval: 100,
            origin: 'left', // O passo reverso vem da esquerda
            distance: '50px'
        });

    </script>
</body>

</html>