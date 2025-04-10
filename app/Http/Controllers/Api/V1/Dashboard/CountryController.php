<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Countries\StoreRequest;
use App\Http\Requests\Countries\UpdateRequest;
use App\Http\Resources\Api\CountryResource;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $countries = QueryBuilder::for(Country::class)
            ->allowedFilters([
                'name',
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name',
            ])
            ->get();

        $countries = CountryResource::collection($countries);

        return response()->json($countries);
    }

     /**
     * Store a newly created country in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $country = Country::create($request->validated());

            DB::commit();

            return response()->json($country, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified country.
     *
     * @param Country $country
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Country $country)
    {
        $country = new CountryResource($country);

        return response()->json($country);
    }

     /**
     * Update the specified country in storage.
     *
     * @param UpdateRequest $request
     * @param Country      $country
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Country $country)
    {
        DB::beginTransaction();

        try {
            $country->update($request->validated());

            DB::commit();

            return response()->json($country);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified country from storage.
     *
     * @param Country $country
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Country $country)
    {
        DB::beginTransaction();

        try {
            $country->delete();

            DB::commit();

            return response()->json(['message' => 'Country deleted successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
