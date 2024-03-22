@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Karir Histori')
@section('content')
    <form action="{{ route('carieerHistory.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="employee_id">Employee:</label>
        <select class="form-control" name="employee_id" id="employee_id">
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="position_id">Position:</label>
        <select class="form-control" name="position_id" id="position_id">
            @foreach($positions as $position)
                <option value="{{ $position->id }}">{{ $position->job_position }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="department_id">Department:</label>
        <select class="form-control" name="department_id" id="department_id">
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" name="date" id="date">
    </div>

    <button type="submit" class="btn btn-primary mt-1">Submit</button>
</form>


@endsection

