<?php

namespace App\Filament\DocentePanel\Resources\MisCursos\Pages;

use App\Filament\DocentePanel\Resources\MisCursos\MisCursosResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMisCursos extends EditRecord
{
    protected static string $resource = MisCursosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
