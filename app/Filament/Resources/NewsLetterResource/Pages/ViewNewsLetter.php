<?php

declare(strict_types=1);

namespace App\Filament\Resources\NewsLetterResource\Pages;

use App\Filament\Resources\NewsLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

final class ViewNewsLetter extends ViewRecord
{
    protected static string $resource = NewsLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
