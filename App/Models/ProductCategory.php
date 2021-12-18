<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'products_categories';

    protected $fillable = ['name_category'];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
