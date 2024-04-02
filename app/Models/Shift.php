<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeModel;

class Shift extends Model
{
    use HasFactory;

    protected $table = "shifts";
    protected $fillable = [
        'name',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'start_time',
        'end_time',
        'break_start',
        'break_end',
        'shift',
        'late_tolerance',
        'early_leave_tolerance',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
