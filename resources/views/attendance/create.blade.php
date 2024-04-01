@extends('layouts.template')
@section('title','DasHboard')
@section('sub-judul','Departemen')
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Input Kehadiran</h5>
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="employee_id">Employee Name:</label>
                <select class="form-control" name="employee_id" id="employee_id">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="employee_name">Employee Name:</label>
                <input type="text" class="form-control" id="employee_name" name="employee_name"  value="{{ $employee->name }}">
                <select class="form-control" name="employee_name" id="employee_name">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control" id="status" name="status">
            </div>
            <div class="form-group">
                <label for="overtime">Overtime:</label>
                <input type="text" class="form-control" id="overtime" name="overtime">
            </div>
            <div class="form-group">
                <label for="clock_in">Clock In:</label>
                <input type="time" class="form-control" id="clock_in" name="clock_in">
            </div>
            <div class="form-group">
                <label for="clock_out">Clock Out:</label>
                <input type="time" class="form-control" id="clock_out" name="clock_out">
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('employee_id').addEventListener('change', function() {
        var selectedId = this.value;
        var employeeNameInput = document.getElementById('employee_name');
        var employeeName = document.querySelector('#employee_id option:checked').text;

        employeeNameInput.value = employeeName;
    });
</script>


@endsection
