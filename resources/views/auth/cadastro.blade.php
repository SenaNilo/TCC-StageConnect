<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>Cadastro | Stage Connect</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{-- Icone Aba --}}
	<link rel="icon" type="image/ico" href="{{ asset('images/LogoSFundo.ico') }}">


	{{-- Font Awesome --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

	{{-- Css's --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/init.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
	
</head>
<body>
	
	<main>
		<section class="login cadastrar-background">
			<div class="login-box">
				<img class="image-tilt js-tilt" src="{{ asset('images/FundoBrancopng.png') }}" alt="Logo da Stage Connect" data-tilt>

				<form class="form validate-form" method="POST" action="{{ route('storeCadastro') }}">
                    @csrf {{-- Token CSRF para segurança --}}

                    <h1 class="form-title">
                        Cadastre-se
                    </h1>

                    {{-- Exibe mensagens de sucesso, se houver --}}
                    @if (session('success'))
                        <div class="alert alert-success" style="color: green; text-align: center; margin-bottom: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Campo Nome Completo --}}
                    <div class="group-input validate-input @error('name_user') alert-validate @enderror" data-validate="Nome necessário!">
                        <input class="input" type="text" name="name_user" placeholder="Nome Completo" value="{{ old('name_user') }}">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('name_user')
                        <span class="text-danger" style="color: red; font-size: 0.8em; margin-top: -10px; margin-bottom: 10px; display: block;">{{ $message }}</span>
                    @enderror

                    {{-- Campo Email --}}
                    <div class="group-input validate-input @error('email') alert-validate @enderror" data-validate="Email necessário: usuario@email.com">
                        <input class="input" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('email')
                        <span class="text-danger" style="color: red; font-size: 0.8em; margin-top: -10px; margin-bottom: 10px; display: block;">{{ $message }}</span>
                    @enderror

                    {{-- Campo Senha --}}
                    <div class="group-input validate-input @error('password') alert-validate @enderror" data-validate="Necessário senha">
                        <input class="input" type="password" name="password" placeholder="Senha" minlength="6">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-danger" style="color: red; font-size: 0.8em; margin-top: -10px; margin-bottom: 10px; display: block;">{{ $message }}</span>
                    @enderror

                    {{-- Campo Confirmar Senha --}}
                    <div class="group-input validate-input @error('password_confirmation') alert-validate @enderror" data-validate="Necessário confirmação de senha">
                        <input class="input" type="password" name="password_confirmation" placeholder="Confirmar senha">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-unlock" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger" style="color: red; font-size: 0.8em; margin-top: -10px; margin-bottom: 10px; display: block;">{{ $message }}</span>
                    @enderror
                    
                    <div class="login-form-btn">
                        <button class="form-btn" type="submit">
                            Cadastrar
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="{{ route('login') }}">
                            Já tenho uma conta!
                        </a>
                    </div>
                </form>
			</div>
		</section>
	</main>
	
	

	

	<!-- Importação Jquery -->
	<script src="{{ asset('js/imports/jquery-3.2.1.min.js') }}"></script>
	<!-- Animacao da imagem -->
	<script src="{{ asset('js/imports/tilt.jquery.min.js') }}"></script>

	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

	<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>