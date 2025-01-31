<?php

declare(strict_types=1);

namespace App\Filament\Resources\EmailListResource\Pages;

use App\Filament\Resources\EmailListResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateEmailList extends CreateRecord
{
    protected static string $resource = EmailListResource::class;
}
