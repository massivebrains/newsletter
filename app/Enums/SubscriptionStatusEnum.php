<?php

namespace App\Enums;

enum SubscriptionStatusEnum: string
{
    case PENDING = 'pending';
    case SUBSCRIBED = 'subscribed';
    case UNSUBSCRIBED = 'unsubscribed';
}
