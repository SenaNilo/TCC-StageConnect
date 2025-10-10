<?php

namespace App\Filament\Filament\Resources\Conteudos\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Validation\Rule;
use App\Models\Categoria;



class ConteudoForm
{
    
    
    public static function configure(Schema $schema): Schema
    {
        $topicos_principais_ids = Categoria::whereIn('name_category', [
            'Orientação Profissional/Material de Apoio',
            'Áreas de Atuação e Requisitos Técnicos',
            'Conteúdo Técnico Específico',
        ])->pluck('id')->toArray();

        return $schema
            ->components([
                //components do form
                TextInput::make('titulo')
                    ->required()
                    ->maxLength(255),
                Textarea::make('descricao')
                    ->required()
                    ->columnSpanFull(), 
                    
                     // Campo para Categorias (N:N)
                Select::make('categorias')
                    ->relationship('categorias', 'name_category')
                    ->multiple()
                    ->required()
                    ->preload()
                    ->searchable()
                    ->rules([
                        // Validação customizada para garantir que APENAS UM TÓPICO PRINCIPAL seja escolhido
                        function ($attribute, $value, $fail) use ($topicos_principais_ids) {
                            
                            // Verifica a interseção: quais IDs selecionados são tópicos principais
                            $intersecao = array_intersect($value, $topicos_principais_ids);
                            
                            // Se o número de itens na interseção for diferente de 1, falha a validação
                            if (count($intersecao) !== 1) {
                                $fail('O conteúdo deve ter EXATAMENTE UMA (1) categoria principal selecionada.');
                            }
                        },
                    ]),
                // Campo para Tags (N:N)
                Select::make('tags')
                    ->relationship('tags', 'name_tag')
                    ->multiple()
                    ->preload()
                    ->searchable(),

                // Campo para a imagem do conteúdo
                FileUpload::make('img')
                    ->label('Imagem do Conteúdo')
                    ->image() // Valida para aceitar apenas imagens
                    ->disk('public') // Disco de armazenamento
                    ->directory('imagens_conteudo') // Diretório para as imagens
                    ->nullable(),

                Toggle::make('active_content')
                    ->required()
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger'),
                Hidden::make('autor_id')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
