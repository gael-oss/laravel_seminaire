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
    // Ajoutez ces méthodes
public function valider(Seminaire $seminaire)
{
    $seminaire->update([
        'statut' => 'validé',
        'date_presentation' => now()->addDays(14) // Publier 14 jours après validation
    ]);

    // Notification au présentateur
    $seminaire->presentateur->user->notify(new SeminaireValideNotification($seminaire));

    return redirect()->route('seminaires.index-secretaire')
        ->with('success', 'Séminaire validé et programmé !');
}

public function rejeter(Request $request, Seminaire $seminaire)
{
    $request->validate(['raison' => 'required|string']);

    $seminaire->update([
        'statut' => 'rejeté',
        'raison_rejet' => $request->raison
    ]);

    // Notification avec motif
    $seminaire->presentateur->user->notify(new SeminaireRejeteNotification(
        $seminaire->titre, 
        $request->raison
    ));

    return back()->with('success', 'Demande rejetée avec succès.');
   }
}
