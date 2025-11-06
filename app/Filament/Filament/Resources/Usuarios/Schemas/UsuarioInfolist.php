<?php

namespace App\Filament\Filament\Resources\Usuarios\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\ImageEntry;

class UsuarioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('foto_perfil')
                    ->label('Foto de Perfil')
                    ->disk('public'),
                TextEntry::make('name_user')
                    ->label('Nome'),
                TextEntry::make('email')
                    ->label('Email'),
                TextEntry::make('type_user')
                    ->label('Tipo de Usuário'),
                TextEntry::make('dt_created')
                    ->label('Data de Criação')
                    ->dateTime(),
                IconEntry::make('active_user')
                    ->label('Ativo')
                    ->boolean(),
            ]);
    }
}
