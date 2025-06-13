<?php

namespace App\Http\Controllers\Concerns;

use App\Facades\Filter;
use Illuminate\Database\Eloquent\Builder;

trait FiltersItems
{
    protected function filter(array $filterValues, array $filters, Builder $query, array $hiddenFields = []): array
    {
        $total = $query->count();

        $items = Filter::usesQuery($query)
            ->usesFilters($filters)
            ->filtersUsing($filterValues)
            ->get()->makeHidden($hiddenFields);

        return [
            'items' => $items,
            'total' => $total,
            'per_page' => $filterValues['limit'] ?? 15,
            'current_page' => $filterValues['page'] ?? 1,
            'shown' => $items->count(),
        ];
    }
}
