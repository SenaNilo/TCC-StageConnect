<?php

namespace App\Filament\Filament\Resources\Conteudos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;

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
                TextColumn::make('autor_id')
                    ->label('Autor ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('titulo')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('descricao')
                    ->sortable()
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
