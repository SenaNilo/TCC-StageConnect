<?php

namespace App\Filament\Filament\Resources\Usuarios\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\FileUpload;

class UsuarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_user')
                    ->label('Nome')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('password_user')
                    ->label('Senha')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state)),

                // Campo para a foto de perfil
                FileUpload::make('foto_perfil')
                    ->label('Foto de Perfil')
                    ->image() // apenas imagens
                    ->avatar() // avatar circular - fdilament
                    ->disk('public') // O disco onde o arquivo será salvo
                    ->directory('fotos_perfil') // O diretório dentro do disco 'public'
                    ->nullable(), // Permite que o campo seja nulo
                
                Select::make('type_user')
                    ->label('Tipo de Usuario')
                    ->options(['ADM' => 'Admin', 'ALU' => 'Aluno'])
                    ->required(),
                Toggle::make('active_user')
                    ->label('Usuario ativo')
                    ->default(true)
                    ->required(),
            ]);
    }
}
