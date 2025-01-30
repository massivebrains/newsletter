<?php

namespace App\Http\Controllers\Subscription;

use App\Actions\ConfirmSubscriptionAction;
use App\Http\Controllers\Controller;
use Throwable;

class ConfirmSubscriptionController extends Controller
{
    public function __invoke(string $token)
    {
        try {
            (new ConfirmSubscriptionAction($token))->handle();

            return redirect('/success')->with('message', 'Your subscription has been confirmed!');
        } catch (Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }
    }
}
