<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
//! ShouldBroadcastNow es para que el evento se transmita en tiempo real
//! ShouldBroadcast es para que el evento se transmita en tiempo real pero con un retraso de 10 segundos
class RealTimeNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /* public $id_vacante;
    public $nombre_vacante;
    public $usuario_id; */
    public $datos;
    public $user;
    /**
     * Create a new event instance.
     */
    public function __construct($datos/* $id_vacante, $nombre_vacante, $usuario_id */)
    {
        //dd('Evento RealTimeNotification', $datos, $user);
        $this->datos = $datos;
        //$this->user = $user;
        /* $this->id_vacante = $id_vacante;
        $this->nombre_vacante = $nombre_vacante;
        $this->usuario_id = $usuario_id; */
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('notificaciones'),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {

        //dd($this->datos);
        return $this->datos; //,
        /* [
            'id_vacante' => $this->id_vacante,
            'nombre_vacante' => $this->nombre_vacante,
            'usuario_id' => $this->usuario_id,
            'datos' => $this->datos,
        ]; */
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'Enviadas';
    }
}
