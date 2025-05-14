<?php

namespace App\Notifications;

use App\Models\Seminaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProgrammePublieNotification extends Notification implements ShouldQueue
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
            ->subject('Nouveau séminaire disponible')
            ->greeting('Bonjour ' . $notifiable->name . ' !')
            ->line('Un nouveau séminaire a été programmé :')
            ->line('**Titre** : ' . $this->seminaire->titre)
            ->line('**Date** : ' . $this->seminaire->date_presentation->format('d/m/Y H:i'))
            ->action('Voir le calendrier', url('/calendrier'))
            ->line('Merci de votre attention !');
    }
}
