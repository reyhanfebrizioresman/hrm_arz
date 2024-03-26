<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Collection;

class AttendanceExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $employees;
    protected $startDate;
    protected $endDate;

    public function __construct($employees, $startDate, $endDate)
    {
        $this->employees = $employees;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return $this->employees->flatMap(function ($employee) {
            return $employee->attendances()->whereBetween('date', [$this->startDate, $this->endDate])->get()->map(function ($attendance) use ($employee) {
                return [
                    'Employee ID' => $employee->id,
                    'Employee Name' => $employee->name,
                    'Status' => '',
                    'Overtime' => '',
                    'Clock In' => '',
                    'Clock Out' => '',
                    'Date' => '',
                ];
            });
        });
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Status',
            'Overtime',
            'Clock In',
            'Clock Out',
            'Date',
        ];
    }
}
