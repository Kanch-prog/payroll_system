<!-- resources/views/payroll/process.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Process Payroll</div>

                    <div class="card-body">
                    <form action="{{ route('payroll.process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">Employee:</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pay_period_start">Pay Period Start:</label>
                            <input type="date" name="pay_period_start" id="pay_period_start" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pay_period_end">Pay Period End:</label>
                            <input type="date" name="pay_period_end" id="pay_period_end" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Process Payroll</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
