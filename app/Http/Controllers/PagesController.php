<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Conteudo; 
use App\Models\Categoria;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    // public function index(){
    //     return view('index');
    // }

    public function login(){
        return view('auth.login');
    }

    public function cadastro(){
        return view('auth.cadastro');
    }

    public function stageconnect(){
        $categoriaOrientacao = Categoria::where('name_category', 'Orientação Profissional/Material de Apoio')->first();
        $categoriaRequisitos = Categoria::where('name_category', 'Áreas de Atuação e Requisitos Técnicos')->first();
        $categoriaTecnico = Categoria::where('name_category', 'Conteúdo Técnico Específico')->first();

        // 1. Verifica se o usuário está logado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        // 2. Obtém o usuário logado
        $user = Auth::user();

        // 3. Verifica se o tipo de usuário é ADM ou ALU
        if ($user->type_user === 'ADM' || $user->type_user === 'ALU') {
            return view('pages.aluno.index', compact('categoriaOrientacao', 'categoriaRequisitos', 'categoriaTecnico'));
        }

        // Se o tipo de usuário não for nem ADM nem ALU, redireciona
        return redirect()->route('login')->with('error', 'Você não tem permissão para acessar esta página.');

    }

    // Orientação Profissional/Material de Apoio
    public function orientacaoProfissional()
    {
        $categoria = Categoria::where('name_category', 'Orientação Profissional/Material de Apoio')->firstOrFail();
        
        $conteudos = Conteudo::whereHas('categorias', function ($query) use ($categoria) {
            $query->where('id_categoria', $categoria->id);
        })
        ->where('active_content', true) // Filtra apenas conteúdos ativos
        ->orderBy('dt_created', 'desc') // Ordena por mais recente
        ->get();

        return view('pages.aluno.conteudos', [
            'conteudos' => $conteudos,
            'titulo' => $categoria->name_category,
            'origem' => 'orientacao',
        ]);
    }

    // Áreas de Atuação e Requisitos Técnicos
    public function requisitosTecnicos()
    {
        $categoria = Categoria::where('name_category', 'Áreas de Atuação e Requisitos Técnicos')->firstOrFail();
        
        $conteudos = Conteudo::whereHas('categorias', function ($query) use ($categoria) {
            $query->where('id_categoria', $categoria->id);
        })
        ->where('active_content', true)
        ->orderBy('dt_created', 'desc')
        ->get();

        return view('pages.aluno.conteudos', [
            'conteudos' => $conteudos,
            'titulo' => $categoria->name_category,
            'origem' => 'requisitos'
        ]);
    }

    // Conteúdo Técnico Específico
    public function conteudoTecnico()
    {
        $categoria = Categoria::where('name_category', 'Conteúdo Técnico Específico')->firstOrFail();
        
        $conteudos = Conteudo::whereHas('categorias', function ($query) use ($categoria) {
            $query->where('id_categoria', $categoria->id);
        })
        ->where('active_content', true)
        ->orderBy('dt_created', 'desc')
        ->get();

        return view('pages.aluno.conteudos', [
            'conteudos' => $conteudos,
            'titulo' => $categoria->name_category,
            'origem' => 'tecnico'
        ]);
    }

    public function mostrarConteudos()
    {
        // Busca todos os conteúdos ativos, ordenados pelos mais recentes
        $conteudos = Conteudo::with('autor', 'tags') // Carrega relacionamentos para a view
            ->where('active_content', true)
            ->orderBy('dt_created', 'desc') // Ordena pelos mais novos
            ->get();
            
        // Define um título para a página
        $titulo = "Todos os Conteúdos"; 

        // Retorna a view 'pages.aluno.conteudos' (plural) 
        // passando a lista de conteúdos e o título
        return view('pages.aluno.conteudos', [
            'conteudos' => $conteudos,
            'titulo' => $titulo,
            'origem' => 'todos',
        ]);
    }
    
    public function mostrarDetalheConteudo($id)
    {
        // Busca o conteúdo pelo ID, garantindo que esteja ativo e carregando os relacionamentos
        $conteudo = Conteudo::with('autor', 'tags')
            ->where('active_content', true)
            ->findOrFail($id);

        return view('pages.aluno.conteudo-detalhe', compact('conteudo'));
    }

    public function adminIndex(){
        // rota -> return view('pages.admin.index');

        // 1. Verifica se o usuário está logado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        // 2. Obtém o usuário logado
        $user = Auth::user();

        // 3. Verifica se o tipo de usuário é ADM
        if ($user->type_user === 'ADM') {
            return view('pages.admin.index');
        }

        // Se o tipo de usuário não for ADM, redireciona
        return redirect()->route('stageconnect')->with('error', 'Você não tem permissão para acessar esta página.');

    }

    /**
     * Cadastrar a pessoa no banco de dados
     */
    public function storeCadastro(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name_user' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:20', 'unique:usuarios,email'], // 'unique:tabela,coluna'
            'password' => ['required', 'string', 'min:6', 'confirmed'], // 'confirmed' exige um campo 'password_confirmation'
        ], [
            // Mensagens de erro para ir para formualrio
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

        // login apos o cadastro
        Auth::login($usuario);
        
        // Redireciona para a rota 'stageconnect' (nome da rota em web.php)
        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Login e start da sessao
     */
    public function authenticate(Request $request)
    {
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
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. Verifica o tipo de usuário e redireciona para a página apropriada
            if ($user->type_user === 'ADM') {
                return redirect('/filament')->with('success', 'Bem-vindo, Administrador!');
            } else if ($user->type_user === 'ALU') {
                return redirect()->route('aluno.index')->with('success', 'Bem-vindo, Aluno!');
            }
        }

        // caso der erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email'); // Mantém o email preenchido no formulário
    }

    /**
     * Logout da sessao
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Desloga o usuário

        $request->session()->invalidate(); // Invalida a sessão atual
        $request->session()->regenerateToken(); // Regenera o token CSRF

        return redirect()->route('login')->with('success', 'Você foi desconectado.'); // Redireciona para a página inicial
    }

}
