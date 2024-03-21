<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeModel;
use App\Models\Department;
use App\Models\Positon;

class CareerHistory extends Model
{
    use HasFactory;

    protected $table = 'career_history';
    protected $fillable = ['position_id','department_id','employee_id','date'];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
