<?php

namespace App\Filament\Filament\Resources\Conteudos\Pages;

use App\Filament\Filament\Resources\Conteudos\ConteudoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConteudos extends ListRecords
{
    protected static string $resource = ConteudoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
