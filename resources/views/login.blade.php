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
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
	
</head>
<body>
	
	<main>
		<section class="login">
			<div class="login-box">
				<img class="image-tilt js-tilt" src="{{ asset('images/FundoBrancopng.png') }}" alt="Logo da Stage Connect" data-tilt>

				<form class="form validate-form">
					<h1 class="form-title">
						Login
					</h1>

					<div class="group-input validate-input" data-validate = "Email necessário: usuario@email.com">
						<input class="input" type="text" name="email" placeholder="Email">
						<span class="focus-input"></span>
						<span class="symbol-input">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="group-input validate-input" data-validate = "Necessário senha">
						<input class="input" type="password" name="pass" placeholder="Senha">
						<span class="focus-input"></span>
						<span class="symbol-input">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="login-form-btn">
						<button class="form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Esqueci seu
						</span>
						<a class="txt2" href="#">
							Email / Senha?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="{{ uri('/cadastro') }}">
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

	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

	<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
