<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotify extends Notification
{
    use Queueable;

    public $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->greeting('Hello User')
                    ->line('Notification title : '.$this->data['title']) //Send with post title
                    ->action('Visit Our Site', 'https://shouts.dev')
                    ->line('Thank you for using our Website!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
