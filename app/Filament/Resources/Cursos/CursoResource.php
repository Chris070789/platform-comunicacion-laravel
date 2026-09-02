<?php

namespace App\Filament\Resources\Cursos;

use App\Filament\Resources\Cursos\Pages\CreateCurso;
use App\Filament\Resources\Cursos\Pages\EditCurso;
use App\Filament\Resources\Cursos\Pages\ListCursos;
use App\Filament\Resources\Cursos\Schemas\CursoForm;
use App\Filament\Resources\Cursos\Tables\CursosTable;
use App\Models\Curso;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\CheckboxList;

class CursoResource extends Resource
{
    protected static ?string $model = Curso::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Curso';

    public static function form(Schema $schema): Schema
    {
        return CursoForm::configure($schema);
        CheckboxList::make('alumnos')
            ->relationship('alumnos', 'name')   // segundo parámetro = columna a mostrar
            ->columns(2)
            ->required();
    }

    public static function table(Table $table): Table
    {
        return CursosTable::configure($table);
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
            'index' => ListCursos::route('/'),
            'create' => CreateCurso::route('/create'),
            'edit' => EditCurso::route('/{record}/edit'),
        ];
    }
}
