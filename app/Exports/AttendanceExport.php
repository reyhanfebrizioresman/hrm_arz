<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class AttendanceExport implements FromCollection, WithHeadings, WithTitle
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
        $data = [];
        
        foreach ($this->employees as $employee) {
            // $attendances = $employee->attendances()
            //     ->whereBetween('date', [$this->startDate, $this->endDate])
            //     ->get();
            $employeeId = (int) $employee->id;
            $attendances_dates = [$this->startDate, $this->endDate]; 
            $startDate = Carbon::parse($this->startDate);
            $endDate = Carbon::parse($this->endDate);
            $dateRange = $startDate->toPeriod($endDate);

            foreach ($dateRange as $date) {
                $data[] = [
                    'employee_id' => $employeeId,
                    'employee_name' => $employee->name,
                    'status' => '',
                    'date' => $date->format('Y-m-d'),
                    'check_in' => '',
                    'check_out' => '',
                    'late' => '',
                    'overtime' => '',
                    'overtime_note' => '',
                ];
            }
        }

        return collect($data);
    }

    public function title(): string
    {
        return 'Absensi';
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Status',
            'Date',
            'Clock In',
            'Clock Out',
            'Late',
            'Overtime',
            'Overtime Note',
        ];
    }
}
