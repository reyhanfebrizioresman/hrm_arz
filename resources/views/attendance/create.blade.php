@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">Ekspor-Impor</div>
        <div class="card-body">
            <!-- Export to Excel Form -->
            <form action="{{ route('attendance.export') }}" method="POST" class="mb-3">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label for="start_date">Tanggal Di Mulai:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="end_date">Tanggal Berakhir:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Ekspor ke Excel</button>
                    </div>
                </form>
                    <div class="col-md-6">
                        <form action="{{ route('attendance.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="">Impor Absensi</label>
                                <div class="input-group input-group-sm">
                                    <input type="file" name="file" accept=".xlsx, .xls" class="form-control">
                                        <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary btn-block">Impor</button>
                                        </div>
                                </div>                                           
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="card">
    <div class="card-header">Tambah Kehadiran</div>
    <div class="card-body">
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="employee_id">Nama Karyawan:*</label>
                        <select class="form-control" name="employee_id" id="employee_id">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date">Tanggal:*</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_in">Jam Masuk:*</label>
                        <input type="time" class="form-control" id="clock_in" name="clock_in">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_out">Jam Keluar:*</label>
                        <input type="time" class="form-control" id="clock_out" name="clock_out">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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
