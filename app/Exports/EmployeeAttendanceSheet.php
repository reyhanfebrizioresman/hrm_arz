<?php

namespace App\Exports;

use App\Models\EmployeeModel;
use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EmployeeAttendanceSheet implements FromCollection, WithTitle, WithEvents
{
    protected $employee;
    protected $attendanceData; 

    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    public function title(): string
    {
        return $this->employee->name; // Set judul sheet dengan nama employee
    }

    public function collection()
    {
        $attendances = Attendance::where('employee_id', $this->employee->id)->get();

        $attendanceData = [];
        foreach ($attendances as $attendance) {
            $attendanceData[] = [
                'Tanggal' => $attendance->date,
                'In' => $attendance->clock_in,
                'Out' => $attendance->clock_out,
                'Jam Puasa' => '', // Sesuaikan dengan atribut yang sesuai
                'eza' => '', // Sesuaikan dengan atribut yang sesuai
                'Ket' => '', // Sesuaikan dengan atribut yang sesuai
            ];
        }

        return collect($attendanceData);
    }
    public function registerEvents(): array
{
    return [
        AfterSheet::class => function(AfterSheet $event) {
            $sheet = $event->sheet;

            // Set column widths
            if (!is_null($this->attendanceData) && is_array($this->attendanceData) && count($this->attendanceData[0]) > 0) {
                // for ($col = 0; $col < count($this->attendanceData[0]); $col++) {
                    $sheet->getColumnDimension()->setWidth([
                        'A' => 15,
                        'B' => 10,
                        'C' => 10,
                        'D' => 15,
                        'E' => 30,
                        'F' => 15,
                    ]);
                // }
            }

            // Set column headers
            $sheet->setCellValue('A1', 'Tanggal');
            $sheet->setCellValue('A2', '');
            $sheet->setCellValue('C1', 'Jam');
            $sheet->setCellValue('B2', 'In' , );
            $sheet->setCellValue('C2', 'Out');
            $sheet->setCellValue('D2', 'Jam Puasa');
            $sheet->setCellValue('E1', $this->employee->name);
            $sheet->setCellValue('E2', 'Ket');

            $sheet->getStyle('A1:E1')->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'EEEEEE',
                    ],
                ],
            ]);

            // Insert attendance data starting from row 2
            if (!is_null($this->attendanceData) && is_array($this->attendanceData) && count($this->attendanceData) > 0) {
                $sheet->fromArray($this->attendanceData, null, 'A2', false, false);
            }

            // Set borders for all cells
            if (!is_null($this->attendanceData) && is_array($this->attendanceData) && count($this->attendanceData) > 0) {
                $sheet->setBorder('A1:' . chr(count($this->attendanceData[0]) + 64) . (count($this->attendanceData) + 1), 'thin');
            }
        },
    ];
}
}
