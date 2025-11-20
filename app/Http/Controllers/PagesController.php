<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Conteudo;
use App\Models\Categoria;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB; // Necessário

class PagesController extends Controller
{
    // AÇÃO CRÍTICA: Força a reconexão imediatamente ao carregar o Controller
    public function __construct()
    {
        // Garante que o PHP e o Laravel tentem abrir uma conexão nova a cada request
        DB::reconnect(); 
    }

    public function login()
    {
        return view('auth.login');
    }

    public function cadastro()
    {
        return view('auth.cadastro');
    }

    // ... (Mantendo os outros métodos de conteúdo/filtro/admin) ...
    // ... (os métodos getFilteredContent, orientacaoProfissional, etc. permanecem os mesmos) ...

    /**
     * Cadastrar a pessoa no banco de dados
     */
    public function storeCadastro(Request $request)
    {
        // 1. Validação dos dados (SEM a regra 'unique' para evitar o erro de conexão)
        $validator = Validator::make($request->all(), [
            'name_user' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:20'], // REGRA 'UNIQUE' REMOVIDA
            'password' => ['required', 'string', 'min:6', 'confirmed'], 
        ], [
            // Mensagens de erro
            'name_user.required' => 'O campo Nome é obrigatório.',
            'name_user.max' => 'O Nome não pode ter mais de 25 caracteres.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.max' => 'O Email não pode ter mais de 20 caracteres.',
            'password.required' => 'O campo Senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ]);

        // Se a validação falhar, redireciona de volta com os erros e os dados antigos
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // ----------------------------------------------------
        // 2. CHECAGEM MANUAL DE UNICIDADE (CORRIGE O ERRO DE CONEXÃO AGORA)
        // ----------------------------------------------------
        // A CONEXÃO JÁ ESTÁ ATIVA devido ao __construct()
        $emailExists = Usuario::where('email', $request->email)->exists();
        
        if ($emailExists) {
            // Se o email já existe, retorna o erro personalizado
            return redirect()->back()
                ->withErrors(['email' => 'Este email já está cadastrado.'])
                ->withInput();
        }
        // ----------------------------------------------------


        // 3. Criação do Usuário
        $usuario = Usuario::create([
            'name_user' => $request->name_user,
            'email' => $request->email,
            'password_user' => Hash::make($request->password), 
            'type_user' => 'ALU', 
            'active_user' => TRUE, 
        ]);

        // 4. Login após o cadastro e redirecionamento
        Auth::login($usuario);

        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Login e start da sessao
     */
    public function authenticate(Request $request)
    {
        // Não é necessário o DB::reconnect() aqui, o __construct() garante isso
        
        // validação dos dados de entrada
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'password.required' => 'O campo Senha é obrigatório.',
        ]);

        // autenticar o usuário com o banco
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // ... (Lógica de sucesso) ...
        }

        // caso der erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email'); 
    }
    
    // ... (Restante dos métodos)
}