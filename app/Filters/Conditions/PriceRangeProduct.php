<?php

namespace App\Filters\Conditions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class PriceRangeProduct extends Condition
{

    public static function append(Builder $query, Criteria $criteria): void
    {
        $rangePrice = explode(",", $criteria);

        $query->whereBetween('list_price',[$rangePrice[0],$rangePrice[1]]);
    }
}
