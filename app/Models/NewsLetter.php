<?php

namespace App\Models;

use App\Enums\SubscriptionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class NewsLetter extends Model
{
    /** @use HasFactory<\Database\Factories\NewsLetterFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function emailList(): BelongsTo
    {
        return $this->belongsTo(EmailList::class);
    }

    public function subscriptions(): HasManyThrough
    {
        return $this->hasManyThrough(Subscription::class, EmailList::class)->whereStatus(SubscriptionStatusEnum::SUBSCRIBED);
    }
}
