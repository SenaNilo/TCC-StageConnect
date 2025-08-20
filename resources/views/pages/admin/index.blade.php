<!DOCTYPE html>
<html>
<head>
    <title>Home | Administrador</title>
    {{-- Dashboard --}}
</head>
<body>
    <h1> Pagina secreta para admins </h1>

    {{-- O codigo abaixo é copiado de aluno --}}

    {{-- botão de Logout --}}
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf {{-- Token CSRF para segurança --}}
            <button type="submit" class="button-logout" style="
                background-color: #dc3545; /* Cor vermelha para logout */
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                text-decoration: none; /* Para parecer um botão, não um link */
                display: inline-block; /* Permite padding e margem */
                margin-left: 10px; /* Espaçamento, se necessário */
            ">
                Sair
            </button>
        </form>
        <div>
            @include('components.navbar.sdAdmin')
            <h1>ola </h1>
        </div>
</body>
</html>