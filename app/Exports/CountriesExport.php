<?php

namespace App\Exports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CountriesExport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Country::select('id', 'name', 'created_at', 'updated_at')->get();
    }

    /**
     * Define the headings for the export file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Created At',
            'Updated At'
        ];
    }
}
