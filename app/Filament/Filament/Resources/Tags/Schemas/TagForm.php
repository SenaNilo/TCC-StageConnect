<?php

namespace App\Filament\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_tag')
                    ->label('Nome da Tag')
                    ->required()
                    ->maxLength(25),
            ]);
    }
}
