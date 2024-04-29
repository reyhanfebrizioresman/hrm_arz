<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CareerHistory;
use App\Models\Shift;
use App\Models\Salary;


class EmployeeModel extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'identity_no',
        'emergency_number',
        'gender',
        'city',
        'religion',
        'date_of_birth',
        'place_of_birth',
        'address',
        'status',
        'marital_status',
        'employment_status',
        'picture',
        'joining_date',
        'exit_date',
        'ptkp',
    ];

    public function careerHistories()
    {
        return $this->hasMany(CareerHistory::class, 'employee_id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }
    public function shifts()
    {
        return $this->belongsToMany(Shift::class,'employee_shift', 'employee_id','shift_id');
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'employee_id');
    }

    public function careerHistorie()
    {
        return $this->hasOne(CareerHistory::class, 'employee_id');
    }

    public function salaryComponents()
    {
        return $this->belongsToMany(Salary::class, 'employee_salary_component', 'employee_id','salary_component_id')->withPivot('amount');
    }

    public function latestSalaryDate()
    {
        // Ambil tanggal gaji terbaru menggunakan relasi
        $latestSalary = $this->salaryComponents()->latest()->first();

        // Periksa jika gaji terbaru ditemukan
        if ($latestSalary) {
            return $latestSalary->created_at;
        }

        // Jika tidak ada gaji yang ditemukan, kembalikan nilai null atau sesuai kebutuhan Anda
        return null;
    }
}
