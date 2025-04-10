<?php

namespace App\Imports;

use App\Models\Language;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class LanguagesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                // Check if the language already exists in the database
               if(Language::where('code', $row['code'])->exists()|| Language::where('name', $row['name'])->exists()) {
                    // If it exists, skip the row
                    continue;
                }

                Language::updateOrCreate([
                    'name' => $row['name'],
                    'code' => $row['code'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
