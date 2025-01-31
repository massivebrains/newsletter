<?php

namespace App\Filament\Resources\EmailListResource\Pages;

use App\Filament\Resources\EmailListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListEmailLists extends ListRecords
{
    protected static string $resource = EmailListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
