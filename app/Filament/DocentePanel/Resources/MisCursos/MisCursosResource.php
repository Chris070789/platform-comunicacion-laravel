<?php

namespace App\Filament\DocentePanel\Resources\MisCursos;

use App\Filament\DocentePanel\Resources\MisCursos\Pages\CreateMisCursos;
use App\Filament\DocentePanel\Resources\MisCursos\Pages\EditMisCursos;
use App\Filament\DocentePanel\Resources\MisCursos\Pages\ListMisCursos;
use App\Filament\DocentePanel\Resources\MisCursos\Schemas\MisCursosForm;
use App\Filament\DocentePanel\Resources\MisCursos\Tables\MisCursosTable;
use App\Models\MisCursos;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MisCursosResource extends Resource
{
   protected static ?string $model = \App\Models\Curso::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Curso';

    public static function form(Schema $schema): Schema
    {
        return MisCursosForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MisCursosTable::configure($table);
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
            'index' => ListMisCursos::route('/'),
            'create' => CreateMisCursos::route('/create'),
            'edit' => EditMisCursos::route('/{record}/edit'),
        ];
    }
}
