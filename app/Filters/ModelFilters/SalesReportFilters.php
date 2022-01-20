<?php

namespace App\Filters\ModelFilters;

use App\Constants\Status;
use App\Filters\Conditions\DateRangeSalesReport;
use App\Filters\Filter;
use App\Models\PurchaseOrder;

class SalesReportFilters extends Filter
{
    protected string $model = PurchaseOrder::class;
    protected array $applicableConditions = [
        'dates' => DateRangeSalesReport::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(['purchase_order.id','purchase_order.created_at','purchase_order.updated_at','total','qty','purchase_payment_status.status'])
                        ->whereIn('purchase_payment_status.status', [Status::APPROVED]);
        return $this;
    }

    protected function joins(): Filter
    {
        $this->query->join('purchase_payment_status', 'purchase_payment_status.id_purchase_order', '=', 'purchase_order.id');

        return $this;
    }
}
