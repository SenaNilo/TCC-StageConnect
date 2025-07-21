<h1>Vai se matricular </h1>

{{-- Exemplo de botão de Logout --}}
{{-- Coloque este código onde você deseja que o botão apareça, por exemplo, em um cabeçalho ou menu --}}

@auth {{-- Verifica se o usuário está logado para mostrar o botão --}}
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
@endauth

{{-- Você pode adicionar um link condicional para login/cadastro se o usuário não estiver logado --}}
@guest {{-- Verifica se o usuário NÃO está logado --}}
    <a href="{{ route('login') }}" style="
        background-color: #007bff; /* Cor azul para login */
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        display: inline-block;
    ">
        Login
    </a>
    <a href="{{ route('cadastro.form') }}" style="
        background-color: #28a745; /* Cor verde para cadastro */
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        display: inline-block;
        margin-left: 10px;
    ">
        Cadastre-se
    </a>
@endguest
