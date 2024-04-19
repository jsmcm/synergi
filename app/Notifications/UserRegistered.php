<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        // Could also create blade views for html and text
        // and use those here, eg:
        // return (new MailMessage)->view(
        //     ['mail.user.registered', 'mail.user.registered-text']
        // );

        return (new MailMessage)
                    ->line('Hi '.$notifiable->first_name.',')
                    ->line('You\'ve been registered on '.env('APP_NAME').'. Get ready for amazing things!')
	            ->line('To get your password please [Reset your password](' . config('app.url') . '/forgot-password)');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
