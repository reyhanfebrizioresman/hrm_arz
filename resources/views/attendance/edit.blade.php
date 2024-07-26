@extends('layouts.template')
@section('title','Ubah Absensi')
@section('sub-judul','Absensi')
@section('content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Kehadiran</h5>
        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="employee_id">Karir:</label>
                <select class="form-control" name="employee_id" id="employee_id">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $attendance->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control" id="">
                <option value="hadir" {{$attendance->status == 'hadir' ? 'selected' : ''}}>Hadir</option>
                <option value="sakit" {{$attendance->status == 'sakit' ? 'selected' : ''}}>Sakit</option>
                <option value="izin" {{$attendance->status == 'izin' ? 'selected' : ''}}>Izin</option>
                <option value="cuti" {{$attendance->status == 'cuti' ? 'selected' : ''}}>Cuti</option>
            </select>
                {{-- <input type="text" class="form-control" id="status" name="status" value="{{ $attendance->status }}"> --}}
            </div>
            {{-- <div class="form-group">
                <label for="overtime">Lembur:</label>
                <input type="text" class="form-control" id="overtime" name="overtime" value="{{ $attendance->overtime }}">
            </div> --}}
            <div class="form-group">
                <label for="clock_in">Jam Masuk:</label>
                <input type="time" class="form-control" id="clock_in" name="clock_in" value="{{ $attendance->clock_in }}">
            </div>
            <div class="form-group">
                <label for="clock_out">Jam Keluar:</label>
                <input type="time" class="form-control" id="clock_out" name="clock_out" value="{{ $attendance->clock_out }}">
            </div>
            <div class="form-group">
                <label for="date">Tanggal:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $attendance->date }}">
            </div>
            <div class=" mb-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
    </div>
</div>
@endsection