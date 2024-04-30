<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\EmployeeModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class EmployeeSalaryExport implements WithMultipleSheets
{
    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function sheets(): array
{
    $sheets = [];

    $startDate = Carbon::create(2024, 3, 26)->startOfDay();
    $endDate = Carbon::create(2024, 4, 25)->endOfDay();

    $currentDate = $startDate->copy();

    while ($currentDate->lte($endDate)) {
        // Tentukan tanggal awal dan akhir minggu
        $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $currentDate->copy()->endOfWeek(Carbon::FRIDAY);

        // Ambil data employee bersama dengan data kehadiran untuk minggu ini
        $employees = EmployeeModel::with(['attendances' => function ($query) use ($startOfWeek, $endOfWeek) {
            // Filter kehadiran berdasarkan rentang tanggal
            $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
        }, 'salaryComponents', 'careerHistories.department'])
        ->get();

        // Buat instance dari kelas Export untuk minggu ini
        $sheet = new EmployeeSalarySheet($employees,$startOfWeek, $endOfWeek);


        // Tambahkan sheet ke dalam array
        $sheets[] = $sheet;

        // Pindahkan ke minggu berikutnya
        $currentDate->addWeek();
    }

    return $sheets;
}

}
