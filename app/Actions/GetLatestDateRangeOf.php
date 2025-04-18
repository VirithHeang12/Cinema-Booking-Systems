<?php

namespace App\Actions;

use App\Enums\ShowStatus;
use App\Models\Show;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetLatestDateRangeOf
{
    use AsAction;

    /**
     * Handle the action.
     *
     * @param int $days
     *
     * @return Collection
     */
    public function handle(int $days = 4): Collection
    {
        $days = Show::select(
            DB::raw('DATE(show_time) as date'),
        )
        ->groupBy(DB::raw('DATE(show_time)'))
        ->orderBy('date', 'asc')
        ->where('status', ShowStatus::SCHEDULED)
        ->limit($days)
        ->get();

        return $days;
    }
}
