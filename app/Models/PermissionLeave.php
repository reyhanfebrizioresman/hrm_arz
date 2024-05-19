<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EmployeeModel;


class PermissionLeave extends Model
{
    use HasFactory;

    protected $table = 'permission_leaves';
    protected $fillable = ['employee_id' ,'status', 'date','date_time_of','picture','notes','status_submission'];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class);
    }
}