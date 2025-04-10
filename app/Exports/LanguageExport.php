<?php

namespace App\Exports;

use App\Models\Language;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LanguageExport implements FromView, WithStyles, ShouldAutoSize, WithTitle
{
    private $data;

    public function __construct()
    {
        $languages = Language::all();

        $this->data = [
            'languages' => $languages,
        ];
    }

    /**
     * Export from view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('exports.language', [
            'languages'        => $this->data['languages'],
        ]);
    }

    /**
     * Set the sheet title
     *
     * @return string
     */
    public function title(): string
    {
        return 'ភាសា';
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
        $lastRow            = count($this->data['languages']) + 4;

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
