<?php

namespace App\Filament\Filament\Resources\Usuarios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;

class UsuariosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto_perfil')
                    ->label('Foto de perfil')
                    ->circular()
                    ->disk('public')
                    ->url(fn($record) => asset('storage/' . $record->foto_perfil)), // Corrigido,
                TextColumn::make('name_user')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('type_user')
                    ->label('Tipo de usuário')
                    ->searchable(),
                TextColumn::make('dt_created')
                    ->label('Data de criação')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('active_user')
                    ->label('Ativo')
                    ->boolean(),
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
