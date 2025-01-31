<?php

declare(strict_types=1);

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;

final class SubscriptionSuccessfulController extends Controller
{
    public function __invoke(string $token)
    {
        abort_unless(session()->has('message'), 404);

        return view('success');
    }
}
