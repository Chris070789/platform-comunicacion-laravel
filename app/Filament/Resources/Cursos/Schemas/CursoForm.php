<?php

namespace App\Filament\Resources\Cursos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CursoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('docente_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
