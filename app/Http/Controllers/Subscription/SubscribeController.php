<?php

namespace App\Http\Controllers\Subscription;

use App\Actions\SubscribeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subsciption\SubscribeRequest;
use Throwable;

final class SubscribeController extends Controller
{
    public function __invoke(SubscribeRequest $request)
    {
        try {
            (new SubscribeAction($request->input('email_list_id'), $request->input('email')))->handle();

            session()->flash('message', 'Please check your email to confirm your subscription!');
            return view('success');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
