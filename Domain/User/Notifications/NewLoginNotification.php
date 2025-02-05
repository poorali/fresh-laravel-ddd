<?php

namespace Domain\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Infrastructure\Shared\Mail\GeneralMail;

class NewLoginNotification extends Notification
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
        $extra = json_decode($notifiable->extra, true);
        $mail = new GeneralMail(
            __('messages.NewLogin'),
            'IP: '. $extra['ip']. ' <br>'. 'Device: '. $extra['agent'],
            __('messages.NewLoginDescription'),
            ['title' => __('messages.OpenDashboard'), 'link' => app('configs')['AppURL']]
        );
        return $mail->to($notifiable->tokenable->email)->subject(__('messages.NewLogin'));
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
