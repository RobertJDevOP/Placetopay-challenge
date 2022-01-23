<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class ImportProductsValidateErrors implements ShouldBroadcastNow
{
    use SerializesModels;

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
