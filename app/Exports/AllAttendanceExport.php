<?php

namespace App\Exports;

use App\Models\EmployeeModel;
use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllAttendanceExport implements FromView,WithMultipleSheets,ShouldAutoSize
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

    public function view() : View
    {
        $sheets = [];

        foreach ($this->employees as $employee) {
            $sheets[] = new EmployeeAttendanceSheet($employee);
        }
        return view('attendance.viewExport',compact('sheets'));
    }

}



