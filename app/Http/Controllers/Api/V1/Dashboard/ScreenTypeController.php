<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScreenType\StoreRequest;
use App\Http\Requests\ScreenType\UpdateRequest;
use App\Http\Resources\Api\ScreenTypeResource;
use App\Models\ScreenType;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ScreenTypeController extends Controller
{
    /**
     * Display a listing of the screenTypes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $screen_types = QueryBuilder::for(ScreenType::class)

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

        $screen_types = ScreenTypeResource::collection($screen_types);

        return response()->json($screen_types);
    }

    /**
     * Store a newly created screenType in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
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
     * Display the specified screenType.
     *
     * @param HallType $hallType
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ScreenType $screen_type)
    {
        $screen_type = new ScreenTypeResource($screen_type);

        return response()->json($screen_type);
    }

    /**
     * Update the specified screenType in storage.
     *
     * @param UpdateRequest $request
     * @param HallType      $screentype
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
     * Remove the specified screenType from storage.
     *
     * @param HallType $hallType
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
