<?php

namespace App\Filament\Filament\Resources\Conteudos\Pages;

use App\Filament\Filament\Resources\Conteudos\ConteudoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConteudo extends EditRecord
{
    protected static string $resource = ConteudoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
