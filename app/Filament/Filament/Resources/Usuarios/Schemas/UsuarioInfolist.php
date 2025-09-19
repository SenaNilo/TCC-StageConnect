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
                TextEntry::make('name_user'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('type_user'),
                TextEntry::make('dt_created')
                    ->dateTime(),
                IconEntry::make('active_user')
                    ->boolean(),
            ]);
    }
}
