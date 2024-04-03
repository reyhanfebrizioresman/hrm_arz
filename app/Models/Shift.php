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
        'monday', 'monday_start_time', 'monday_end_time', 'monday_break_start', 'monday_break_end', 'monday_late_tolerance', 'monday_early_leave_tolerance',
        'tuesday', 'tuesday_start_time', 'tuesday_end_time', 'tuesday_break_start', 'tuesday_break_end', 'tuesday_late_tolerance', 'tuesday_early_leave_tolerance',
        'wednesday', 'wednesday_start_time', 'wednesday_end_time', 'wednesday_break_start', 'wednesday_break_end', 'wednesday_late_tolerance', 'wednesday_early_leave_tolerance',
        'thursday', 'thursday_start_time', 'thursday_end_time', 'thursday_break_start', 'thursday_break_end', 'thursday_late_tolerance', 'thursday_early_leave_tolerance',
        'friday', 'friday_start_time', 'friday_end_time', 'friday_break_start', 'friday_break_end', 'friday_late_tolerance', 'friday_early_leave_tolerance',
        'saturday', 'saturday_start_time', 'saturday_end_time', 'saturday_break_start', 'saturday_break_end', 'saturday_late_tolerance', 'saturday_early_leave_tolerance',
        'sunday', 'sunday_start_time', 'sunday_end_time', 'sunday_break_start', 'sunday_break_end', 'sunday_late_tolerance', 'sunday_early_leave_tolerance',
    ];

    public function employees()
    {
        return $this->belongsToMany(EmployeeModel::class);
    }
}
