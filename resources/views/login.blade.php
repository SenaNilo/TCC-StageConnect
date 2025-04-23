<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Objetivo: Tirar os arquivos desnecessarios e transferir as classes bootstraps para o css puro, as fontes e os ícones: pegar da internet nao sendo como arquivo -->
	
	
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
	
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
						<a class="txt2" href="#">
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
