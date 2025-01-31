<?php

declare(strict_types=1);

namespace App\Filament\Resources\NewsLetterResource\Pages;

use App\Filament\Resources\NewsLetterResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateNewsLetter extends CreateRecord
{
    protected static string $resource = NewsLetterResource::class;
}
