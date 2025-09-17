<?php

namespace App\Filament\Filament\Resources\Conteudos;

use App\Filament\Filament\Resources\Conteudos\Pages\CreateConteudo;
use App\Filament\Filament\Resources\Conteudos\Pages\EditConteudo;
use App\Filament\Filament\Resources\Conteudos\Pages\ListConteudos;
use App\Filament\Filament\Resources\Conteudos\Schemas\ConteudoForm;
use App\Filament\Filament\Resources\Conteudos\Tables\ConteudosTable;
use App\Models\Conteudo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
//use Illuminate\Support\Facades\Auth;

class ConteudoResource extends Resource
{
    protected static ?string $model = Conteudo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Conteudo';

    public static function form(Schema $schema): Schema
    {
        return ConteudoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConteudosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConteudos::route('/'),
            'create' => CreateConteudo::route('/create'),
            'edit' => EditConteudo::route('/{record}/edit'),
        ];
    }

    protected static function mutateFormDataBeforeCreate(array $data): array 
    {
        $data['autor_id'] = auth()->id();
        $data['active_content'] = true;

        return $data;
    }
}
