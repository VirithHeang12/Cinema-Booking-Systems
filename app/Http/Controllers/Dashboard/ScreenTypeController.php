<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ScreenTypesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScreenType\StoreRequest;
use App\Http\Requests\ScreenType\UpdateRequest;
use App\Http\Resources\Api\ScreenTypeResource;
use App\Imports\ScreenTypeImport;
use App\Models\ScreenType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use InertiaUI\Modal\Modal;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ScreenTypeController extends Controller
{

    /**
     * Display a listing of the screen type.
     *
     * @return \Inertia\Response
     *
     */
    public function index(): \Inertia\Response
    {

        $perPage = request()->query('itemsPerPage', 10);

        $screenTypes = QueryBuilder::for(ScreenType::class)
            ->allowedFilters([AllowedFilter::callback('search', function ($query, $value) {
                $query->where('name', 'like', "%{$value}%");
             })])
            ->allowedSorts('name')
            ->paginate($perPage)
            ->appends(request()->query());

        $screenTypes = ScreenTypeResource::collection($screenTypes)->response()->getData(true);

        return Inertia::render('Dashboard/ScreenTypes/Index', [
            'screen_types' => $screenTypes,
        ]);
    }

    /**
     * Show the form for creating a new screen type.
     *
     * @return \Inertia\Response
     */

    public function create(): Modal
    {
        return Inertia::modal('Dashboard/ScreenTypes/Create')->baseRoute('dashboard.screen_types.index');
    }

    /**
     * Store a newly created screen type in storage.
     *
     * @param  \App\Http\Requests\ScreenType\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        $request->validated();

        try{
            ScreenType::create([
                'name' => $request['name'],
                'description' => $request['description'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Screen Type created.');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->route('dashboard.screen_types.index')->with('error', 'Screen Type not created.');
        }
    }

    /**
     * Display the specified screen type.
     *
     * @param  \App\Models\ScreenType  $screen_type
     * @return \Inertia\Response
     */

    public function show(ScreenType $screen_type): Modal
    {
        return Inertia::modal('Dashboard/ScreenTypes/Show', [
            'screen_type'      => $screen_type,
        ]);
    }

    /**
     * Show the form for editing the specified screen type.
     *
     * @param  \App\Models\ScreenType  $screen_type
     * @return \Inertia\Response
     */

    public function edit(ScreenType $screen_type): Modal
    {
        return Inertia::modal('Dashboard/ScreenTypes/Edit', [
            'screen_type'      => $screen_type,
        ])->baseRoute('dashboard.screen_types.index');
    }

    public function update(UpdateRequest $request, ScreenType $screen_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        $request->validated();

        try {

            $screen_type->update([
                'name' => $request['name'],
                'description' => $request['description'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Screen Type updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.screen_types.index')->with('error', 'Screen Type not updated.');
        }
    }

    public function delete(ScreenType $screen_type): Modal
    {

        return Inertia::modal('Dashboard/ScreenTypes/Delete', [
            'screen_type' => $screen_type,
        ])->baseRoute('dashboard.screen_types.index');
    }

    public function destroy(ScreenType $screen_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $screen_type->delete();

            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Screen Type deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.screen_type.index')->with('error', 'Screen Type not deleted.');
        }
    }

      /**
     * Show Import ScreenTypes form.
     * @return \Inertia\Response
     */
    public function showImport(){
        return Inertia::render('Dashboard/ScreenTypes/Import');
    }

     /**
     * Import ScreenType from excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        DB::beginTransaction();

        try {
            Excel::import(new ScreenTypeImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Genres imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.screen_types.index')->with('error', $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new ScreenTypesExport, 'screen_type.xlsx');
    }

}
