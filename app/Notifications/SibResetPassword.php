<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SibResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)            
            ->subject('تغییر کلمه عبور')
            ->line('شما درخواست تغییر کلمه عبور داده بودید. برای تغییر کلمه عبور خود بر روی دکمه زیر کلیک کنید.')
            ->action('تغییر کلمه عبور', url('password/reset', $this->token))
            ->line('اگر شما درخواست تغییر کلمه عبور نداده اید، لازم نیست کاری انجام دهید.');            
    }
}
