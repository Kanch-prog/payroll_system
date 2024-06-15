<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\PayrollService;

class PayrollController extends Controller
{
    protected $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    public function showPayrollForm()
    {
        $employees = Employee::all();
        return view('payroll.form', ['employees' => $employees]);
    }

    public function processPayroll(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'pay_period_start' => 'required|date',
            'pay_period_end' => 'required|date|after_or_equal:pay_period_start',
        ]);

        // Retrieve employee
        $employee = Employee::findOrFail($request->employee_id);
        

        // Process payroll using PayrollService
        $payrollDetails = $this->payrollService->processPayroll($employee, $request->pay_period_start, $request->pay_period_end);

        // Redirect or show success message
        //return redirect()->route('payroll.showForm')->with('success', 'Payroll processed successfully!');
        // Pass necessary data to the view
        return view('payroll.summary', [
            'employee' => $employee,
            'payPeriodStart' => $request->pay_period_start,
            'payPeriodEnd' => $request->pay_period_end,
            'grossSalary' => $payrollDetails['gross_salary'],
            'taxes' => $payrollDetails['deductions'],
            'netSalary' => $payrollDetails['net_salary'],
        ]);

    }


    public function viewPayrollSummary()
    {
        $employees = Employee::all();

        $payrollSummaries = $employees->map(function ($employee) {
            $payrollDetails = $this->payrollService->processPayroll($employee, '2024-06-01', '2024-06-30'); // Example period

            return [
                'employee' => $employee,
                'grossSalary' => $payrollDetails['gross_salary'],
                'taxes' => $payrollDetails['deductions'],
                'netSalary' => $payrollDetails['net_salary'],
            ];
        });

        return view('payroll.all_summaries', compact('payrollSummaries'));
    }
}
