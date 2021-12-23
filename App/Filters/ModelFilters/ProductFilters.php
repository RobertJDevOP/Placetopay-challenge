<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\CategoryProduct;
use App\Filters\Conditions\NameProduct;
use App\Filters\Conditions\PriceRangeProduct;
use App\Filters\Filter;
use App\Models\Product;

class ProductFilters extends Filter
{
    protected string $model = Product::class;
    protected array $applicableConditions = [
        'product_name' => NameProduct::class,
        'category' => CategoryProduct::class,
        'range_price' => PriceRangeProduct::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(['product_name','products.updated_at','products.created_at','products.enabled_at','url_product_img','list_price','products.id','products_categories.name_category','products.category_id'])->whereNotNull('enabled_at');
        return $this;
    }

    protected function joins(): Filter
    {
        $this->query->join('products_categories', 'products.category_id', '=', 'products_categories.id');
        return $this;
    }
}
