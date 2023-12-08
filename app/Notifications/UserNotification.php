<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Conge;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification
{
    use Queueable;
    protected $conge;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Conge $conge)
    {
        $this->conge = $conge;
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
                    ->greeting('Bonjour,Admin!')
                    ->subject('Un nouveau congé '.$this->conge)
                    ->line('Le congé est demandé par'.$this->conge->employe->nom)
                    ->line('Date de Debut'.$this->conge->dateDebut)
                    ->line('Date de Fin'.$this->conge->dateFin)
                    ->action('Vue', route('conges.show',['id' => $this->conge->id]))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'nombreCongeDemande' => $this->conge->nomrbeCongeDemande,
            'nomEmploye' => $this->conge->employe->nom,
            'employe_id' => $this->conge->employe_id,            
        ];
    }
}
