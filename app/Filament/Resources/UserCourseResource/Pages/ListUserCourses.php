<?php

namespace App\Filament\Resources\UserCourseResource\Pages;

use App\Filament\Resources\UserCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserCourses extends ListRecords
{
    protected static string $resource = UserCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
