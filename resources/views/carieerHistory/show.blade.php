@extends('layouts.template')
@section('title','Dasbhoard')
@section('sub-judul','Menu Utama')
@section('content')
<form action="{{ route('carieerHistory.update', $careerHistory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="employee_id">Karyawan:</label>
            <select class="form-control" name="employee_id" id="employee_id">
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $careerHistory->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="position_id">Posisi:</label>
            <select class="form-control" name="position_id" id="position_id">
                @foreach($positions as $position)
                    <option value="{{ $position->id }}" {{ $careerHistory->position_id == $position->id ? 'selected' : '' }}>{{ $position->job_position }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="department_id">Departemen:</label>
            <select class="form-control" name="department_id" id="department_id">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $careerHistory->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Tanggal:</label>
            <input type="date" class="form-control" name="date" id="date" value="{{ $careerHistory->date }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary bg-primary">Simpan Perubahan</button>
    </div>
</form>

@endsection