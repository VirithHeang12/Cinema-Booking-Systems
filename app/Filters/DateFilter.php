<?php

namespace App\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('show_time', '=', $value);
    }
}
