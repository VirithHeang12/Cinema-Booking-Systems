<?php

namespace App\Imports;

use App\Models\ScreenType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScreenTypeImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {

        $placeholderThumbnailUrl =  resource_path('/assets/images/placeholder.jpg');

        $randomName = Str::random(40) . '.' . pathinfo($placeholderThumbnailUrl, PATHINFO_EXTENSION);

        $storagePath = Storage::disk('local')->putFileAs('screen_types', new \Illuminate\Http\File($placeholderThumbnailUrl), $randomName);

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
