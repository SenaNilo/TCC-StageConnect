<?php

namespace App\Filament\Filament\Resources\Usuarios\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UsuarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_user')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password_user')
                    ->password()
                    ->dehydrated(fn(string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->required(),
                Select::make('type_user')
                    ->options(['ADM' => 'A d m', 'ALU' => 'A l u'])
                    ->required(),
                Toggle::make('active_user')
                    ->required(),
            ]);
    }
}
