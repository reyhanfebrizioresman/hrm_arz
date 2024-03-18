<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CareerHistory;


class EmployeeModel extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'identity_no',
        'gender',
        'city',
        'date_of_birth',
        'address',
        'marital_status',
        'employment_status',
        'picture',
        'joining_date',
        'exit_date',
    ];

    public function careerHistories()
    {
        return $this->hasMany(CareerHistory::class);
    }
}
