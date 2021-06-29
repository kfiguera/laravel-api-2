<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ModelUnRatedNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private $qualifierName;
    /**
     * @var string
     */
    private $productName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $qualifierName, string $productName)
    {
        //
        $this->qualifierName = $qualifierName;
        $this->productName = $productName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("{$this->qualifierName} ha quitado la valoración al producto {$this->productName}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
