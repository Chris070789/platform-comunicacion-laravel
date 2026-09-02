<?php

namespace App\Filament\AlumnoPanel\Resources\MiCursos;

use App\Filament\AlumnoPanel\Resources\MiCursos\Pages\CreateMiCurso;
use App\Filament\AlumnoPanel\Resources\MiCursos\Pages\EditMiCurso;
use App\Filament\AlumnoPanel\Resources\MiCursos\Pages\ListMiCursos;
use App\Filament\AlumnoPanel\Resources\MiCursos\Schemas\MiCursoForm;
use App\Filament\AlumnoPanel\Resources\MiCursos\Tables\MiCursosTable;
use App\Models\MiCurso;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MiCursoResource extends Resource
{
    protected static ?string $model = MiCurso::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'User';

    public static function form(Schema $schema): Schema
    {
        return MiCursoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MiCursosTable::configure($table);
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
            'index' => ListMiCursos::route('/'),
            'create' => CreateMiCurso::route('/create'),
            'edit' => EditMiCurso::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
