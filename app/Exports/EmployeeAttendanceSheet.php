<?php

namespace App\Exports;

use App\Models\EmployeeModel;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EmployeeAttendanceSheet implements WithTitle, WithEvents
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

    // public function collection()
    // {
    //     $attendances = Attendance::where('employee_id', $this->employee->id)->get();

    //     $attendanceData = [];
    //     foreach ($attendances as $attendance) {
    //         $attendanceData[] = [
    //             'Tanggal' => 'Tanggal',
    //             'In' => $attendance->clock_in,
    //             'Out' => $attendance->clock_out,
    //             'Jam Puasa' => '', // Sesuaikan dengan atribut yang sesuai
    //             'eza' => '', // Sesuaikan dengan atribut yang sesuai
    //             'Ket' => '', // Sesuaikan dengan atribut yang sesuai
    //         ];
    //     }

    //     return collect($attendanceData);
    // }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event)
            {
                $event->sheet->mergeCells('A1:A2');
                $event->sheet->mergeCells('B1:C1');
                $event->sheet->mergeCells('D1:E1');
                $event->sheet->mergeCells('D2:E2');


                $event->sheet->setCellValue('A1','Tanggal');
                $event->sheet->setCellValue('B1','Jam');
                $event->sheet->setCellValue('B2','In');
                $event->sheet->setCellValue('C2','Out');
                $event->sheet->setCellValue('D1', $this->employee->name);
                $event->sheet->setCellValue('D2','Ket');

         // Mendapatkan data absensi untuk setiap bulan
        $currentMonth = Carbon::now()->startOfMonth()->subDays(5); // Mulai dari tanggal 25 bulan sebelumnya
        $endOfMonth = Carbon::now()->endOfMonth();

        while ($currentMonth->lte($endOfMonth)) {
            // Tentukan tanggal awal dan akhir bulan
            $startDate = $currentMonth->copy()->startOfMonth();
            $endDate = $currentMonth->copy()->endOfMonth();

            // Inisialisasi struktur data untuk menyimpan entri absensi unik
            $uniqueAttendances = [];

            // Ambil data absensi untuk bulan ini
            foreach ($this->employee->attendances as $attendance) {
                $attendanceDate = Carbon::parse($attendance->date);

                // Cek apakah entri untuk tanggal tersebut sudah ada dalam struktur data unik
                $attendanceDateString = $attendanceDate->toDateString();
                if (!isset($uniqueAttendances[$attendanceDateString])) {
                    // Jika belum, tambahkan entri tersebut ke dalam struktur data unik
                    $uniqueAttendances[$attendanceDateString] = $attendance;
                }
            }

            $row = 3; // Mulai menulis dari baris ke-3
            foreach ($uniqueAttendances as $attendance) {
                $event->sheet->setCellValue('A' . $row, date('d D', strtotime($attendance->date)));
                $event->sheet->setCellValue('B' . $row, date('H:i', strtotime($attendance->clock_in)));
                $event->sheet->setCellValue('C' . $row, date('H:i', strtotime($attendance->clock_out)));
                $event->sheet->setCellValue('D' . $row, $attendance->note);
                $row++; // Pindah ke baris berikutnya
            }

            // Pindah ke bulan berikutnya
            $currentMonth->addMonth();
        }


                // $row = 3; // Mulai menulis dari baris ke-3
                // foreach ($this->employee->attendances as $attendance) {
                //     $event->sheet->setCellValue('A' . $row, date('m D', strtotime($attendance->date)));
                //     $event->sheet->setCellValue('B' . $row, date('H:i', strtotime($attendance->clock_in)));
                //     $event->sheet->setCellValue('C' . $row, date('H:i', strtotime($attendance->clock_out)));
                //     $event->sheet->setCellValue('E' . $row, $attendance->note);
                //     $row++; // Pindah ke baris berikutnya
                // }
        

                 //DEFINISIKAN STYLE UNTUK CELL
                 //DEFINISIKAN STYLE UNTUK CELL HEADER
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
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '00FFFF', // Warna biru
                ],
            ],
        ];

        // Set style untuk header (baris pertama)
        $event->sheet->getStyle('A1:E2')->applyFromArray($headerStyleArray);

        // Set style untuk garis tabel (selain header)
        $borderStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        // Set style untuk sel-sel nilai (baris kedua ke atas)
        $event->sheet->getStyle('A3:E3' . $row)->applyFromArray($borderStyleArray);
    }
];
    }

    public function view() : View
    {
        // $startDate = Carbon::now()->subDays(7)->startOfWeek();
        // $endDate = Carbon::now()->subDays(1)->endOfWeek();
        
        // $employees = EmployeeModel::with(['attendance' => function($query) {
        //     // Menampilkan data kehadiran dalam rentang tanggal 1 minggu terakhir
        //     // $query->whereBetween('date', [$startDate, $endDate]);
        // }])->get();

        return view('attendance.viewExport',[
            'employees' => $this->employee
        ]);
    }
    
}
