<?php

namespace App\Exports;

use App\Models\EmployeeModel;
use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllAttendanceExport implements WithMultipleSheets
{
    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->employees as $employee) {
            $sheets[] = new EmployeeAttendanceSheet($employee);
        }

        return $sheets;
    }

}



