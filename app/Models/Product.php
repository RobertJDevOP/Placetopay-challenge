<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'list_price', 'price', 'category_id', 'url_product_img',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'url_product_img',
    ];

    protected $dates = [
        'enabled_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

}
