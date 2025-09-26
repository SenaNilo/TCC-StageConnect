<?php

namespace App\Filament\Filament\Resources\Categorias\Pages;

use App\Filament\Filament\Resources\Categorias\CategoriaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategorias extends ListRecords
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
