# 🚀 StageConnect - Plataforma de Orientação para Carreira Tech Júnior
StageConnect é uma plataforma desenvolvida como Trabalho de Conclusão de Curso (TCC) com o objetivo de diminuir a lacuna entre o conhecimento acadêmico e as exigências do mercado de trabalho em tecnologia. A plataforma oferece conteúdo focado, roadmaps de estudo e requisitos técnicos essenciais para estudantes e desenvolvedores de nível júnior.

# ✨ Destaques do Projeto
Conteúdo Filtrável: Mais de 30 artigos classificados em três categorias principais (Orientação Profissional, Requisitos Técnicos, Conteúdo Específico).

Design Responsivo: Interface otimizada para acesso via desktop e dispositivos móveis.

Ambiente de Produção Estável: Utilização de Docker e Railway para um deploy robusto e automatizado.

Autenticação Segura: Sistema de login/cadastro com gestão de perfis (Administrador e Aluno).

# ⚙️ Stack Tecnológica
- Categoria,Tecnologia,Uso Principal
- Backend,PHP 8.3,Lógica de Negócio e Rotas.
- Framework,Laravel 12,"Estrutura MVC, Eloquent ORM."
- Frontend,"Blade Templates, CSS/JS",Interface do Usuário e Visualização de Dados.
- Assets,Vite,Compilação e bundling de CSS/JS.
- Banco de Dados,MySQL,"Armazenamento de usuários, conteúdos, tags e categorias."
- Deploy/Contêiner,Docker,Padronização e isolamento do ambiente de produção.

# 📁 Arquitetura do Banco de Dados
O banco de dados é baseado em um modelo relacional para gerenciar o conteúdo de forma escalável, utilizando relacionamentos Muitos-para-Muitos (N:N) para vincular Conteúdos a Múltiplas Tags e Categorias.

Tabelas Principais: usuarios, conteudos, tags, categorias.

Tabelas Pivô (N:N): conteudo_tag e conteudo_categoria.
