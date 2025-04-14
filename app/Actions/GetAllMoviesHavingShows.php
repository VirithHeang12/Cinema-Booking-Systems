<?php

namespace App\Actions;

use App\Enums\ShowStatus;
use App\Filters\DateFilter;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetAllMoviesHavingShows
{
    use AsAction;

    /**
     * Handle the action.
     *
     * @return \Illuminate\Support\Collection
     */
    public function handle(): \Illuminate\Support\Collection
    {
        // Fetch all movies having shows
        $movies = QueryBuilder::for(Movie::class)
            ->whereHas('movieSubtitles', function ($query) {
                $query->whereHas('shows', function ($query) {
                    $query->where('status', ShowStatus::SCHEDULED)
                        ->orWhere('status', ShowStatus::SHOWING);
                });
            })
            ->allowedFilters([
                AllowedFilter::custom('date', new DateFilter),
            ])
            ->get();

        $movies = collect($movies);

        return $movies;
    }
}
