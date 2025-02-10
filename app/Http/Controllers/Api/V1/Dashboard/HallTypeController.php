<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallTypes\SaveRequest;
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
        $halltypes = QueryBuilder::for(HallType::class)
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

        $halltypes = HallTypeResource::collection($halltypes);

        return response()->json($halltypes);
    }

    /**
     * Store a newly created hallType in storage.
     *
     * @param SaveRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SaveRequest $request)
    {
        DB::beginTransaction();

        try {
            $halltype = HallType::create($request->validated());

            DB::commit();

            return response()->json($halltype, 201);
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
    public function show(HallType $halltype)
    {
        $halltype = new HallTypeResource($halltype);

        return response()->json($halltype);
    }

    /**
     * Update the specified hallType in storage.
     *
     * @param UpdateRequest $request
     * @param HallType      $halltype
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, HallType $halltype)
    {
        DB::beginTransaction();

        try {
            $halltype->update($request->validated());

            DB::commit();

            return response()->json($halltype);
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
    public function destroy(HallType $halltype)
    {
        DB::beginTransaction();

        try {
            $halltype->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
