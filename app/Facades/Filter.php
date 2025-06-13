<?php

namespace App\Facades;

use App\Filters\FilterBuilder;
use Illuminate\Support\Facades\Facade;

class Filter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FilterBuilder::class;
    }
}
