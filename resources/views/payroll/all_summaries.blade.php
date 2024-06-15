<!-- resources/views/payroll/all_summaries.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Payroll Summary for All Employees</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Gross Salary</th>
                <th>Taxes</th>
                <th>Net Salary</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrollSummaries as $summary)
                <tr>
                    <td>{{ $summary['employee']->name }}</td>
                    <td>${{ number_format($summary['grossSalary'], 2) }}</td>
                    <td>${{ number_format($summary['taxes'], 2) }}</td>
                    <td>${{ number_format($summary['netSalary'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
