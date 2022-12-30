<?php

namespace App\Exports;

use App\Models\enrollment;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class PreEnrollmentExport implements FromView,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        $data = enrollment::select('course_id', 'type', DB::raw('count(*) as total'))->groupBy('course_id', 'type')
            ->where('type', '!=', 'Regular')
            ->orderBy('total', 'desc')
            ->get('total', 'course_id', 'type');

        return view('admin.pages.excelView.preEnrollmentExcel', [
            'preEnrollmentDetails' => $data
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true, 'size' => 12]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
