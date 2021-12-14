<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    use HasFilters;

    protected $fillable = [
        'product_name', 'list_price', 'price', 'category_id', 'url_product_img',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $appends = [
        'update_formatted','crated_formatted', 'status',
    ];

    protected $dates = [
        'enabled_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getCratedFormattedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }
    public function getUpdateFormattedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->attributes['updated_at']));
    }

    public function getStatusAttribute(): string
    {
        return (is_null($this->attributes['enabled_at'])) ? 'disabled' : 'enabled';
    }

    public function markAsEnabled(): void
    {
        $this->enabled_at = now();
        $this->save();
    }

    public function markAsDisabled(): void
    {
        $this->enabled_at = null;
        $this->save();
    }

}
