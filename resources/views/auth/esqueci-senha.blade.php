<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Esqueci a Senha | Stage Connect</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="{{ asset('images/LogoSFundo.ico') }}">
    <!-- Links de CSS (assumindo a mesma estrutura do seu login.blade.php) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/init.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main>
        <section class="login">
            <!-- Botão de Voltar para o Login -->
            <a href="{{ route('login') }}" class="back-arrow">
                <i class="fa fa-arrow-left"></i>
            </a>

            <div class="login-box">
                <!-- A imagem com efeito tilt (igual ao login) -->
                <img class="image-tilt js-tilt" src="{{ asset('images/FundoBrancopng.png') }}" alt="Logo" data-tilt>

                <!-- Formulário que aponta para a rota 'password.email' -->
                <form class="form validate-form" method="POST" action="{{ route('password.email') }}">
                    @csrf 
                    <h1 class="form-title">Redefinir Senha</h1>

                    <!-- Mensagem de Sucesso (Status) -->
                    @if (session('status'))
                        <div style="color: green; margin-bottom: 15px; text-align: center; font-size: 14px; line-height: 1.5;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Mensagens de Erro (E-mail não encontrado, etc.) -->
                    @if ($errors->any())
                    <div style="color: red; margin-bottom: 15px; text-align: center; font-size: 14px; line-height: 1.5;">
                        {{ $errors->first('email') }}
                    </div>
                    @endif

                    <p class="txt1" style="text-align: center; margin-bottom: 25px; color: var(--gray);">
                        Digite seu e-mail e enviaremos um link para você redefinir sua senha.
                    </p>

                    <!-- Campo de E-mail -->
                    <div class="group-input validate-input" data-validate="Email necessário: usuario@email.com">
                        <input class="input" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="login-form-btn">
                        <button class="form-btn">
                            Enviar Link
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    
    <!-- Scripts (JQuery e Tilt) -->
    <script src="{{ asset('js/imports/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/imports/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
</body>
</html>