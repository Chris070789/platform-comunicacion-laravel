<?php

namespace App\Filament\AlumnoPanel\Resources\MiCursos\Pages;

use App\Filament\AlumnoPanel\Resources\MiCursos\MiCursoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMiCursos extends ListRecords
{
    protected static string $resource = MiCursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
