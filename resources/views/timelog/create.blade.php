@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Log Time Entry</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('timelog.store') }}" method="POST">
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
            <label for="log_date">Log Date:</label>
            <input type="date" name="log_date" id="log_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hours_worked">Hours Worked:</label>
            <input type="number" step="0.1" name="hours_worked" id="hours_worked" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Log Time</button>
    </form>
</div>
@endsection
