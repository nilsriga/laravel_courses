<?php

namespace App\Filament\Resources\UserCourseResource\Pages;

use App\Filament\Resources\UserCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserCourse extends EditRecord
{
    protected static string $resource = UserCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
