<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem Enviada!</title>
    <link rel="icon" type="image/png" href="images/LogoSFundo.png" />
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .thank-you-card {
            background: #fff;
            padding: 60px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
            animation: fadeIn 0.8s ease;
        }
        .icon-check {
            font-size: 80px;
            color: #00ca4e; /* Verde Sucesso */
            margin-bottom: 20px;
            display: block;
        }
        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 15px;
        }
        p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn-voltar {
            display: inline-block;
            background-color: #c30a19; /* Vermelho do seu tema */
            color: #fff;
            padding: 15px 35px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
        }
        .btn-voltar:hover {
            background-color: #000;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="thank-you-card">
        <i class="bi bi-check-circle-fill icon-check"></i>
        <h1>Mensagem Enviada!</h1>
        <p>Recebemos seu contato com sucesso. <br> Responderemos o mais breve possível no seu e-mail.</p>
        
        <a href="{{ url('/') }}" class="btn-voltar">Voltar ao Início</a>
    </div>

</body>
</html>