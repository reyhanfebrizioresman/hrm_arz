@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <!-- Export to Excel Form -->
            <form action="{{ route('attendance.export') }}" method="POST" class="mb-3">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <label for="start_date">Tanggal Mulai:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block">Ekspor ke Excel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <!-- Import from Excel Form -->
                    <form action="{{ route('attendance.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <input type="file" name="file" accept=".xlsx, .xls" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Impor ke Excel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- Filter by Date -->
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <input type="date" id="filterDate" class="form-control" value="{{ request('date') }}">
                        </div>                        
                        <div class="col-md-6">
                            <button id="filterButton" class="btn btn-primary btn-block">Pilih</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection