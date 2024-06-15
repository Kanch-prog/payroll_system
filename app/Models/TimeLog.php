<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'log_date', 'hours_worked'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
