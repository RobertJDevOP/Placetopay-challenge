<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id', 'status', 'qty', 'total', 'requestId', 'processUrl',
    ];


}
