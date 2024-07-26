<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class PayrollExport implements WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $payrolls;
    protected $month;
    protected $year;

    public function __construct($payrolls,$month,$year)
    {
        $this->payrolls = $payrolls;
        $this->month = $month;
        $this->year = $year;
       
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



                $event->sheet->mergeCells('A8:A9');
                $event->sheet->mergeCells('B8:B9');
                $event->sheet->mergeCells('C8:C9');
                $event->sheet->mergeCells('D8:D9');
                $event->sheet->mergeCells('E8:E9');
                $event->sheet->mergeCells('F8:F9');
                
                
                $event->sheet->setCellValue('A2','ARZAYA - Outsourcing Accounting & Tax Service');
                $event->sheet->setCellValue('A3','Rekap Gaji');
                $event->sheet->setCellValue('A4',date('M d', strtotime($this->payrolls->first()->period)));


                $event->sheet->setCellValue('A6','Periode Tgl.');
                $event->sheet->setCellValue('D6',':');
                // $event->sheet->setCellValue('E6',date('d-M-Y', strtotime($this->startDate)));
                // $event->sheet->setCellValue('H6','s.d.');
                // $event->sheet->setCellValue('I6',date('d-M-Y', strtotime($this->endDate)));



                $event->sheet->setCellValue('A8','Nama');
                $event->sheet->setCellValue('B8','Posisi');
                $event->sheet->setCellValue('C8','Gaji Pokok');
                $event->sheet->setCellValue('D8','Lembur');
                $event->sheet->setCellValue('E8','Telat');
                $event->sheet->setCellValue('F8','Total THP');
                
                
                

                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('F')->setAutoSize(true);
                
                $totalPay = 0;
                $row = 10;
                foreach($this->payrolls as $payroll){
                    $event->sheet->setCellValue('A' . $row, $payroll->employee->name ?? null);
                    $event->sheet->setCellValue('B' . $row, $payroll->position ?? null);
                    $event->sheet->setCellValue('C' . $row, "Rp " .number_format($payroll->basic_salary,0,',','.') ?? null);
                    $event->sheet->setCellValue('D' . $row, "Rp " .number_format($payroll->overtime_pay,0,',','.') ?? null);
                    $event->sheet->setCellValue('E' . $row, "Rp " .number_format($payroll->late_pay,0,',','.') ?? null);
                    $event->sheet->setCellValue('F' . $row, "Rp " .number_format($payroll->total_pay,0,',','.') ?? null);
                    $totalPay += $payroll->total_pay;
                    $row ++;
                }
                $event->sheet->setCellValue('E' . $row, 'Total');
                $event->sheet->setCellValue('F' . $row, "Rp " . number_format($totalPay, 0, ',', '.'));


               
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
                $event->sheet->getStyle('A8:F9')->applyFromArray($headerStyleArray);

                $title = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->getStyle('A2:F6')->applyFromArray($title);

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

    // public function collection()
    // {
    //     $data = [];
    //     foreach($this->payrolls as $payroll){
    //         $data[] =[
    //         'employee_id' => $payroll->employee->name,
    //         'position' => $payroll->position,
    //         'basic_salary' => $payroll->basic_salary,
    //         'overtime_pay' => $payroll->overtime_pay,
    //         'late_pay' => $payroll->late_pay,
    //         'total_pay' => $payroll->total_pay,
    //         ];
    //     }
    //     return collect($data);
    // }

    public function title(): string
    {
        return 'Rekap Penggajian';
    }


    // public function headings(): array
    // {
    //     return [
    //         'Nama',
    //         'Posisi',
    //         'Gaji Pokok',
    //         'Lembur',
    //         'Telat',
    //         'Total THP',
    //     ];
    // }
}
