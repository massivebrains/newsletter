<?php

declare(strict_types=1);

namespace App\Enums;

enum TemplateEnum: string
{
    case DEFAULT = 'default';

    public static function getAsOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (TemplateEnum $code) => [$code->value => ucfirst($code->name)])
            ->toArray();
    }
}
