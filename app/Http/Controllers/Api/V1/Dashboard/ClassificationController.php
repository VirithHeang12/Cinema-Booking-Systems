<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Http\Resources\Api\ClassificationResource;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Classifications\StoreRequest;
use App\Http\Requests\Classifications\UpdateRequest;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classifications = QueryBuilder::for(Classification::class)
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
        $classifications = ClassificationResource::collection($classifications);
        return response()->json($classifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $classification = Classification::create($request->validated());
            DB::commit();
            return response()->json($classification, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        $classification = new ClassificationResource($classification);
        return response()->json($classification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Classification $classification)
    {
        DB::beginTransaction();
        try{
            $classification->update($request->validated());
            DB::commit();
            return response()->json($classification);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classification $classification)
    {
        DB::beginTransaction();

        try {
            $classification->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
