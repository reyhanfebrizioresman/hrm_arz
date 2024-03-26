<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendance";
    protected $fillable = ['employee_id', 'status', 'overtime', 'clock_in', 'clock_out', 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
