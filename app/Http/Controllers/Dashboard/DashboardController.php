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
        $percentagesPerGenre = $this->ticketSalesByGenre();

        return Inertia::render('Dashboard/Index', [
            'moviesByYear'              => $moviesByYear,
            'percentagesPerGenre'       => $percentagesPerGenre
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

        $showSeatCount = ShowSeat::count();

        $numberOfTicketsByMovie = [];

        $movies = Movie::whereHas('movieGenres')->get();

        foreach ($movies as $movie) {
            $numberOfTicketsByMovie[] = [
                'movie'     => $movie->title,
                'sales'     => ShowSeat::whereHas('show', function ($query) use ($movie) {
                    $query->whereHas('movieSubtitle', function ($query) use ($movie) {
                        $query->where('movie_id', $movie->id);
                    });
                })->count(),
                'genres'    => $movie->movieGenres()->pluck('genre_id')->toArray(),
            ];
        }

        $totalTicketsByGenre = [];
        foreach ($genres as $genre) {
            $genreMovies = collect($numberOfTicketsByMovie)->filter(function ($movie) use ($genre) {
                return in_array($genre->id, $movie['genres']);
            });

            $adjustedSales = 0;
            foreach ($genreMovies as $genreMovie) {
                $adjustedSales += $genreMovie['sales'] / count($genreMovie['genres']);
            }

            $totalTicketsByGenre[] = [
                'genre'     => $genre->name,
                'sales'     => $adjustedSales
            ];
        }

        $percentagesPerGenre = [];

        foreach ($totalTicketsByGenre as $genre) {
            $percentagesPerGenre[] = [
                'genre'             => $genre['genre'],
                'percentage'        => ($genre['sales'] / $showSeatCount) * 100
            ];
        }

        return $percentagesPerGenre;
    }
}
