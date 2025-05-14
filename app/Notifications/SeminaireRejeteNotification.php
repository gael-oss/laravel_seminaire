public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Votre demande de séminaire a été rejetée')
        ->line('Malheureusement, votre proposition "' . $this->titre . '" n\'a pas été retenue.')
        ->line('Motif : ' . $this->reason ?? 'Non spécifié');
}
