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

class EmployeeSalarySheet implements WithEvents, withTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $employees;
    protected $startDate;
    protected $endDate;
    protected $startOfWeek;
    protected $endOfWeek;

    public function __construct($employees,$startOfWeek,$endOfWeek,$startDate,$endDate)
    {
        $this->employees = $employees;
        $this->startOfWeek = $startOfWeek;
        $this->endOfWeek = $endOfWeek;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function title(): string
    {
        static $weekNumber = 1;
        return 'Week ' . $weekNumber++;
    }


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
                $event->sheet->setCellValue('E6',date('d-M-Y', strtotime($this->startDate)));
                $event->sheet->setCellValue('H6','s.d.');
                $event->sheet->setCellValue('I6',date('d-M-Y', strtotime($this->endDate)));



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


                $event->sheet->setCellValue('Y2','Ketentuan :');
                $event->sheet->setCellValue('Z3', 'Time');
                $event->sheet->setCellValue('Y4', 'Masuk (In)');
                $event->sheet->setCellValue('Y5', 'Keluar (Out)');
                $event->sheet->setCellValue('Y6', 'UM LEMBUR');
                
                $event->sheet->setCellValue('Z4', ':');
                $event->sheet->setCellValue('Z5', ':');
                $event->sheet->setCellValue('Z6', ':');
                $event->sheet->setCellValue('AA4', '08:00:00');
                $event->sheet->setCellValue('AA5', '17:00:00');
                $event->sheet->setCellValue('AB4', '08:01:00');
                $event->sheet->setCellValue('AB5', '00:00:00');
                $event->sheet->setCellValue('AA7', '3,15');

                $event->sheet->setCellValue('AC4', 'lembur');
                $event->sheet->setCellValue('AC5', 'Uang Makan');
                $event->sheet->setCellValue('AE4', ': =>');
                $event->sheet->setCellValue('AE5', ':');
                $event->sheet->setCellValue('AF4', '3,15');
                $event->sheet->setCellValue('AF5', '50000');
                $event->sheet->setCellValue('AC6', ':');
                $event->sheet->setCellValue('AE7', '3,00');
                $event->sheet->setCellValue('AG4', '20:16:00');

                
                //Tabel Ke Dua
                $event->sheet->setCellValue('Y8','Periode Tgl.');
                $event->sheet->setCellValue('Z8','No.');
                $event->sheet->setCellValue('AA8','Nama');
                $event->sheet->setCellValue('AB8','Divisi');
                $event->sheet->setCellValue('AC8','Gaji Pokok');
                $event->sheet->setCellValue('AD8','Overtime/jam');
                $event->sheet->setCellValue('AE8','OVERTIME(SPJ)');
                $event->sheet->setCellValue('AF8','UM LEMBUR');
                $event->sheet->setCellValue('AG8','UM SPJ');
                $event->sheet->setCellValue('AH8','UU');
                $event->sheet->setCellValue('AI8','Total');
                $event->sheet->setCellValue('AJ8','Jumlah');

                
                

                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('I')->setAutoSize(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('J')->setAutoSize(true);
                $event->sheet->getColumnDimension('P')->setAutoSize(true);
                $event->sheet->getColumnDimension('S')->setAutoSize(true);
                $event->sheet->getColumnDimension('Q')->setAutoSize(true);
                $event->sheet->getColumnDimension('T')->setAutoSize(true);
                $event->sheet->getColumnDimension('W')->setAutoSize(true);
                $event->sheet->getColumnDimension('V')->setAutoSize(true);
                $event->sheet->getColumnDimension('Y')->setAutoSize(true);

                $event->sheet->getColumnDimension('AC')->setAutoSize(true);
                $event->sheet->getColumnDimension('AD')->setAutoSize(true);
                $event->sheet->getColumnDimension('AE')->setAutoSize(true);
                $event->sheet->getColumnDimension('AF')->setAutoSize(true);


                $row = 10;
                $currentDate = $this->startOfWeek->copy();
                while($currentDate->lte($this->endOfWeek)){
                foreach($this->employees as $index=> $employee)
                {
                        $attendance = $employee->attendances->where('date', $currentDate->format('Y-m-d'))->first();
                        if ($attendance) {
                                    $event->sheet->setCellValue('B' . $row, date('d M', strtotime($currentDate)));
                                    $event->sheet->setCellValue('D' . $row, $index + 1);
                                    $event->sheet->setCellValue('E' . $row, $employee->name ?? null);
                                    $event->sheet->setCellValue('F' . $row, $employee->careerHistories->last()->department->name ?? null);
                                    // $event->sheet->setCellValue('G'. $row,  "Rp " .number_format($employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount, 0, ',', '.') ?? null );
                                    $event->sheet->setCellValue('G'. $row,  $employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount);
                                    // if($salaryComponent->name == 'gaji pokok'){
                                    //     $event->sheet->setCellValue('G' . $row, "Rp " . number_format($salaryComponent->pivot->amount,2,',','.'));
                                    // }
                                    $event->sheet->setCellValue('H' . $row, date('H:i', strtotime($attendance->clock_in ?? null)));
                                    $event->sheet->setCellValue('I' . $row, date('H:i', strtotime($attendance->clock_out ?? null)));
                                     
                                    // $event->sheet->getStyle('K' . $row)->getNumberFormat()->setFormatCode('hh:mm');
                                    // $event->sheet->setCellValue('K' . $row, '=IF(H' . $row . '<$AA$4, ($AA$4 - H' . $row . '), IF(H' . $row . '>=$AA$4, $AB$5))');
                                    $event->sheet->getStyle('L' . $row)->getNumberFormat()->setFormatCode('hh:mm');
                                    if ($event->sheet->getCell('I' . $row)->getValue() == '00:00') {
                                        $event->sheet->setCellValue('L' . $row, '0');
                                    } else {
                                        $event->sheet->setCellValue('L' . $row, '=IF($AA$5<I' . $row . ', (I' . $row . ' - $AA$5), ($AB$5 - $AA$5 + I' . $row . '))');
                                    }
                                    

                                    $event->sheet->setCellValue('O' . $row, '=ROUND((HOUR(L' . $row . ')*60 + MINUTE(L' . $row . ')) / 60, 2)');
                                    
                                    $formulaQ = '=IF(O' . $row . ' >= 3.15, 50000,"")';
                                    $event->sheet->setCellValue('Q' . $row, $formulaQ);

                                    $event->sheet->getStyle('Q' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

                                    $formulaR = '=IF((P' .$row. ')>= $AE$7, 50000 , IF((O' . $row . ') <> "", "-", 0))';
                                    $event->sheet->setCellValue('R' . $row, $formulaR);
                                    $event->sheet->getStyle('R' . $row)->getNumberFormat()->setFormatCode('#,##0.00');



                                    $formulaS = '=IF(O' . $row . '>1, ((1.5*1/173*G' . $row . ') + ((O' . $row . '-1)*2*1/173*G' . $row . ')), IF(O' . $row . '<=1, (O' . $row . '*1.5*1/173*G' . $row . '), IF((O' . $row . ') <> "", "-", 0)))';
                                    $event->sheet->setCellValue('S' . $row, $formulaS);
                                    $event->sheet->getStyle('S' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

                                    $formulaT = '=1.5*1/173*G' . $row . '*O' . $row;
                                    $event->sheet->setCellValue('T' . $row, $formulaT);
                                    $event->sheet->getStyle('T' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

                                    $formulaV = '=T' . $row . '+U' . $row;
                                    $event->sheet->setCellValue('V' .$row, $formulaV);
                                    $event->sheet->getStyle('V' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

                                
                                   $row++;
                                }else{
                                    $event->sheet->setCellValue('B' . $row, date('d M', strtotime($currentDate)));
                                    $event->sheet->setCellValue('D' . $row, $index + 1);
                                    $event->sheet->setCellValue('E' . $row, $employee->name);
                                    $event->sheet->setCellValue('F' . $row, $employee->careerHistories->last()->department->name);
                                    $event->sheet->setCellValue('G'. $row,  $employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount);
                                    
                                    // $event->sheet->setCellValue('B' . $row, '-');
                                    // $event->sheet->setCellValue('D' . $row, '-');
                                    // $event->sheet->setCellValue('E' . $row, '-');
                                    // $event->sheet->setCellValue('F' . $row, '-');
                                    // $event->sheet->setCellValue('G' . $row, '-');
                                    $event->sheet->setCellValue('H' . $row, '-');
                                    $event->sheet->setCellValue('I' . $row, '-');
                                    // $event->sheet->setCellValue('K' . $row, '-');
                                    $event->sheet->setCellValue('L' . $row, '-');
                                    $event->sheet->setCellValue('O' . $row, '-');
                                    $event->sheet->setCellValue('Q' . $row, '-');
                                    $event->sheet->setCellValue('R' . $row, '-');
                                    $event->sheet->setCellValue('S' . $row, '-');
                                    $event->sheet->setCellValue('T' . $row, '-');
                                    $event->sheet->setCellValue('V' . $row, '-');
                                   $row++;
                                }                
                            }
                            $row++;
                            $currentDate->addDay();
                         }


                         $row2 = 9;
                         foreach($this->employees as $index => $employee){
                            $event->sheet->setCellValue('Z' . $row2, $index + 1);
                            $event->sheet->setCellValue('AA' . $row2, $employee->name);
                            $event->sheet->setCellValue('AB' . $row2, $employee->careerHistories->last()->department->name);
                            // $event->sheet->setCellValue('G'. $row2,  "Rp " .number_format($employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount, 0, ',', '.'));
                            $event->sheet->setCellValue('AC'. $row2,  $employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount);
                            $event->sheet->setCellValue('AD' . $row2, '=SUMIF($E$10:$E$99, AA' . $row2 . ', $O$10:$O$99)');
                            $event->sheet->setCellValue('AE' . $row2, '=SUMIF($E$10:$R$99, AA' .$row2 . ',$P$10:$P$99)');
                            $event->sheet->setCellValue('AF' . $row2, '=SUMIF($E$10:$R$99, AA' .$row2 . ',$Q$10:$Q$99)');
                            $event->sheet->setCellValue('AG' . $row2, '=SUMIF($E$10:$R$99, AA' .$row2 . ',$R$10:$R$99)');
                            $event->sheet->setCellValue('AH' . $row2, '=AF' . $row2 . '+AG' . $row2);
                            // $event->sheet->setCellValue('AD' . $row2, '=SUM(AD9:AD11)');
                            $row2++;
                         }


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
