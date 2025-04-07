<?php

namespace App\Exports;

use App\Models\Country;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CountriesExport implements FromView, WithStyles, ShouldAutoSize, WithTitle
{
    private $data;

    public function __construct()
    {
        $countries = Country::all();

        $this->data = [
            'countries' => $countries,
        ];
    }

    /**
     * Export from view
     */
    public function view(): View
    {
        return view('exports.country', [
            'countries' => $this->data['countries'],
        ]);
    }

    /**
     * Title of the sheet
     */
    public function title(): string
    {
        return 'ប្រទេស';
    }

    /**
     * Style for the export
     */
    public function styles(Worksheet $sheet): void
    {
        $fontPrimary    = 'Kantumruy Pro';
        $fontSecondary  = 'Kantumruy Pro';
        $fontTertiary   = 'Kantumruy Pro';

        $lastColumn = 'B';
        $lastRow = count($this->data['countries']) + 2;

        $styles = [
            // Title row
            'A1:' . $lastColumn . '1' => [
                'font' => [
                    'name' => $fontTertiary,
                    'bold' => true,
                    'size' => 16,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
            ],

            // Subtitle row
            'A2:' . $lastColumn . '2' => [
                'font' => [
                    'name' => $fontSecondary,
                    'bold' => true,
                    'size' => 14,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
            ],

            'A4:' . $lastColumn . $lastRow => [
                'font' => [
                    'name' => $fontPrimary,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal'    => Alignment::HORIZONTAL_CENTER,
                    'vertical'      => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];

        foreach ($styles as $range => $style) {
            $sheet->getStyle($range)->applyFromArray($style);
        }
    }
}
