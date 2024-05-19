<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class ResultSheet implements WithEvents
{
    protected $datas;

    public function __construct($datas)
    {
        $this->datas = $datas;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event)
            {
                $event->sheet->mergeCells('A2:L2');
                $event->sheet->mergeCells('A3:L3');
                $event->sheet->mergeCells('A4:L4');

                $event->sheet->mergeCells('A6:A7');
                $event->sheet->mergeCells('B6:B7');
                $event->sheet->mergeCells('C6:C7');
                $event->sheet->mergeCells('D6:F6');
                $event->sheet->mergeCells('G6:G7');
                $event->sheet->mergeCells('H6:H7');
                $event->sheet->mergeCells('I6:I7');
                $event->sheet->mergeCells('J6:J7');
                $event->sheet->mergeCells('K6:K7');
                $event->sheet->mergeCells('L6:L7');
                $event->sheet->mergeCells('A13:C13');
                $event->sheet->mergeCells('A14:L14');
                $event->sheet->mergeCells('A16:B16');
                $event->sheet->mergeCells('B17:C17');
                $event->sheet->mergeCells('B19:D19');

                $event->sheet->mergeCells('A21:F21');
                $event->sheet->mergeCells('A24:C24');
                $event->sheet->mergeCells('A25:B25');
                $event->sheet->mergeCells('A31:B31');

                $event->sheet->mergeCells('G25:I25');
                $event->sheet->mergeCells('G31:I31');



               
                
                
                $event->sheet->setCellValue('A2','ARZAYA - Outsourcing Accounting & Tax Service');
                $event->sheet->setCellValue('A3','Data Absensi');
                $event->sheet->setCellValue('A4','Feb-24');

                $event->sheet->setCellValue('A6','No.');
                $event->sheet->setCellValue('B6','Nama');
                $event->sheet->setCellValue('C6','Divisi');
                $event->sheet->setCellValue('D6','Lembur');
                $event->sheet->setCellValue('D7','Per.Jam');
                $event->sheet->setCellValue('E7','30%');
                $event->sheet->setCellValue('F7','Nominal');
                $event->sheet->setCellValue('G6','UM LEMBUR');
                $event->sheet->setCellValue('H6','UM SPJ');
                $event->sheet->setCellValue('I6','TOTAL Lembur + UM');
                $event->sheet->setCellValue('J6','Selisih -/+');
                $event->sheet->setCellValue('K6','TRF Lembur');
                $event->sheet->setCellValue('L6','Keterangan');
                $event->sheet->setCellValue('A13','Total');

                $event->sheet->setCellValue('A14','** Perhitungan Lembur Dari Tanggal 26 Februari 24 sd 24 Maret 2024');

                $event->sheet->setCellValue('A16','Kesimpulan :');
                $event->sheet->setCellValue('B17','Jumlah Lembur');
                $event->sheet->setCellValue('D17',':');
                $event->sheet->setCellValue('B18','Jumlah Um ');
                $event->sheet->setCellValue('D18',':');
                $event->sheet->setCellValue('B19','Total Lembur + UM');


                $event->sheet->setCellValue('A24','Bandung, 26 Februari 2024');
                $event->sheet->setCellValue('A25','Dibuat Oleh');


                $event->sheet->setCellValue('A31','Kristina Aprianti');



                $event->sheet->setCellValue('G25','Bandung, 26 Februari 2024');
                $event->sheet->setCellValue('G31','Rezha Rizki Sutransah');



                






                

                
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('I')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('J')->setAutoSize(true);
                $event->sheet->getColumnDimension('K')->setAutoSize(true);
                $event->sheet->getColumnDimension('L')->setAutoSize(true);

                $row = 8;

                foreach($this->datas as $index=> $employee)
                {
                    $event->sheet->setCellValue('A' .$row ,$index +1 );
                    $event->sheet->setCellValue('B' .$row ,$employee->name );
                    $event->sheet->setCellValue('C' . $row, $employee->careerHistories->last()->department->name);
                    // $formulaD = '=SUMIF(\'Week 5\'!$E$43:$E$47, B' . $row . ', \'Week 5\'!$H$43:$H$47';
                    // $formulaD = '=SUMIF(\'Week 1\'!$E$43:$E$47, B' . $row . ', \'Week 1\'!$H$43:$H$47) + 
                    //             SUMIF(\'Week 2\'!$E$43:$E$47, B' . $row . ', \'Week 2\'!$H$43:$H$47) + 
                    //             SUMIF(\'Week 3\'!$E$43:$E$47, B' . $row . ', \'Week 3\'!$H$43:$H$47) + 
                    //             SUMIF(\'Week 4\'!$E$43:$E$47, B' . $row . ', \'Week 4\'!$H$43:$H$47) + 
                    //             SUMIF(\'Week 5\'!$E$43:$E$47, B' . $row . ', \'Week 5\'!$H$43:$H$47)';
                    // $event->sheet->setCellValue('D' . $row, $formulaD);

                    //  $formulaE = '=SUMIF(\'Week 1\'!$E$43:$E$47, B' . $row . ', \'Week 1\'!$I$43:$I$47) + 
                    //             SUMIF(\'Week 2\'!$E$43:$E$47, B' . $row . ', \'Week 2\'!$I$43:$I$47) + 
                    //             SUMIF(\'Week 3\'!$E$43:$E$47, B' . $row . ', \'Week 3\'!$I$43:$I$47) + 
                    //             SUMIF(\'Week 4\'!$E$43:$E$47, B' . $row . ', \'Week 4\'!$I$43:$I$47) + 
                    //             SUMIF(\'Week 5\'!$E$43:$E$47, B' . $row . ', \'Week 5\'!$I$43:$I$47)';
                    // $event->sheet->setCellValue('E' . $row, $formulaE);


                    // $formulaG = '=IFERROR(
                    //     SUMIF(\'Week 1\'!$E$43:$E$47, B' . $row . ', \'Week 1\'!$J$43:$J$47) + 
                    //     SUMIF(\'Week 2\'!$E$43:$E$47, B' . $row . ', \'Week 2\'!$J$43:$J$47) + 
                    //     SUMIF(\'Week 3\'!$E$43:$E$47, B' . $row . ', \'Week 3\'!$J$43:$J$47) + 
                    //     SUMIF(\'Week 4\'!$E$43:$E$47, B' . $row . ', \'Week 4\'!$J$43:$J$47) + 
                    //     SUMIF(\'Week 5\'!$E$43:$E$47, B' . $row . ', \'Week 5\'!$J$43:$J$47),
                    //     -
                    // )';
                    // $event->sheet->setCellValue('G' . $row, $formulaG);

                    // $formulaG = '=SUMIF(\'Week 1\'!$E$43:$E$47, B' . $row . ', \'Week 1\'!$J$43:$J$47) +
                    // SUMIF(\'Week 2\'!$E$43:$E$47, B' . $row . ', \'Week 2\'!$J$43:$J$47) +
                    // SUMIF(\'Week 3\'!$E$43:$E$47, B' . $row . ', \'Week 3\'!$J$43:$J$47) +
                    // SUMIF(\'Week 4\'!$E$43:$E$47, B' . $row . ', \'Week 4\'!$J$43:$J$47) +
                    // SUMIF(\'Week 5\'!$E$43:$E$47, B' . $row . ', \'Week 5\'!$J$43:$J$47)';
                    // $event->sheet->setCellValue('G' . $row, $formulaG);


                    // $formulaH = '=SUMIF(\'Week 1\'!$E$43:$E$47, B' . $row . ', \'Week 1\'!$K$43:$K$47) + 
                    // SUMIF(\'Week 2\'!$E$43:$E$47, B' . $row . ', \'Week 2\'!$K$43:$K$47) + 
                    // SUMIF(\'Week 3\'!$E$43:$E$47, B' . $row . ', \'Week 3\'!$K$43:$K$47) + 
                    // SUMIF(\'Week 4\'!$E$43:$E$47, B' . $row . ', \'Week 4\'!$K$43:$K$47) + 
                    // SUMIF(\'Week 5\'!$E$43:$E$47, B' . $row . ', \'Week 5\'!$K$43:$K$47)';
                    // $event->sheet->setCellValue('H' . $row, $formulaH);

                    // Inisialisasi rumus awal

                    
                    $formulaD = '';
                    $formulaE = '';
                    $formulaG = '';
                    $formulaH = '';
                    
                    // Loop untuk setiap minggu
                    for ($week = 1; $week <= 5; $week++) {
                        // Bangun bagian rumus untuk kolom D (misalnya, kolom H)
                        $formulaD .= 'SUMIF(\'Week ' . $week . '\'!$AA$9:$AA$99, B' . $row . ', \'Week ' . $week . '\'!$AD$9:$AD$99) + ';
                    
                        // Bangun bagian rumus untuk kolom E (misalnya, kolom I)
                        $formulaE .= 'SUMIF(\'Week ' . $week . '\'!$AA$9:$AA$99, B' . $row . ', \'Week ' . $week . '\'!$AE$9:$AE$99) + ';
                    
                        // Bangun bagian rumus untuk kolom G (misalnya, kolom J)
                        $formulaG .= 'SUMIF(\'Week ' . $week . '\'!$AA$9:$AA$99, B' . $row . ', \'Week ' . $week . '\'!$AF$9:$AF$99) + ';
                        
                        // Bangun bagian rumus untuk kolom H (misalnya, kolom K)
                        $formulaH .= 'SUMIF(\'Week ' . $week . '\'!$AA$9:$AA$99, B' . $row . ', \'Week ' . $week . '\'!$AG$9:$AG$99) + ';
                    }
                    
                    // Hapus tanda tambah ekstra di akhir rumus
                    $formulaD = rtrim($formulaD, ' + ');
                    $formulaE = rtrim($formulaE, ' + ');
                    $formulaG = rtrim($formulaG, ' + ');
                    $formulaH = rtrim($formulaH, ' + ');
                    
                    // Set rumus untuk kolom D, E, G, dan H
                    $event->sheet->setCellValue('D' . $row, '=' . $formulaD);
                    $event->sheet->setCellValue('E' . $row, '=' . $formulaE);
                    $event->sheet->setCellValue('G' . $row, '=' . $formulaG);
                    $event->sheet->setCellValue('H' . $row, '=' . $formulaH);
                    

                    
                    // $formulaI = '=H' . $row . '+G' . $row;
                    // $event->sheet->setCellValue('I' . $row, $formulaI);  
                    // $event->sheet->setCellValue('I' . $row, '=F' . $row . '+ G' . $row . '+ H' . $row );


                   
                
                    
             
                    // $formulaD = '=\'Week 1\'!H43+\'Week 2\'!H43+\'Week 3\'!H43+\'Week 4\'!H43+\'Week 5\'!H43';
                    // $event->sheet->setCellValue('D' . $row, $formulaD);
                    // $formulaF = '=IF((1/173*3500000*D' . $row .') + (1/173*3500000*E' . $row . '*$E$7)<>0, (1/173*3500000*D' . $row . ') + (1/173*3500000*E' . $row . '*$E$7), "-")';
                    // $event->sheet->setCellValue('F' . $row, $formulaF);   
                    
                    $event->sheet->setCellValue('F' . $row, '=IF((1/173*3500000*D' . $row . ') + (1/173*3500000*E' . $row . '*$E$7) <> 0, (1/173*3500000*D' . $row . ') + (1/173*3500000*E' . $row . '*$E$7), "0")');
            

                    $formulaI = '=F' . $row . '+G' . $row . '+H' . $row;
                    $event->sheet->setCellValue('I' . $row , $formulaI);
                    $event->sheet->setCellValue('D13', '=IF(SUM(D8:D12)<>0, SUM(D8:D12), "0")');
                    $event->sheet->setCellValue('E13', '=IF(SUM(E8:E12)<>0, SUM(E8:E12), "0")');
                    $event->sheet->setCellValue('F13', '=IF(SUM(F8:F12)<>0, SUM(F8:F12), "0")');
                    $event->sheet->setCellValue('G13', '=IF(SUM(G8:G12)<>0, SUM(G8:G12), "0")');
                    $event->sheet->setCellValue('H13', '=IF(SUM(H8:H12)<>0, SUM(H8:H12), "0")');
                    $event->sheet->setCellValue('I13', '=IF(SUM(I8:I12)<>0, SUM(I8:I12), "0")');
                    $event->sheet->setCellValue('J13', '=IF(SUM(J8:J12)<>0, SUM(J8:J12), "0")');
                    $event->sheet->setCellValue('K13', '=IF(SUM(K8:K12)<>0, SUM(K8:K12), "0")');

                    $event->sheet->setCellValue('E17', '=F13');
                    $event->sheet->setCellValue('E18', '=G13+H13');
                    $event->sheet->setCellValue('E19', '=IF(SUM(E17:E18)<>0, SUM(E17:E18), "0")');
                    

                    $row++;
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
                $event->sheet->getStyle('A6:L7')->applyFromArray($headerStyleArray);

                $title = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->getStyle('A2:W6')->applyFromArray($title);

                // $bodyStyle = [
                //     // 'borders' => [
                //     //     'allBorders' => [
                //     //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                //     //     ],
                //     // ],
                //     'alignment' => [
                //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                //         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                //     ],
                // ];

                // $event->sheet->getStyle('A8:L10' . $row)->applyFromArray($bodyStyle);


            }
        ];
    }
}
