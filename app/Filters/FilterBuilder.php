<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FilterBuilder
{
    protected Builder $query;
    protected array $filters = [];
    protected array $values = [];

    public function usesQuery(Builder $query): static
    {
        $this->query = $query;

        return $this;
    }

    public function usesFilters(string|array $filters): static
    {
        if (!is_array($filters)) $filters = [$filters];

        $this->filters += $filters;

        return $this;
    }

    public function filtersUsing(array $values): static
    {
        $this->values += $values;

        return $this;
    }

    protected function run(): void
    {
        if (!isset($this->{'query'})) throw new \RuntimeException('Filter-query not set');

        foreach ($this->filters as $groupOrClass) {
            $filters = config('filters.groups.' . $groupOrClass) ?? [$groupOrClass];

            foreach ($filters as $filterClass) {
                /** @var Filter $instance */
                $instance = app($filterClass);

                $assumes = $instance->assumes();
                if (!$assumes || count($assumes) === 0 || count(array_intersect_key(array_flip($assumes), $this->values)) === count($assumes)) {
                    $instance->handle($this->query, $this->values);
                }
            }
        }
    }

    public function get(bool $collect = true): Collection|Builder
    {
        $this->run();

        return $collect
            ? $this->query->get()
            : $this->query->clone();
    }
}
