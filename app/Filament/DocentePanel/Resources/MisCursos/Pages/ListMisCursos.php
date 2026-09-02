<?php

namespace App\Filament\DocentePanel\Resources\MisCursos\Pages;

use App\Filament\DocentePanel\Resources\MisCursos\MisCursosResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMisCursos extends ListRecords
{
    protected static string $resource = MisCursosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
