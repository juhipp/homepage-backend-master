<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends Filter
{
    public function handle(Builder $query, array $filterValues): void
    {
        $orderBy = $filterValues['orderBy'] ?? 'created_at';
        $order = $filterValues['order'] ?? 'desc';

        $query->orderBy($orderBy, $order);
    }
}
