<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLeave extends Model
{
    use HasFactory;

    protected $fillable = ['name','maximum_leaves'];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
