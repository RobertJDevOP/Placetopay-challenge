<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportProductsValidateErrors implements ShouldBroadcastNow
{
    use SerializesModels;
    use Dispatchable;
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
