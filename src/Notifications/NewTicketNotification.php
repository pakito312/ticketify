<?php

namespace Paki\Package\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;


class NewTicketNotification extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouveau Ticket Créé')
            ->line('Un nouveau ticket a été soumis.')
            ->action('Voir le ticket', url('/admin/tickets'))
            ->line('Merci d’utiliser notre plateforme.');
    }
}
