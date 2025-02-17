<?php

namespace App\Imports;

use App\Models\Country;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountriesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {

                Country::create([
                    'name' => $row['name'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
