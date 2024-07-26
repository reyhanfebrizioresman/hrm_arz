<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payrolls';
    protected $fillable = ['employee_id','position','period','basic_salary','overtime_pay','late_pay','total_pay'];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class);
    }
}
