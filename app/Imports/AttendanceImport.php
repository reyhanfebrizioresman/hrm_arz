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
        
       
        
        $clockIn = !empty($row['clock_in']) ? $this->transformDate($row['clock_in']) : null;
        $clockOut =  !empty($row['clock_out']) ? $this->transformDate($row['clock_out']) : null;
        $defaultStartTime = date('1970-01-01 H:i:s',strtotime('08:00:00'));
        $defaultEndTime = date('1970-01-01 H:i:s',strtotime('17:00:00')); 
        $late = 0;
        $overtime = 0;
        
        if ($clockIn) {
            if ($clockIn->greaterThan($defaultStartTime)) {
                $late = $clockIn->diffInMinutes($defaultStartTime);
            }
        }
        
        if ($clockOut) {
            if ($clockOut->greaterThan($defaultEndTime)) {
                $overtime = $clockOut->diffInMinutes($defaultEndTime);
            }
        }
        $attendance =  Attendance::create([
            'employee_id' => intval($row['employee_id']),
            'status' => $row['status'] ?? 'hadir',
            'date' =>  $formattedDate,
            'clock_in' => $clockIn ? $clockIn->format('H:i') : '00:00',
            'clock_out' => $clockOut ? $clockOut->format('H:i') : '00:00',
            'late' => abs($late) ,
            'overtime' => abs($overtime),
        // dd(abs($overtime),abs($late)),

        ]);
        // dd($attendance);
    }
}
