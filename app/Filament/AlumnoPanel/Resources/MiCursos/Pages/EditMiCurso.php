<?php

namespace App\Filament\AlumnoPanel\Resources\MiCursos\Pages;

use App\Filament\AlumnoPanel\Resources\MiCursos\MiCursoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMiCurso extends EditRecord
{
    protected static string $resource = MiCursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
