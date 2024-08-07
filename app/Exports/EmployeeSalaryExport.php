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
    // protected $employees;
    protected $startDate;
    protected $endDate;

    public function __construct($employees,$startDate,$endDate)
    {
        // $this->employees = $employees;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function sheets(): array
{
    $sheets = [];

    $startDate = Carbon::create($this->startDate)->startOfDay();
    $endDate = Carbon::create($this->endDate)->endOfDay();

    $currentDate = $startDate->copy();
    $weekNumber = 1;

    while ($currentDate->lte($endDate)) {
        // Tentukan tanggal awal dan akhir minggu
        $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $currentDate->copy()->endOfWeek(Carbon::FRIDAY);

        if ($startOfWeek->lt($startDate)) {
            $startOfWeek = $startDate;
        }

        // Pastikan endOfWeek tidak melewati endDate
        if ($endOfWeek->gt($endDate)) {
            $endOfWeek = $endDate;
        }
        // dd($startOfWeek, $endOfWeek);

        // Ambil data employee bersama dengan data kehadiran untuk minggu ini
        $employees = EmployeeModel::with(['attendances' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereIn('id', function($subQuery) use ($startOfWeek, $endOfWeek) {
                $subQuery->selectRaw('MAX(id)')
                         ->from('attendance')
                         ->whereBetween('date', [$startOfWeek, $endOfWeek])
                         ->groupBy('employee_id', 'date');
            });
        }, 'salaryComponents', 'careerHistories.department'])
        ->get();

        // Buat instance dari kelas Export untuk minggu ini
        $sheet = new EmployeeSalarySheet($employees,$startOfWeek, $endOfWeek,$startDate,$endDate);


        // Tambahkan sheet ke dalam array
        $sheets['Week' . $weekNumber++] = $sheet;

        // Pindahkan ke minggu berikutnya
        $currentDate->addWeek();
        // dd($currentDate);

        // $weekNumber++;
    }

    $datas = EmployeeModel::with('careerHistories.department')->get();


    
    $resultSheet = new ResultSheet($datas);
    $sheets['result'] = $resultSheet;

    return $sheets;
}

}
