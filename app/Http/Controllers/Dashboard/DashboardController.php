<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\ShowSeat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $moviesByYear = $this->moviesByYear();
        $ticketSalesByGenre = $this->ticketSalesByGenre();

        return Inertia::render('Dashboard/Index', [
            'moviesByYear'      => $moviesByYear
        ]);
    }

    /**
     * Generate movies by year data for chart
     *
     * @return array
     */
    public function moviesByYear(): array
    {
        $currentYear = date('Y');
        $lastFiveYears = range($currentYear - 5, $currentYear);
        $moviesByYear = [];
        foreach ($lastFiveYears as $year) {
            $moviesByYear[] = [
                'year'      => $year,
                'count'     => Movie::whereYear('release_date', $year)->count()
            ];
        }

        return $moviesByYear;
    }

    /**
     * Generate ticket sales by genre
     *
     * @return array
     */
    public function ticketSalesByGenre(): array
    {
        $genres = Genre::withCount('movieGenres')
            ->orderBy('movie_genres_count', 'desc')
            ->take(5)
            ->get();

        $genreWithMovies = Genre::withCount('movieGenres')
            ->orderBy('movie_genres_count', 'desc')
            ->get();

        $countGenreWithMovies = count(collect($genreWithMovies)->filter(function ($genre) {
            return $genre->movie_genres_count > 0;
        }));

        $ticketSalesByGenre = [];

        $showSeatCount = ShowSeat::count();

        foreach ($genres as $genre) {
            $ticketSalesByGenre[] = [
                'genre'     => $genre->name,
                'sales'     => (ShowSeat::whereHas('show', function ($query) use ($genre) {
                    $query->whereHas('movieSubtitle', function ($query) use ($genre) {
                        $query->whereHas('movie', function ($query) use ($genre) {
                            $query->whereHas('movieGenres', function ($query) use ($genre) {
                                $query->where('genre_id', $genre->id);
                            });
                        });
                    });
                })->count() / ($countGenreWithMovies * $showSeatCount)) * 100
            ];
        }

        dd($ticketSalesByGenre);

        return $ticketSalesByGenre;
    }
}
