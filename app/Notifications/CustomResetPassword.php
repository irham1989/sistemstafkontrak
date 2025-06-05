<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class CustomResetPassword extends Notification
{
    use Queueable;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
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
            ->subject('Tetapkan semula pemberitahuan kata laluan')
            ->greeting('Assalamualaikum')
            ->line('Anda meminta tetapan semula kata laluan. Klik butang di bawah untuk menetapkan semula kata laluan anda.')
            ->action('Tetapkan Semula Kata Laluan', $this->resetUrl($notifiable))
            ->line('Jika anda tidak meminta ini, abaikan sahaja e-mel ini.');
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

    protected function resetUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'password.reset',
            Carbon::now()->addMinutes(config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')),
            ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]
        );
    }
}
