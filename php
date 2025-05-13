<?php

namespace App\Notifications;

use App\Models\Seminaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SeminaireValideNotification extends Notification
{
    use Queueable;

    public $seminaire;

    public function __construct(Seminaire $seminaire)
    {
        $this->seminaire = $seminaire;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre séminaire a été validé !')
            ->line('Bonjour ' . $notifiable->name . ',')
            ->line('Votre séminaire "' . $this->seminaire->titre . '" a été validé.')
            ->line('Date de présentation : ' . $this->seminaire->date_presentation)
            ->action('Voir le séminaire', url('/seminaires/' . $this->seminaire->id));
    }
}
