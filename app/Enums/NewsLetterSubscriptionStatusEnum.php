<?php

declare(strict_types=1);

namespace App\Enums;

enum NewsLetterSubscriptionStatusEnum: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case PROCESSED = 'processed';
    case FAILED = 'failed';
}
