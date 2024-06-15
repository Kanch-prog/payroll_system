<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\TimeLog;

class TimeLogController extends Controller
{
    public function create()
    {
        $employees = Employee::all();
        return view('timelog.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'log_date' => 'required|date',
            'hours_worked' => 'required|numeric|min:0|max:24',
        ]);

        TimeLog::create([
            'employee_id' => $request->employee_id,
            'log_date' => $request->log_date,
            'hours_worked' => $request->hours_worked,
        ]);

        return redirect()->route('timelog.create')->with('success', 'Time log entry created successfully.');
    }
}
