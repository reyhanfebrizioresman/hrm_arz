<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $formattedDate = date('Y-m-d', strtotime($row[2]));
        $clockIn = date('H:i:s', strtotime($row[3]));
        $clockOut = date('H:i:s', strtotime($row[4]));

        return new Attendance([
            'employee_id' => intval($row[0]),
            'employee_name' => $row[1],
            'date' =>  $formattedDate,
            'clock_in' => $clockIn,
            'clock_out' => $clockOut,
        ]);
    }
}
