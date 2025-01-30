<?php

namespace App\Http\Controllers\Subscription;

use App\Actions\SubscribeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subsciption\SubscribeRequest;
use Throwable;

class SubscribeController extends Controller
{
    public function __invoke(SubscribeRequest $request)
    {
        try {
            (new SubscribeAction($request->input('email_list_id'), $request->input('email')))->handle();

            return redirect('/success')->with('message', 'An email has been sent to you to confirm your Subscription.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
