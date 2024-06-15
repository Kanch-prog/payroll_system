@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Payroll Summary</h1>
    <h3>Employee: {{ $employee->name }}</h3>
    <p>Pay Period: {{ $payPeriodStart }} to {{ $payPeriodEnd }}</p>
    <p>Gross Salary: ${{ number_format($grossSalary, 2) }}</p>
    <p>Taxes: ${{ number_format($taxes, 2) }}</p>
    <p>Net Salary: ${{ number_format($netSalary, 2) }}</p>
</div>
@endsection
