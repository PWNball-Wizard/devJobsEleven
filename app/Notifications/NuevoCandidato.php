<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoCandidato extends Notification
{
    use Queueable;

    public $id_vacante;
    public $nombre_vacante;
    public $usuario_id;
    /**
     * Create a new notification instance.
     */
    //! Aqui podemos definir los parametros que se van a recibir en la notificacion 
    public function __construct($id_vacante, $nombre_vacante, $usuario_id)
    {
        $this->id_vacante = $id_vacante;
        $this->nombre_vacante = $nombre_vacante;
        $this->usuario_id = $usuario_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //! Aqui se puede definir por que medio se va a enviar la notificacion (mail, database, broadcast, nexmo, slack, etc)
        //! para broadcast se necesita configurar el archivo config/broadcasting.php y el archivo .env
        //! una herramienta para broadcast es pusher (https://pusher.com/)
        //! la notificacion por database se guarda en la tabla notifications de la base de datos
        //! Se puede mostrar la notificacion en la aplicacion web con el componente de blade <x-alert>
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/notificaciones');
        //! Este metodo le enviara un correo electronico al usuario que creo la vacante
        return (new MailMessage)
            ->line('Haz recibido un nuevo candidato para la vacante: ' . $this->nombre_vacante)
            ->action('Notification Action', $url)
            ->line('Gracias por usar nuestra aplicacion!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            //! esta funciion se usa para guardar la notificacion en la base de datos en la tabla notifications
            'id_vacante' => $this->id_vacante,
            'nombre_vacante' => $this->nombre_vacante,
            'usuario_id' => $this->usuario_id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    /* public function toArray(object $notifiable): array
    {
        return [
            //! toArray se usa para almacenar informacion adicional en la base de datos cuando se envia la notificacion
        ];
    } */
}
