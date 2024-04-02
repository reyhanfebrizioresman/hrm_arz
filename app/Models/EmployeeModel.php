<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CareerHistory;
use App\Models\Shift;


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
        return $this->belongsToMany(Shift::class);
    }
}
