<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CareerHistory;

class Position extends Model
{
    use HasFactory;
    protected $table = 'position';
    protected $fillable = ['job_position'];

    public function careerHistories()
    {
        return $this->hasMany(CareerHistory::class);
    }
}
