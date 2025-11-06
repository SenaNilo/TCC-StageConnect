<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Nova Senha | Stage Connect</title>
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

                <!-- Formulário que aponta para a rota 'password.update' -->
                <form class="form validate-form" method="POST" action="{{ route('password.update') }}">
                    @csrf 
                    <h1 class="form-title">Cadastrar Nova Senha</h1>

                    <!-- Mensagens de Erro (Token expirado, senhas não batem, etc.) -->
                    @if ($errors->any())
                    <div style="color: red; margin-bottom: 15px; font-size: 14px; line-height: 1.5; text-align: left;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Campos Escondidos (Token e Email) - ESSENCIAL -->
                    <input type="hidden" name="token" value="{{ $token }}">
                    <!-- O e-mail vem da URL (enviado pelo controller) -->
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    <!-- E-mail (Apenas para o usuário ver, não editável) -->
                    <div class="group-input">
                        <input class="input" type="text" value="{{ $email ?? old('email') }}" placeholder="Email" readonly disabled>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Nova Senha -->
                    <div class="group-input validate-input" data-validate="Necessário senha">
                        <input class="input" type="password" name="password" placeholder="Nova Senha" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Confirmar Nova Senha -->
                    <div class="group-input validate-input" data-validate="Confirme a senha">
                        <input class="input" type="password" name="password_confirmation" placeholder="Confirmar Nova Senha" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="login-form-btn">
                        <button class="form-btn">
                            Redefinir Senha
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