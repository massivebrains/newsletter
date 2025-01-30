<?php

namespace App\Http\Controllers\Subscription;

use App\Enums\EmailListStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\EmailList;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('subscribe', ['emailList' => EmailList::whereStatus(EmailListStatusEnum::ACTIVE)->get()]);
    }
}
