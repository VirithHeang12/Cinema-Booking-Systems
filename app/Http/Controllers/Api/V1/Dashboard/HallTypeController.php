<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallTypes\StoreRequest;
use App\Http\Requests\HallTypes\UpdateRequest;
use App\Http\Resources\Api\HallTypeResource;
use App\Models\HallType;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class HallTypeController extends Controller
{
    /**
     * Display a listing of the hallTypes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $hall_types = QueryBuilder::for(HallType::class)

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

        $hall_types = HallTypeResource::collection($hall_types);

        return response()->json($hall_types);
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
            $hall_type = HallType::create($request->validated());

            DB::commit();

            return response()->json($hall_type, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified hallType.
     *
     * @param HallType $hallType
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(HallType $hall_type)
    {
        $hall_type = new HallTypeResource($hall_type);

        return response()->json($hall_type);
    }

    /**
     * Update the specified hallType in storage.
     *
     * @param UpdateRequest $request
     * @param HallType      $halltype
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, HallType $hall_type)
    {
        DB::beginTransaction();

        try {
            $hall_type->update($request->validated());

            DB::commit();

            return response()->json($hall_type);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified hallType from storage.
     *
     * @param HallType $hallType
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(HallType $hall_type)
    {
        DB::beginTransaction();

        try {
            $hall_type->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
