<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genres\StoreRequest;
use App\Http\Requests\Genres\UpdateRequest;
use App\Http\Resources\Api\GenreResource;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class GenreController extends Controller
{
    /**
     * Display a listing of the genres.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $genres = QueryBuilder::for(Genre::class)
            ->allowedFilters([
                'name',
                'description'
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name',
                'description'
            ])
            ->get();

        $genres = GenreResource::collection($genres);

        return response()->json($genres);
    }

    /**
     * Store a newly created genre in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        // dd($request->validated());
        try {
            $genre = Genre::create($request->validated());

            DB::commit();

            return response()->json($genre, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified genre.
     *
     * @param Genre $genre
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Genre $genre)
    {
        $genre = new GenreResource($genre);

        return response()->json($genre);
    }

    /**
     * Update the specified genre in storage.
     *
     * @param UpdateRequest $request
     * @param Genre      $genre
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Genre $genre)
    {
        DB::beginTransaction();

        try {
            $genre->update($request->validated());

            DB::commit();

            return response()->json($genre);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param Genre $genre
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Genre $genre)
    {
        DB::beginTransaction();

        try {
            $genre->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
