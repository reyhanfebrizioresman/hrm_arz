<?php

namespace App\Exports;

use App\Models\EmployeeModel;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;

class AllAttendanceExport implements FromView, WithMultipleSheets, WithEvents
{
    use Exportable;
    protected $employees;
    

    public function __construct($employees)
    {
        $this->employees = $employees;
    }



    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->employees as $employee) {
            $sheets[] = new EmployeeAttendanceSheet($employee);
        }

        return $sheets;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event)
            {
                $event->sheet->mergeCells('A1:A2');
                $event->sheet->mergeCells('B1:C1:D1');
                $event->sheet->mergeCells('A1:A2');


                 //DEFINISIKAN STYLE UNTUK CELL
                 $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'FFA0A0A0',
                        ],
                        'endColor' => [
                            'argb' => 'FFFFFFFF',
                        ],
                    ],
                ];
                $event->sheet->getStyle('A3:E3')->applyFromArray($styleArray);


                
            }
        ];
    }

    public function view() : View
    {
        // $sheets = [];

        // foreach ($this->employees as $employee) {
        //     $sheets[] = new EmployeeAttendanceSheet($employee);
        // }
        // return view('attendance.viewExport',compact('sheets'));
        $startDate = Carbon::now()->subDays(7)->startOfWeek();
        $endDate = Carbon::now()->subDays(1)->endOfWeek();
        
        $employees = EmployeeModel::with(['attendance' => function($query) use ($startDate, $endDate) {
            // Menampilkan data kehadiran dalam rentang tanggal 1 minggu terakhir
            $query->whereBetween('date', [$startDate, $endDate]);
        }])->get();

        return view('attendance.viewExport',[
            'employees' => $employees
        ]);
    }

}



