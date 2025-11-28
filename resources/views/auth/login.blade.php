<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>Login | Stage Connect</title>
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
		<section class="login">
			<a href="{{ url('/') }}" class="back-arrow">
				<i class="fa fa-arrow-left"></i>
			</a>
			<div class="login-box">
				<img class="image-tilt js-tilt" src="{{ asset('images/FundoBrancopng.png') }}" alt="Logo da Stage Connect" data-tilt>

				<form class="form validate-form" method="POST" action="{{ route('login.authenticate') }}">
					@csrf <!-- Token CSRF seguranca -->

					<h1 class="form-title">
						Login
					</h1>

					{{-- Exibir mensagens de erro de validação --}}
					@if ($errors->any())
					<div class="alert-danger" style="color: red; margin-bottom: 15px;">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

					{{-- Exibir mensagem de sucesso --}}
					@if (session('success'))
					<div class="alert-success" style="color: green; margin-bottom: 15px;">
						{{ session('success') }}
					</div>
					@endif

					<div class="group-input validate-input {{ $errors->has('email') ? 'alert-validate' : '' }}"" data-validate = " Email necessário: usuario@email.com">
						<input class="input" type="text" name="email" placeholder="Email">
						<span class="focus-input"></span>
						<span class="symbol-input">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="group-input validate-input {{ $errors->has('password') ? 'alert-validate' : '' }}" data-validate="Necessário senha">
						<input class="input" type="password" name="password" placeholder="Senha">
						<span class="focus-input"></span>
						<span class="symbol-input">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="login-form-btn">
						<button class="form-btn">
							Entrar
						</button>
					</div>

					<div style="margin-top: auto;"> </div>
					<div class="text-center p-t-20">
						<span class="txt1">
							Esqueci minha
						</span>
						<a class="txt2" href="{{ route('password.request') }}">
							Senha
						</a>
					</div>

					<div class="text-center p-t-50">
						<a class="txt2" href="{{ route('cadastro') }}">
							Criar sua Conta
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

	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

	<script src="{{ asset('js/login.js') }}"></script>

</body>

</html>