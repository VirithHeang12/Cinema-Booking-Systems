<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movies\StoreRequest;
use App\Http\Requests\Movies\UpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the Movies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->query('itemsPerPage', 10);

        $movies = QueryBuilder::for(Movie::class)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where('title', 'like', "%{$value}%");
                }),
            ])
            ->allowedSorts(
                'title',
                'release_date',
                'duration',
            )
            ->with(['movieGenres', 'country', 'classification', 'language', 'movieSubtitles'])
            ->paginate($perPage)
            ->appends(request()->query());


        return response()->json([
            'items' => MovieResource::collection($movies),
            'total' => $movies->total(),
        ]);
    }

    /**
     * Store a newly created hallType in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $movie = Movie::create($request->validated());

            DB::commit();

            return response()->json($movie, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified movie.
     *
     * @param Movie $movie
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function show(Movie $movie)
    {
        $movie->load(['movieGenres', 'movieSubtitles', 'movieGenres.genre', 'movieSubtitles.language']);

        $movie->movieGenres = $movie->movieGenres->map(function ($genre) {
            return [
                'id'            => $genre->genre->id,
                'name'          => $genre->genre->name,
            ];
        });

        $movie->movieSubtitles = $movie->movieSubtitles->map(function ($subtitle) {
            return [
                'id'            => $subtitle->language->id,
                'name'          => $subtitle->language->name,
            ];
        });

        return new MovieResource($movie);
    }

    /**
     * Update the specified hallType in storage.
     *
     * @param UpdateRequest $request
     * @param Movie      $movie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Movie $movie)
    {
        DB::beginTransaction();

        try {
            $movie->update($request->validated());

            DB::commit();

            return response()->json($movie);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified movie from storage.
     *
     * @param Movie $movie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Movie $movie)
    {
        DB::beginTransaction();

        try {
            $movie->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}

