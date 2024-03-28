<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function transformDate($value, $format = 'Y-m-d')
    {
    try {
        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    } catch (\ErrorException $e) {
        return \Carbon\Carbon::createFromFormat($format, $value);
    }
    }

    public function model(array $row)
    {
        $formattedDate = date('Y-m-d', strtotime($row['date']));
        // $clockIn = date('H:i S', strtotime($row['clock_in']));
        // $clockOut = date('H:i S', strtotime($row['clock_out']));
        // $clockIn = Carbon::createFromFormat('H:i:s', $row['clock_in'])->toDateTimeString();
        // $clockOut = Carbon::createFromFormat('H:i:s', $row['clock_out'])->toDateTimeString();

        return new Attendance([
            'employee_id' => intval($row['employee_id']),
            'employee_name' => $row['employee_name'],
            'date' =>  $formattedDate,
            'clock_in' => $this->transformDate($row['clock_in']),
            'clock_out' => $this->transformDate($row['clock_out']),
        ]);
    }
}
