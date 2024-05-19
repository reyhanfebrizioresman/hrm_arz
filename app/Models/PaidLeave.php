<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeModel;
use App\Models\CategoryLeave;


class PaidLeave extends Model
{
    use HasFactory;

    protected $table = 'paid_leaves';
    protected $fillable = ['employee_id' ,'categories_id','status', 'date','date_time_of','notes','status_submission'];


    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class);
    }

    public function categories()
    {
        return $this->belongsTo(CategoryLeave::class);
    }
}
