<?php

namespace App\Jobs;

use App\Models\NewsLetter;
use App\Notifications\NewsLetterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PublishNewsLetterJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly NewsLetter $newsLetter)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Queued Notifications no no worries on the foreach. Can also batch. But i'm hungry now so later.
        foreach ($this->newsLetter->subscriptions as $subscription) {
            $subscription->user->notify(new NewsLetterNotification($this->newsLetter));
        }
    }
}
