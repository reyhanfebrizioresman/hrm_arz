@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Edit Shift  ')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">Edit Shift</div> --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('shifts.update', $shift->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Shift:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $shift->name }}">
                        </div>
                        {{-- Hari Senin --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="monday" name="monday" value="1" {{ $shift->monday ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="monday">Senin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="monday_start_time" class="form-control" value="{{ $shift->monday_start_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="monday_late_tolerance" class="form-control" value="{{ $shift->monday_late_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="monday_end_time" class="form-control" value="{{ $shift->monday_end_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="monday_early_leave_tolerance" class="form-control" value="{{ $shift->monday_early_leave_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="monday_break_start" class="form-control" value="{{ $shift->monday_break_start }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="monday_break_end" class="form-control" value="{{ $shift->monday_break_end }}">
                                </div>
                            </div>
                        </div>
                       {{-- Hari Selasa --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="tuesday" name="tuesday" value="1" {{ $shift->tuesday ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="tuesday">Selasa</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="tuesday_start_time" class="form-control" value="{{ $shift->tuesday_start_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="tuesday_late_tolerance" class="form-control" value="{{ $shift->tuesday_late_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="tuesday_end_time" class="form-control" value="{{ $shift->tuesday_end_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="tuesday_early_leave_tolerance" class="form-control" value="{{ $shift->tuesday_early_leave_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="tuesday_break_start" class="form-control" value="{{ $shift->tuesday_break_start }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="tuesday_break_end" class="form-control" value="{{ $shift->tuesday_break_end }}">
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
                                        <input type="checkbox" class="custom-control-input" id="wednesday" name="wednesday" value="1" {{ $shift->wednesday ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="wednesday">Rabu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="wednesday_start_time" class="form-control" value="{{ $shift->wednesday_start_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="wednesday_late_tolerance" class="form-control" value="{{ $shift->wednesday_late_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="wednesday_end_time" class="form-control" value="{{ $shift->wednesday_end_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="wednesday_early_leave_tolerance" class="form-control" value="{{ $shift->wednesday_early_leave_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="wednesday_break_start" class="form-control" value="{{ $shift->wednesday_break_start }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="wednesday_break_end" class="form-control" value="{{ $shift->wednesday_break_end }}">
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
                                        <input type="checkbox" class="custom-control-input" id="thursday" name="thursday" value="1" {{ $shift->thursday ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="thursday">Kamis</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="thursday_start_time" class="form-control" value="{{ $shift->thursday_start_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="thursday_late_tolerance" class="form-control" value="{{ $shift->thursday_late_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="thursday_end_time" class="form-control" value="{{ $shift->thursday_end_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="thursday_early_leave_tolerance" class="form-control" value="{{ $shift->thursday_early_leave_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="thursday_break_start" class="form-control" value="{{ $shift->thursday_break_start }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="thursday_break_end" class="form-control" value="{{ $shift->thursday_break_end }}">
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
                                        <input type="checkbox" class="custom-control-input" id="friday" name="friday" value="1" {{ $shift->friday ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="friday">Jumat</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="friday_start_time" class="form-control" value="{{ $shift->friday_start_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="friday_late_tolerance" class="form-control" value="{{ $shift->friday_late_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="friday_end_time" class="form-control" value="{{ $shift->friday_end_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="friday_early_leave_tolerance" class="form-control" value="{{ $shift->friday_early_leave_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="friday_break_start" class="form-control" value="{{ $shift->friday_break_start }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="friday_break_end" class="form-control" value="{{ $shift->friday_break_end }}">
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
                                        <input type="checkbox" class="custom-control-input" id="saturday" name="saturday" value="1" {{ $shift->saturday ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="saturday">Sabtu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="saturday_start_time" class="form-control" value="{{ $shift->saturday_start_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="saturday_late_tolerance" class="form-control" value="{{ $shift->saturday_late_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="saturday_end_time" class="form-control" value="{{ $shift->saturday_end_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="saturday_early_leave_tolerance" class="form-control" value="{{ $shift->saturday_early_leave_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="saturday_break_start" class="form-control" value="{{ $shift->saturday_break_start }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="saturday_break_end" class="form-control" value="{{ $shift->saturday_break_end }}">
                                </div>
                            </div>
                        </div>
                        <hr>

                        {{-- Hari Minggu --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="days">Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="sunday" name="sunday" value="1" {{ $shift->sunday ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="sunday">Minggu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="sunday_start_time" class="form-control" value="{{ $shift->sunday_start_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="sunday_late_tolerance" class="form-control" value="{{ $shift->sunday_late_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="sunday_end_time" class="form-control" value="{{ $shift->sunday_end_time }}">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="sunday_early_leave_tolerance" class="form-control" value="{{ $shift->sunday_early_leave_tolerance }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="sunday_break_start" class="form-control" value="{{ $shift->sunday_break_start }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="sunday_break_end" class="form-control" value="{{ $shift->sunday_break_end }}">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Perbarui Shift</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
