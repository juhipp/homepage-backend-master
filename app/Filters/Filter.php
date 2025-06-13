<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public function assumes(): array|null
    {
        return null;
    }

    public abstract function handle(Builder $query, array $filterValues): void;
}
