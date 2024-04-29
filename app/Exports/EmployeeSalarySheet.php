<?php

namespace App\Exports;

use App\Models\EmployeeModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeSalarySheet implements WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }
    // public function title(): string
    // {
    //     $weekNumber = 1;
    //     return $this('Weak'. $weekNumber++);
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event)
            {
                $event->sheet->mergeCells('A2:W2');
                $event->sheet->mergeCells('A3:W3');
                $event->sheet->mergeCells('A4:W4');

                $event->sheet->mergeCells('A6:C6');



                $event->sheet->mergeCells('A8:C9');
                $event->sheet->mergeCells('D8:D9');
                $event->sheet->mergeCells('E8:E9');
                $event->sheet->mergeCells('F8:F9');
                $event->sheet->mergeCells('G8:G9');
                $event->sheet->mergeCells('H8:H9');
                $event->sheet->mergeCells('I8:I9');
                $event->sheet->mergeCells('J8:J9');
                $event->sheet->mergeCells('K8:L8');
                $event->sheet->mergeCells('M8:M9');
                $event->sheet->mergeCells('N8:O8');
                $event->sheet->mergeCells('P8:P9');
                $event->sheet->mergeCells('T8:T9');
                $event->sheet->mergeCells('V8:V9');
                $event->sheet->mergeCells('W8:W9');
                
                
                $event->sheet->setCellValue('A2','ARZAYA - Outsourcing Accounting & Tax Service');
                $event->sheet->setCellValue('A3','Data Absensi');
                $event->sheet->setCellValue('A4','Feb-24');


                $event->sheet->setCellValue('A6','Periode Tgl.');
                $event->sheet->setCellValue('D6',':');
                $event->sheet->setCellValue('E6','26-Feb-24');
                $event->sheet->setCellValue('H6','s.d.');
                $event->sheet->setCellValue('I6','26-Feb-24');





                $event->sheet->setCellValue('A8','Tanggal');
                $event->sheet->setCellValue('D8','No');
                $event->sheet->setCellValue('E8','Nama');
                $event->sheet->setCellValue('F8','Divisi');
                $event->sheet->setCellValue('G8','Gaji Pokok');
                $event->sheet->setCellValue('H8','In');
                $event->sheet->setCellValue('I8','Out');
                $event->sheet->setCellValue('J8','Finis(SPJ)');
                $event->sheet->setCellValue('K8','Lembur');
                $event->sheet->setCellValue('K9','Pagi');
                $event->sheet->setCellValue('L9','Sore');
                $event->sheet->setCellValue('M8','Telat');
                $event->sheet->setCellValue('N8','Lembur');
                $event->sheet->setCellValue('N9','Rmh');
                $event->sheet->setCellValue('O9','Total');
                $event->sheet->setCellValue('P8','Overtime(SPJ)');
                $event->sheet->setCellValue('Q8','UM');
                $event->sheet->setCellValue('Q9','Lembur');
                $event->sheet->setCellValue('R8','UM');
                $event->sheet->setCellValue('R9','SPJ');
                $event->sheet->setCellValue('S8','');
                $event->sheet->setCellValue('S9','');
                $event->sheet->setCellValue('T8','Lembur UU');
                $event->sheet->setCellValue('U8','');
                $event->sheet->setCellValue('U9','');
                $event->sheet->setCellValue('V8','Total');
                $event->sheet->setCellValue('W8','Keterangan Lembur/Telat/dsb.');


                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('I')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('J')->setAutoSize(true);
                $event->sheet->getColumnDimension('P')->setAutoSize(true);
                $event->sheet->getColumnDimension('T')->setAutoSize(true);
                $event->sheet->getColumnDimension('W')->setAutoSize(true);


                $row = 10;
                $angka = 1;
                $total = 0;
                
                foreach($this->employees as $employee){
                    // foreach($employee->attendances as $attendance){
                                    $event->sheet->setCellValue('A' . $row, date('d M', strtotime($employee->attendance->date)));
                                    $event->sheet->setCellValue('D' . $row, $angka++);
                                    $event->sheet->setCellValue('E' . $row, $employee->name);
                                    $event->sheet->setCellValue('F' . $row, $employee->careerHistories->last()->department->name);
                                    $event->sheet->setCellValue('G'. $row,  "Rp " .number_format($employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount, 0, ',', '.'));
                                    // if($salaryComponent->name == 'gaji pokok'){
                                    //     $event->sheet->setCellValue('G' . $row, "Rp " . number_format($salaryComponent->pivot->amount,2,',','.'));
                                    // }
                                    $event->sheet->setCellValue('H' . $row, date('H:i', strtotime($employee->attendance->clock_in)));
                                    $event->sheet->setCellValue('I' . $row, date('H:i', strtotime($employee->attendance->clock_out)));
                                    
                                    // $event->sheet->setCellValue('L' . $row, gmdate('H:i',$attendance->overtime));
                                    $event->sheet->setCellValue('K' . $row, '00:00');
                                    $event->sheet->setCellValue('L' . $row, '=IF(I' . $row . ' <= TIME(17, 0, 0), "00:00", TEXT(I' . $row . ' - TIME(17, 0, 0), "hh:mm"))');

                                    //pembulatan 2 keatas
                                    // langsung di bulatkan yang lembur di bagi 60 
                                    $overtimeMinutes = intval($employee->attendance->overtime) / 60;

                                    $overtimeRounded = round($overtimeMinutes, 2);
                                    $event->sheet->setCellValue('O' . $row, $overtimeRounded);
                                    $formulaT = '=1.5*1/173*G' . $row . '*O' . $row;
                                    $event->sheet->setCellValue('T' . $row, $formulaT);

                                        // Buat rumus untuk cell V tanpa pembulatan
                                    $formulaV = '=IF(O' . $row . '>1, ((1.5*1/173*G' . $row . ') + ((O' . $row . '-1)*2*1/173*G' . $row . ')), IF(O' . $row . '<=1, (O' . $row . '*1.5*1/173*G' . $row . '), 0))';
                                    $event->sheet->setCellValue('V' . $row, $formulaV);
                                
                                    // $event->sheet->setCellValue('O' . $row, '=IF(L' . $row . ' > 0, CEILING(VALUE(L' . $row . ') / 60, 0.00), 0)');
                                   $row++;
                            // }
                         }

                // foreach ($event->sheet->getWorksheet()->getColumnIterator() as $column) {
                //     $cellIterator = $column->getCellIterator();
                //     foreach ($cellIterator as $cell) {
                //         $cellValue = $cell->getValue();
                //         if ($cellValue instanceof \PhpOffice\PhpSpreadsheet\Cell\Formula) {
                //             $event->sheet->getCell($cell->getColumn() . $cell->getRow())->setValue($cell->getCalculatedValue());
                //         }
                //     }
                // }

                $headerStyleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FC8EAC', // Warna PINK
                        ],
                    ],
                ];
                $event->sheet->getStyle('A8:W9')->applyFromArray($headerStyleArray);

                $title = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->getStyle('A2:W6')->applyFromArray($title);

                $bodyStyle = [
                    // 'borders' => [
                    //     'allBorders' => [
                    //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    //     ],
                    // ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ];

                $event->sheet->getStyle('A10:W10' . $row)->applyFromArray($bodyStyle);


            }
        ];
    }
}
