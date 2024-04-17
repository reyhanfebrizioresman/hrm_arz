@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Tambah Shift  ')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">Create Shift</div> --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('shifts.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Shift:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        {{-- <div class="form-group">
                            <label for="shift">Nama Karyawan:</label>
                            <select name="employees[]" id="employee" class="form-control">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        {{-- Hari Senin --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="monday" name="monday" value="1">
                                        <label class="custom-control-label" for="monday">Senin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="monday_start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="monday_late_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="monday_end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="monday_early_leave_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="monday_break_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="monday_break_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Hari Selasa --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="tuesday" name="tuesday" value="1">
                                        <label class="custom-control-label" for="tuesday">Selasa</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="tuesday_start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="tuesday_late_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="tuesday_end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="tuesday_early_leave_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="tuesday_break_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="tuesday_break_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Hari Rabu --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="wednesday" name="wednesday" value="1">
                                        <label class="custom-control-label" for="wednesday">Rabu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="wednesday_start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="wednesday_late_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="wednesday_end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="wednesday_early_leave_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="wednesday_break_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="wednesday_break_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Hari Kamis --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="thursday" name="thursday" value="1">
                                        <label class="custom-control-label" for="thursday">Kamis</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="thursday_start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="thursday_late_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="thursday_end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="thursday_early_leave_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="thursday_break_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="thursday_break_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Hari Jumat --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="friday" name="friday" value="1">
                                        <label class="custom-control-label" for="friday">Jumat</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="friday_start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="friday_late_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="friday_end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="friday_early_leave_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="friday_break_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="friday_break_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Hari Sabtu --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="saturday" name="saturday" value="1">
                                        <label class="custom-control-label" for="saturday">Sabtu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="saturday_start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="saturday_late_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="saturday_end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="saturday_early_leave_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="saturday_break_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="saturday_break_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Hari minggu --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="sunday" name="sunday" value="1">
                                        <label class="custom-control-label" for="sunday">Minggu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="sunday_start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="sunday_late_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="sunday_end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="sunday_early_leave_tolerance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="sunday_break_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="sunday_break_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tambah Shift</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
