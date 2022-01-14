<?php

namespace App\Filters\Conditions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class CategoryProduct extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where('category_id', '=', $criteria);
    }
}
