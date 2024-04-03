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
        
        $overtime = 0;
        $late = 0;
        

        $clockIn = strtotime($row['clock_in']);
        $clockOut = strtotime($row['clock_out']);
        $defaultStartTime = strtotime('07:00:00');
        $defaultEndTime = strtotime('17:00:00'); 
        // return dd($clockIn,$clockOut);


        if($clockIn > $defaultStartTime){
            $late = $clockIn - $defaultStartTime;
        }

        if ($clockOut > $defaultEndTime) {
            $overtime = $clockOut - $defaultEndTime;
        }
        $late = round($late / 60);
        $overtime = round($overtime / 60);
        $maxLateAllowed = 480; // Misalnya, nilai maksimum yang diperbolehkan adalah 8 jam (480 menit)

        // Pastikan nilai late tidak melebihi nilai maksimum yang diperbolehkan
        $late = min($late, $maxLateAllowed);
        $overtime = min($overtime, $maxLateAllowed);

        return new Attendance([
            'employee_id' => intval($row['employee_id']),
            'date' =>  $formattedDate,
            'clock_in' => $this->transformDate($row['clock_in']),
            'clock_out' => $this->transformDate($row['clock_out']),
            'late' => $late,
            'overtime' => $overtime,
        ]);
    }
}
