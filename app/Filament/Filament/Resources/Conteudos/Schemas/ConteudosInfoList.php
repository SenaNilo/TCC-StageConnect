<?php

namespace App\Filament\Filament\Resources\Conteudos\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\ViewEntry;

class ConteudosInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        ImageEntry::make('img')
                            ->label('Imagem do Conteúdo')
                            ->disk('public')
                            ->columnSpan(2),
                    ]),

                TextEntry::make('titulo')
                    ->label('Título do Conteúdo'),

                Grid::make(2)
                    ->schema([
                        TextEntry::make('autor.name_user')
                            ->label('Autor'),
                        
                        TextEntry::make('categorias.name_category')
                            ->label('Categorias')
                            ->badge(),
                            
                        TextEntry::make('tags.name_tag')
                            ->label('Tags')
                            ->badge(),
                    ]),

                TextEntry::make('descricao')
                    ->label('Descrição Completa'),
                    
                Grid::make(2)
                    ->schema([
                        TextEntry::make('dt_created')
                            ->label('Criado em')
                            ->dateTime(),
                        TextEntry::make('dt_updated')
                            ->label('Última Atualização')
                            ->dateTime(),
                    ]),
            ]);
    }
}