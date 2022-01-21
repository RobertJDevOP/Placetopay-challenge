<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportProductsValidateErrors implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $errors;

    public function __construct(array $errors)
    {
        $this->errors=$errors;
    }

    public function broadcastOn():Channel
    {
        return new Channel('importProductValidator');
    }
}
