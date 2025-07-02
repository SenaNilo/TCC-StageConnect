<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    // public function index(){
    //     return view('index');
    // }

    public function login(){
        return view('auth/login');
    }

    public function cadastro(){
        return view('auth/cadastro');
    }

    public function stageconnect(){
        return view('pages/stageconnect');
    }

    public function storeCadastro(Request $request)
    {
        // 1. Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'name_user' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:20', 'unique:usuarios,email'], // 'unique:tabela,coluna'
            'password' => ['required', 'string', 'min:6', 'confirmed'], // 'confirmed' exige um campo 'password_confirmation'
        ], [
            // Mensagens de erro personalizadas
            'name_user.required' => 'O campo Nome é obrigatório.',
            'name_user.max' => 'O Nome não pode ter mais de 25 caracteres.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.max' => 'O Email não pode ter mais de 20 caracteres.',
            'email.unique' => 'Este email já está cadastrado.',
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

        // Usa o modelo Usuario para criar um novo registro na tabela 'usuarios'
        $usuario = Usuario::create([
            'name_user' => $request->name_user,
            'email' => $request->email,
            'password_user' => Hash::make($request->password), // Hash da senha antes de salvar no banco
            'type_user' => 'ALU', // Define o tipo de usuário como 'ALU' automaticamente
            'active_user' => TRUE, // Define o usuário como ativo por padrão
        ]);

        // Opcional: Logar o usuário automaticamente após o registro
        Auth::login($usuario);
        
        // Redireciona para a rota 'stageconnect' (nome da rota em web.php)
        return redirect()->route('stageconnect')->with('success', 'Usuário cadastrado com sucesso!');
    }

}
