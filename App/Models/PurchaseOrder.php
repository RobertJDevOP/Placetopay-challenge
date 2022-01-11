<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = [
        'update_formatted','crated_formatted'
    ];

    protected $fillable = [
        'user_id',  'qty', 'total',
    ];

    public function detailsOrder(): HasMany
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public  function  purchasePaymentsStatus(): HasMany
    {
        return $this->hasMany(PurchasePaymentStatus::class,'id_purchase_order','id');
    }

    public function getCratedFormattedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }
    public function getUpdateFormattedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->attributes['updated_at']));
    }


}
