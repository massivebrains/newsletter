<?php

declare(strict_types=1);

namespace App\Enums;

enum EmailListStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public static function getAsOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (EmailListStatusEnum $code) => [$code->value => ucfirst($code->name)])
            ->toArray();
    }
}
