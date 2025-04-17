<?php

namespace App\Filters;

use App\Enums\ShowStatus;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('movieSubtitles', function ($query) use ($value) {
            $query->whereHas('shows', function ($query) use ($value) {
                $query->whereDate('show_time', $value)
                    ->where('status', ShowStatus::SCHEDULED);
            });
        });
    }
}
