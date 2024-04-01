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
                        <div class="form-group">
                            <label for="shift">Berlaku Shift</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="col-6">
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday',] as $day)
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Hari Kerja:</label><br>
                                    <div class="custom-control custom-checkbox">
                                        <input type="hidden" name="days[{{ $day }}]" value="0">
                                        <input type="checkbox" class="custom-control-input" id="{{ $day }}" name="days[{{ $day }}]" value="1">
                                        <label class="custom-control-label" for="{{ $day }}">{{ ucfirst($day) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Masuk:</label>
                                    <input type="time" name="start_times[{{ $day }}]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Keterlambatan:</label>
                                    <input type="number" name="late_tolerances[{{ $day }}]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Pulang:</label>
                                    <input type="time" name="end_times[{{ $day }}]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Toleransi Pulang Cepat:</label>
                                    <input type="number" name="early_leave_tolerances[{{ $day }}]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat:</label>
                                    <input type="time" name="break_starts[{{ $day }}]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jam Istirahat Selesai:</label>
                                    <input type="time" name="break_ends[{{ $day }}]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Shift:</label><br>
                                    <input type="radio" name="shifts[{{ $day }}]" value="morning"> Pagi
                                    <input type="radio" name="shifts[{{ $day }}]" value="evening"> Malam
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
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
