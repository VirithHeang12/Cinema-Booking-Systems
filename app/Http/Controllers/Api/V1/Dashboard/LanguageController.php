<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\StoreRequest;
use App\Http\Requests\Languages\UpdateRequest;
use App\Http\Resources\Api\LanguageResource;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class LanguageController extends Controller
{
    /**
     * Display a listing of the languages.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $languages = QueryBuilder::for(Language::class)
            ->allowedFilters([
                'name',
                'code'
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name',
                'code'
            ])
            ->get();
        $languages = LanguageResource::collection($languages);

        return response()->json($languages);
    }

    /**
     * Store a newly created language in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $language = Language::create($request->validated());

            DB::commit();

            return response()->json($language, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified language.
     *
     * @param Language $language
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Language $language)
    {
        $language = new LanguageResource($language);

        return response()->json($language);
    }

    /**
     * Update the specified language in storage.
     *
     * @param UpdateRequest $request
     * @param Language      $language
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Language $language)
    {
        DB::beginTransaction();

        try {
            $language->update($request->validated());

            DB::commit();

            return response()->json($language);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified language from storage.
     *
     * @param Language $language
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Language $language)
    {
        DB::beginTransaction();

        try {
            $language->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
