<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeModel;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendance";
    protected $fillable = ['employee_id', 'status', 'overtime','late', 'clock_in', 'clock_out', 'date'];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class);
    }

public function calculateLateAndOvertime($clockIn, $clockOut)
{
    //memberi nilai default untuk masuk dan pulang
    $defaultStartTime = strtotime('07:00:00');
    $defaultEndTime = strtotime('17:00:00');
    
    // Waktu clock_in dan clock_out dalam format UNIX timestamp\
    $clockInTime = strtotime($clockIn);
    $clockOutTime = strtotime($clockOut);

    // Inisialisasi late dan overtime
    $late = 0;
    $overtime = 0;

    // Hitung late jika clock_in terlambat
    if($clockInTime > $defaultStartTime){
        $late = $clockInTime - $defaultStartTime;
    }

    //menghitung overtime
    if($clockOutTime > $defaultEndTime){
        $overtime = $clockOutTime - $defaultEndTime;
    }

    // Konversi late dan overtime ke menit
    $late = round($late / 60);
    $overtime = round($overtime / 60);

    return [
        'late' => $late,
        'overtime' => $overtime
    ];
}

}
