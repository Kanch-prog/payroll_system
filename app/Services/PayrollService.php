<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\TimeLog;
use App\Models\Payroll;

class PayrollService
{
    public function processPayroll(Employee $employee, $payPeriodStart, $payPeriodEnd)
    {
        // Calculate gross salary
        $grossSalary = $this->calculateGrossSalary($employee, $payPeriodStart, $payPeriodEnd);

        // Calculate deductions (taxes, benefits, etc.)
        $deductions = $this->calculateDeductions($grossSalary);

        // Calculate net salary
        $netSalary = $grossSalary - $deductions;

        // Save the payroll record to the payrolls table
        $payroll = Payroll::create([
            'employee_id' => $employee->id,
            'pay_period_start' => $payPeriodStart,
            'pay_period_end' => $payPeriodEnd,
            'gross_salary' => $grossSalary,
            'taxes' => $deductions,
            'net_salary' => $netSalary,
        ]);

        return [
            'gross_salary' => $grossSalary,
            'deductions' => $deductions,
            'net_salary' => $netSalary,
        ];
    }

    protected function calculateGrossSalary(Employee $employee, $payPeriodStart, $payPeriodEnd)
    {

        $employee->hourly_rate = 15.00; // Replace with actual retrieval logic
        // Example: Calculate total hours worked during the pay period
        $totalHoursWorked = $this->calculateHoursWorked($employee, $payPeriodStart, $payPeriodEnd);

        // Calculate gross salary (hourly rate * total hours worked)
        $grossSalary = $employee->hourly_rate * $totalHoursWorked;

        return $grossSalary;
    }

    
    protected function calculateHoursWorked(Employee $employee, $payPeriodStart, $payPeriodEnd)
    {
        // Initialize total hours worked
        $totalHoursWorked = 0;

        // Iterate through each day in the pay period
        $currentDate = $payPeriodStart;
        while ($currentDate <= $payPeriodEnd) {
            // Query TimeLog for hours worked on $currentDate
            $hoursWorked = TimeLog::where('employee_id', $employee->id)
                ->whereDate('log_date', $currentDate)
                ->sum('hours_worked');

            // Debugging output
            // echo "Date: $currentDate, Hours Worked: $hoursWorked<br>";

            // Add to total hours worked
            $totalHoursWorked += $hoursWorked;

            // Move to the next day
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        return $totalHoursWorked;
    }


    protected function calculateDeductions($grossSalary)
    {
        // Example deduction calculation (e.g., 20% flat tax rate)
        $taxRate = 0.2;
        $deductions = $grossSalary * $taxRate;

        return $deductions;
    }
}
