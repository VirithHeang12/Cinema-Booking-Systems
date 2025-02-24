<?php

namespace App\Imports;

use App\Models\ScreenType;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class ScreenTypeImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                ScreenType::create([
                    'name' => $row['name'],
                    'description' => $row['description'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
