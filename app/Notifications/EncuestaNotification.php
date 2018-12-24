<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class EncuestaNotification extends Notification
{
    use Queueable;
    public $porcentaje;
    public $encuestados; 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $encuestados = 0, $porcentaje = 0)
    {
        
        $this->encuestados = $encuestados;
        $this->porcentaje = $porcentaje;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->subject('Notificación de encuestas')
                    ->greeting('Hola Administrador')
                    ->subject(Lang::getFromJson('Notificación de encuestas'))
                    ->line('De los 1000 alumnos se han encuestado a '.$this->encuestados.'')
                    ->line('Lo cual equivale a un ' .$this->porcentaje .' de los alumnos')
                    ->line('Puede entrar a la pagina web para ver las estadisticas de este año')
                    ->action('Ver estadisticas', url('/graficos-encuesta'))
                    ->salutation('¡Saludos!');
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
            ['encuestados' => $this->encuestados, 'porcentaje' => $this->porcentaje]
        ];
    }
}
