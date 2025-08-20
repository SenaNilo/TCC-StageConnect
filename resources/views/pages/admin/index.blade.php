<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Administrador</title>
    {{-- Css's --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/init.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navbar.css') }}">
</head>
<body>
    <main style="display: grid;
grid-template-columns: repeat(12, 1fr);
grid-template-rows: 1fr;
grid-column-gap: 0px;
grid-row-gap: 0px;">
        <nav style="grid-area: 1 / 1 / 2 / 4;">
            @include('components.navbar.sdAdmin')
        </nav>

    
        <aside style="grid-area: 1 / 4 / 2 / 13;">
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
            
                    <h1>ola </h1>
                </div>
        </aside>
    </main>
</body>
</html>