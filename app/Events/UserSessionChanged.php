<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserSessionChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $mensaje;
    public $tipo_mensaje;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mensaje, $tipo_mensaje)
    {
        $this->mensaje = $mensaje;
        $this->tipo_mensaje = $tipo_mensaje;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        \Log::debug("{$this->mensaje}");
//        \Log::debug("{$this->tipo_mensaje}");
        return new PrivateChannel('notificaciones');
    }
}
