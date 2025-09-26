<?php

namespace App\Filament\Filament\Resources\Categorias\Pages;

use App\Filament\Filament\Resources\Categorias\CategoriaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
