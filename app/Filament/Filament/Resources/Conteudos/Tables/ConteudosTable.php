<?php

namespace App\Filament\Filament\Resources\Conteudos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
class ConteudosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                //TextColumn::make('id')
                //    ->sortable()
                //    ->searchable(),
                TextColumn::make('autor.name_user')
                    ->label('Autor')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('img')
                    ->label('Imagem')
                    ->height(80) // Define uma altura para a miniatura
                    ->disk('public'),
                TextColumn::make('titulo')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('descricao')
                    ->sortable()
                    ->limit(50)
                    ->searchable(),

                // Nova coluna para Categorias
                TextColumn::make('categorias.name_category')
                    ->label('Categorias')
                    ->badge()
                    ->color('info')
                    ->listWithLineBreaks()
                    ->limit(50)
                    ->searchable(),

                // Nova coluna para Tags
                TextColumn::make('tags.name_tag')
                    ->label('Tags')
                    ->badge()
                    ->color('success')
                    ->listWithLineBreaks()
                    ->limit(50)
                    ->searchable(),

                BooleanColumn::make('active_content')
                    ->label('Ativo'),
                TextColumn::make('dt_created')
                    ->label('Data de Criação')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('dt_updated')
                    ->label('Data de Atualização')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
