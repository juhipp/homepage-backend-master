<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class LimitFilter extends Filter
{
    public function assumes(): array|null
    {
        return ['limit'];
    }

    public function handle(Builder $query, array $filterValues): void
    {
        $query->limit($filterValues['limit']);
    }
}
