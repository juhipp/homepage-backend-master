<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PaginateFilter extends Filter
{
    public function handle(Builder $query, array $filterValues): void
    {
        $page = $filterValues['page'] ?? 1;
        $limit = $filterValues['limit'] ?? 15;

        $query->forPage($page, $limit);
    }
}
