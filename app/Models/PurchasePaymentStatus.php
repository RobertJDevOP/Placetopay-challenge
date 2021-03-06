<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchasePaymentStatus extends Model
{
    use HasFactory;

    protected $table = 'purchase_payment_status';

    protected $appends = [
        'crated_formatted'
    ];

    protected $fillable = [
        'id_purchase_order', 'status', 'requestId','processUrl'
    ];

    public function PurchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class,'id_purchase_order','id');
    }

    public function getCratedFormattedAttribute(): string
    {
        return date('d-m-Y H:i', strtotime($this->attributes['created_at']));
    }

}
