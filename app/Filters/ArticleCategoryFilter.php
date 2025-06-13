<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ArticleCategoryFilter extends Filter
{
    public function handle(Builder $query, array $filterValues): void
    {
      $names = $filterValues['categories'] ?? null;
      if(!$names || empty($names)) return;
      $names = is_array($names) ? $names : explode(',', $names);
      $query->whereRelation('categories', fn(Builder $subQuery) => $subQuery->whereIn('name', $names));
    }
}
