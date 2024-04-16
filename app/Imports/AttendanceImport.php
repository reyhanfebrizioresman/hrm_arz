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
        // dd(Carbon::parse($row['clock_in'])->toTimeString());

        $formattedDate = date('Y-m-d', strtotime($row['date']));
        
        $overtime = 0;
        $late = 0;
        
        
        $clockIn = $this->transformDate($row['clock_in']);
        $clockOut = $this->transformDate($row['clock_out']);
        $defaultStartTime = date('1970-01-01 H:i:s',strtotime('07:00:00'));
        $defaultEndTime = date('1970-01-01 H:i:s',strtotime('17:00:00')); 
        $late = Carbon::parse($clockIn)->diffInMinutes($defaultStartTime);
        $overtime = Carbon::parse($clockOut)->diffInMinutes($defaultEndTime);
 
        if($clockIn < $defaultStartTime){
            $late = 0;
        }

        if($clockOut < $defaultEndTime){
            $overtime = 0;
        }
        $status = $row['status'];


        if($status == null){
            $status = 'hadir';
        }
        
        return new Attendance([
            'employee_id' => intval($row['employee_id']),
            'status' => $status,
            'date' =>  $formattedDate,
            'clock_in' => $this->transformDate($row['clock_in']),
            'clock_out' => $this->transformDate($row['clock_out']),
            'late' => $late * -1,
            'overtime' => $overtime * -1,
        ]);
    }
}
