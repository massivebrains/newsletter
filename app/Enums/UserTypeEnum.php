<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypeEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';

    public static function getAsOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (UserTypeEnum $code) => [$code->value => ucfirst($code->name)])
            ->toArray();
    }
}
