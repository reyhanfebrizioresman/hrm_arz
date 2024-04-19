<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeModel;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salary_component';
    protected $fillable = ['name','category'];

    public function employees()
    {
        return $this->belongsToMany(EmployeeModel::class, 'employee_salary_component','employee_id','salary_component_id','amount');
    }
}
