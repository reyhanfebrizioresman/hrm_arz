<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeModel;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendance";
    protected $fillable = ['employee_id','employee_name', 'status', 'overtime','late', 'clock_in', 'clock_out', 'date'];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class);
    }
    public function calculateOvertime()
    {
        // Ubah waktu ke format Carbon untuk memudahkan perhitungan
        $clockIn = Carbon::parse($this->clock_in);
        $clockOut = Carbon::parse($this->clock_out);

        // Hitung perbedaan waktu dalam menit
        $diffInMinutes = $clockOut->diffInMinutes($clockIn);

        // Atur ambang batas untuk lembur (misalnya, 8 jam)
        $thresholdMinutes = 8 * 60;

        // Hitung lembur jika melebihi ambang batas
        if ($diffInMinutes > $thresholdMinutes) {
            $overtimeMinutes = $diffInMinutes - $thresholdMinutes;

            // Konversi menit lembur ke jam dan menit
            $overtimeHours = floor($overtimeMinutes / 60);
            $overtimeMinutes %= 60;

            return [
                'hours' => $overtimeHours,
                'minutes' => $overtimeMinutes
            ];
        } else {
            return ['hours' => 0, 'minutes' => 0];
        }
    }
}
