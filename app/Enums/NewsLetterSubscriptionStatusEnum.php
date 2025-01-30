<?php

namespace App\Enums;

enum NewsLetterSubscriptionStatusEnum: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case PROCESSED = 'processed';
    case FAILED = 'failed';
}
