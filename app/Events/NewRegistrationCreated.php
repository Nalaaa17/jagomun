<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // PENTING
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewRegistrationCreated implements ShouldBroadcast // Tambahkan 'implements ShouldBroadcast'
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct()
    {
    }

    public function broadcastOn(): array
    {
        // Ini adalah nama "channel" atau "alamat" publik
        // yang akan kita kirimkan pesannya.
        return [
            new Channel('registrations'),
        ];
    }
}
