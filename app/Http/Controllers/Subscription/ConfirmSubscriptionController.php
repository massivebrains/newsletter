<?php

declare(strict_types=1);

namespace App\Http\Controllers\Subscription;

use App\Actions\ConfirmSubscriptionAction;
use App\Http\Controllers\Controller;
use Throwable;

final class ConfirmSubscriptionController extends Controller
{
    public function __invoke(string $token)
    {
        try {
            (new ConfirmSubscriptionAction($token))->handle();

            return redirect("/success/{$token}")->with('message', 'Your subscription has been confirmed!');
        } catch (Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }
    }
}
