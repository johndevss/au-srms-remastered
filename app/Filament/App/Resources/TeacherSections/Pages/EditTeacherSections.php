<?php

namespace App\Filament\App\Resources\TeacherSections\Pages;

use App\Filament\App\Resources\TeacherSections\TeacherSectionsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTeacherSections extends EditRecord
{
    protected static string $resource = TeacherSectionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
