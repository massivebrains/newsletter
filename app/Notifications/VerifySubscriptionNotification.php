<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifySubscriptionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly Subscription $subscription)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line(sprintf('Please confirm your subscription to %s', $this->subscription->name))
            ->action('Confirm', url(sprintf('/s/confirm/%s', $this->subscription->token)))
            ->line('If you did not initiate this subscription request. Please ignore this email')
            ->line('Thank you for joining our community!');
    }
}
