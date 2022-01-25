<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class NotifyImportProductFinish  implements ShouldBroadcastNow
{
    use SerializesModels;

    public string $message;

    public function __construct(string $message)
    {
        $this->message=$message;
    }

    public function broadcastOn():Channel
    {
        return new Channel('importsProduct');
    }
}
