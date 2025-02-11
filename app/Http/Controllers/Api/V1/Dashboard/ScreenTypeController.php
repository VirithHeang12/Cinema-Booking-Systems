<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScreenTypes\SaveRequest;
use App\Http\Requests\ScreenTypes\UpdateRequest;
use App\Http\Resources\Api\ScreenTypeResource;
use App\Models\ScreenType;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;


class ScreenTypeController extends Controller
{
    /**
     * Display a listing of the screentype.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $screenTypes = QueryBuilder::for(ScreenType::class)
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

        $screenTypes = ScreenTypeResource::collection($screenTypes);

        return response()->json($screenTypes);
    }

    /**
     * Store a newly created screen type in storage.
     *
     * @param SaveRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SaveRequest $request)
    {
        DB::beginTransaction();

        try {
            $screen_type = ScreenType::create($request->validated());

            DB::commit();

            return response()->json($screen_type, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified ScreenType.
     *
     * @param ScreenType      $screen_type
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ScreenType $screen_type)
    {
        $screenType = new ScreenTypeResource($screen_type);

        return response()->json($screen_type);
    }

    /**
     * Update the specified screen type in storage.
     *
     * @param UpdateRequest $request
     * @param ScreenType      $screen_type
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, ScreenType $screen_type)
    {
        DB::beginTransaction();

        try {
            $screen_type->update($request->validated());

            DB::commit();

            return response()->json($screen_type);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified ScreenType from storage.
     *
     * @param ScreenType      $screen_type
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ScreenType $screen_type)
    {
        DB::beginTransaction();

        try {
            $screen_type->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
