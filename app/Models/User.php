<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\SubscriptionStatusEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'type' => UserTypeEnum::class,
        ];
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function isInEmailList(EmailList $emailList)
    {
        return $this->subscriptions()->where(['email_list_id' => $emailList->id])->exists();
    }

    public function addToEmailList(EmailList $emailList)
    {
        $payload = ['user_id' => $this->id, 'email_list_id' => $emailList->id, 'status' => SubscriptionStatusEnum::PENDING];
        Subscription::updateOrCreate($payload, $payload);

        return $this->subscriptions()->where(['email_list_id' => $emailList->first, 'user_id' => $this->id])->exists();
    }
}
