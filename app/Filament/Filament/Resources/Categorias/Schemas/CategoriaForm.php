<?php

namespace App\Filament\Filament\Resources\Categorias\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_category')
                ->label('Nome da Categoria')
                ->required()
                ->maxLength(25)
                ->default(null),
            ]);
    }
}
