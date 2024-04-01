<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = "shifts";
    protected $fillable = [
        'name',
        'day',
        'start_time',
        'end_time',
        'break_start',
        'break_end',
        'shift',
        'late_tolerance',
        'early_leave_tolerance',
    ];
}
