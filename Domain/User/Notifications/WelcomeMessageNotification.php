<?php

namespace Domain\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Infrastructure\Shared\Mail\GeneralMail;

class WelcomeMessageNotification extends Notification
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
    public function toMail(object $notifiable): Mailable
    {
        $mail = new GeneralMail(
            __('messages.WelcomeTitle', ['title' => app('configs')['SiteTitle']]),
            __('messages.WelcomeBody'),
            __('messages.WelcomeSubtitle', ['name' => $notifiable->firstname]),
            ['title' => __('messages.StartJourney'), 'link' => app('configs')['AppURL']]
        );
        return $mail->to($notifiable->email)->subject(__('messages.WelcomeTitle', ['title' => app('configs')['SiteTitle']]));
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
