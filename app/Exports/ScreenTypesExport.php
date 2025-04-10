<?php

namespace App\Exports;

use App\Models\Movie;
use App\Models\ScreenType;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ScreenTypesExport implements FromView, WithStyles, ShouldAutoSize, WithTitle
{
    private $data;

    public function __construct()
    {
       $screenTypes = ScreenType::all();

        $this->data = [
            'screenTypes'        => $screenTypes,
        ];
    }

    /**
     * Export from view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('exports.screen_type', [
            'screenTypes'        => $this->data['screenTypes'],
        ]);
    }

    /**
     * Set the sheet title
     *
     * @return string
     */
    public function title(): string
    {
        return 'ប្រភេទអេក្រង់';
    }


    /**
     * Set the styles for the sheet
     *
     * @param Worksheet $sheet
     *
     * @return void
     */
    public function styles(Worksheet $sheet): void
    {
        $fontPrimary        = 'Khmer OS Siemreap';
        $fontSecondary      = 'Khmer OS Muol';
        $fontTertiary       = 'Khmer OS Siemreap';



        $lastColumn         = $sheet->getHighestColumn();

        /// last row
        $lastRow            = count($this->data['screenTypes']) + 4;

        // Define the array to store cell styles
        $styles = [
            // Header Section Style
            'A1:' . $lastColumn . '1' => [
                'font' => [
                    'name' => $fontTertiary,
                    'bold' => true,
                    'size' => 16,
                ],
                'alignment' => [
                    'horizontal'    => Alignment::HORIZONTAL_LEFT,
                    'vertical'      => Alignment::VERTICAL_CENTER
                ],
            ],

            // Header Section Style
            'A2:' . $lastColumn . '2' => [
                'font' => [
                    'name' => $fontSecondary,
                    'bold' => true,
                    'size' => 14,
                ],
                'alignment' => [
                    'horizontal'    => Alignment::HORIZONTAL_CENTER,
                    'vertical'      => Alignment::VERTICAL_CENTER
                ],
            ],

            /// Table Header Section Style
            'A4:' . $lastColumn . '4' => [
                'font' => [
                    'name' => $fontPrimary,
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal'    => Alignment::HORIZONTAL_CENTER,
                    'vertical'      => Alignment::VERTICAL_CENTER
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],

            /// Table Data Section Style
            'A5:' . $lastColumn . $lastRow => [
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

        /// Apply styles to the worksheet
        foreach ($styles as $range => $style) {
            $sheet->getStyle($range)->applyFromArray($style);
        }
    }
}

