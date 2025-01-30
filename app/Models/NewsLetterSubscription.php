<?php

namespace App\Models;

use App\Enums\NewsLetterSubscriptionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsLetterSubscription extends Model
{
    /** @use HasFactory<\Database\Factories\NewsLetterSubscriptionFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $casts = [
        'status' => NewsLetterSubscriptionStatusEnum::class
    ];

    public function newsLetter(): BelongsTo
    {
        return $this->belongsTo(NewsLetter::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
