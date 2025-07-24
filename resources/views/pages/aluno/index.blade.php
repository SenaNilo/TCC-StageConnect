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