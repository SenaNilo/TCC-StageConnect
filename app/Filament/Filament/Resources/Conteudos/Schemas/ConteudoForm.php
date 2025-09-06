<?php

namespace App\Filament\Filament\Resources\Conteudos\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class ConteudoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //components do form
                TextInput::make('titulo')
                    ->required()
                    ->maxLength(255),
                Textarea::make('descricao')
                    ->required()
                    ->columnSpanFull(),   
                Toggle::make('active_content')
                    ->required()
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger'),
            ]);
    }
}
