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
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    // public function index(){
    //     return view('index');
    // }

    public function login()
    {
        return view('auth.login');
    }

    public function cadastro()
    {
        return view('auth.cadastro');
    }

    public function stageconnect()
    {
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

    // Cria um método privado para a lógica de filtro principal, para não repetir código
    private function getFilteredContent(Request $request, string $categoryName = null)
    {
        
        $query = Conteudo::query()
            ->where('active_content', true)
            ->with('autor', 'tags');

        // Filtra pela Categoria Principal (se o método for específico)
        if ($categoryName) {
            $categoria = Categoria::where('name_category', $categoryName)->firstOrFail();
            $query->whereHas('categorias', function ($q) use ($categoria) {
                $q->where('id_categoria', $categoria->id);
            });
        }

        $allTagsQuery = Tag::orderBy('name_tag');
    
        if ($categoryName) {
            // Se a página for específica (Orientação, Requisitos, Técnico),
            // filtra as tags que têm conteúdos nessa categoria.
            $allTagsQuery->whereHas('conteudos', function ($q) use ($categoria) {
                $q->whereHas('categorias', function ($qCat) use ($categoria) {
                    $qCat->where('id_categoria', $categoria->id);
                });
            });
        }

        $allTags = $allTagsQuery->get();
        
        $selectedTags = $request->input('tag', []);
        
        if (!empty($selectedTags)) {
            // Filtra o conteúdo que possui PELO MENOS uma das tags selecionadas
            $query->whereHas('tags', function ($q) use ($selectedTags) {
                $q->whereIn('tags.id', $selectedTags);
            });
        }
        // ------------------------------------

        // 3. LÓGICA DE BUSCA POR TEXTO (Filtro 'search')
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            
            $query->where(function ($q) use ($searchTerm) {
                $q->where('titulo', 'LIKE', "%{$searchTerm}%")
                ->orWhere('descricao', 'LIKE', "%{$searchTerm}%")
                ->orWhereHas('autor', function ($qAutor) use ($searchTerm) {
                    $qAutor->where('name_user', 'LIKE', "%{$searchTerm}%");
                });
            });
        }

        // 4. LÓGICA DE ORDENAÇÃO (Toggle 'order')
        $orderDirection = $request->input('order', 'desc');
        $orderDirection = in_array($orderDirection, ['asc', 'desc']) ? $orderDirection : 'desc';
        $query->orderBy('dt_created', $orderDirection);

        // 5. EXECUTA A CONSULTA
        $conteudos = $query->get();

        return [
            'conteudos' => $conteudos,
            'orderDirection' => $orderDirection,
            'search' => $request->input('search'),
            'allTags' => $allTags,
            'selectedTags' => $selectedTags,
            'titulo' => $categoryName ?: "Todos os Conteúdos",
        ];
    }


    // 1. Orientação Profissional/Material de Apoio
    public function orientacaoProfissional(Request $request)
    {
        $data = $this->getFilteredContent($request, 'Orientação Profissional/Material de Apoio');
        $data['origem'] = 'orientacao';
        return view('pages.aluno.conteudos', $data);
    }

    // 2. Áreas de Atuação e Requisitos Técnicos
    public function requisitosTecnicos(Request $request) 
    {
        $data = $this->getFilteredContent($request, 'Áreas de Atuação e Requisitos Técnicos');
        $data['origem'] = 'requisitos';
        return view('pages.aluno.conteudos', $data);
    }

    // 3. Conteúdo Técnico Específico
    public function conteudoTecnico(Request $request) 
    {
        $data = $this->getFilteredContent($request, 'Conteúdo Técnico Específico');
        $data['origem'] = 'tecnico';
        return view('pages.aluno.conteudos', $data);
    }

    // 4. Todos os Conteúdos (Se você tiver uma rota que lista tudo)
    public function mostrarConteudos(Request $request)
    {
        $data = $this->getFilteredContent($request, null);
        $data['origem'] = 'todos';
        return view('pages.aluno.conteudos', $data);
    }
    
    public function mostrarDetalheConteudo($id)
    {
        // Busca o conteúdo pelo ID, garantindo que esteja ativo e carregando os relacionamentos
        $conteudo = Conteudo::with('autor', 'tags')
            ->where('active_content', true)
            ->findOrFail($id);

        return view('pages.aluno.conteudo-detalhe', compact('conteudo'));
    }

    public function adminIndex()
    {
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
        // 1. Validação dos dados (SEM a regra 'unique' para evitar o erro de conexão)
        $validator = Validator::make($request->all(), [
            'name_user' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:200'], // REMOVIDA: 'unique:usuarios,email'
            'password' => ['required', 'string', 'min:6', 'confirmed'], 
        ], [
            // Mensagens de erro para ir para formualrio
            'name_user.required' => 'O campo Nome é obrigatório.',
            'name_user.max' => 'O Nome não pode ter mais de 25 caracteres.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.max' => 'O Email não pode ter mais de 200 caracteres.',
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
        // 2. CHECAGEM MANUAL DE UNICIDADE (RESOLVE O ERRO DE CONEXÃO)
        // ----------------------------------------------------
        $emailExists = Usuario::where('email', $request->email)->exists();
        
        if ($emailExists) {
            // Se o email já existe, retorna o erro personalizado
            return redirect()->back()
                ->withErrors(['email' => 'Este email já está cadastrado.'])
                ->withInput();
        }
        // ----------------------------------------------------


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
        // Não precisamos do DB::reconnect() aqui, o Middleware garante isso.
        
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
                return redirect()->route('stageconnect')->with('success', 'Bem-vindo, Aluno!');
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

    public function mostrarFormEsqueciSenha()
    {
        return view('auth.esqueci-senha');
    }

    public function enviarLinkReset(Request $request)
    {
        // Validação do email (REMOVIDO: 'exists:usuarios,email')
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
        ]);
        
        // ----------------------------------------------------
        // CHECAGEM MANUAL DE EXISTÊNCIA (RESOLVE O ERRO DE CONEXÃO)
        // ----------------------------------------------------
        $userExists = Usuario::where('email', $request->email)->exists();
        
        if (!$userExists) {
            // Se o email não existe, retorna o erro personalizado
             return back()->withErrors(['email' => 'Não encontramos um usuário com esse email.']);
        }
        // ----------------------------------------------------


        // Aqui você implementaria a lógica para enviar o email de reset de senha.
        // Por enquanto, vamos apenas redirecionar de volta com uma mensagem de sucesso.

        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link de redefinição enviado para seu e-mail!');
        } else {
            // Se falhou (ex: erro no servidor de e-mail), volta com erro
            return back()->withErrors(['email' => 'Não foi possível enviar o link de redefinição.']);
        }
    }

    public function mostrarFormRedefinir(Request $request, $token = null)
    {
        // Nós vamos criar esta view no próximo passo
        // O $token vem da URL (ex: /redefinir-senha/token12345)
        return view('auth.redefinir-senha')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function redefinirSenha(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8', // 'confirmed' = checa se 'password' e 'password_confirmation' são iguais
        ]);

        // A "mágica" do Laravel para redefinir a senha
        $status = Password::reset($request->only(
            'email', 'password', 'password_confirmation', 'token'
        ), function ($user, $password) {
            $user->forceFill([
                'password_user' => Hash::make($password)
            ])->save();
        });

        if ($status == Password::PASSWORD_RESET) {
            // Se funcionou, manda o usuário para o Login com uma mensagem de sucesso
            return redirect()->route('login')->with('status', 'Sua senha foi redefinida com sucesso!');
        } else {
            // Se o token for inválido ou expirado
            return back()->withErrors(['email' => 'Este link de redefinição é inválido ou expirou.']);
        }
    }
}