<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address', 'phone','hire_date' , 'hourly_rate', 'gross_salary'];

    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }
}
