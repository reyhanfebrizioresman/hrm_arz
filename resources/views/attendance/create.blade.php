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
                <label for="employee_id">Employee ID:</label>
                <input type="text" class="form-control" id="employee_id" name="employee_id">
            </div>
            <div class="form-group">
                <label for="employee_name">Employee Name:</label>
                <input type="text" class="form-control" id="employee_name" name="employee_name">
            </div>
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
                <input type="text" class="form-control" id="clock_in" name="clock_in">
            </div>
            <div class="form-group">
                <label for="clock_out">Clock Out:</label>
                <input type="text" class="form-control" id="clock_out" name="clock_out">
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" class="form-control" id="date" name="date">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


@endsection
