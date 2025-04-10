<?php

namespace App\Imports;

use App\Models\SeatType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SeatTypesImport implements ToCollection, WithHeadingRow
{

    /**
     * Import seat types from an Excel file.
     *
     * @param Collection $rows
     *
     * @return void
     */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                SeatType::updateOrCreate([
                    'name'          => $row['name'],
                ], [
                    'description'   => $row['description'],
                    'price'         => $row['price'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
