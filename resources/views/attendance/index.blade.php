@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')
<div class="container">
    <!-- Export to Excel Form -->
    <form action="{{ route('attendance.export') }}" method="POST" class="mb-3">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Export to Excel</button>
            </div>
        </div>
    </form>
    
    <!-- Import from Excel Form -->
    <form action="{{ route('attendance.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <input type="file" name="file" accept=".xlsx, .xls" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Import from Excel</button>
            </div>
        </div>
    </form>
    
    <!-- Filter by Date -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="date" id="filterDate" class="form-control" value="{{ old('filterDate') }}">
        </div>
        <div class="col-md-2">
            <button id="filterButton" class="btn btn-primary">Filter</button>
        </div>
    </div>
    
    <!-- Attendance Table -->
    <table id="tabel_product" class="table datatable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Cek In</th>
                <th>Cek Out</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->employee_name }}</td>
                <td>{{ date('Y-m-d', strtotime($item->date)) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->clock_in)->format('h:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->clock_out)->format('h:i') }}</td>
                <td>
                    <a href="{{ route('attendance.edit', $item->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('attendance.destroy', $item->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                        <i class="fas fa-trash"></i>
                    </a>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('attendance.destroy', $item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


       

        @section('addon')
        <script>
            $(document).ready( function () {
            $('#tabel_product').DataTable();
        } );
        </script>
        <script>
            $(document).ready(function() {
                $('#filterButton').click(function() {
                    var selectedDate = $('#filterDate').val();
                    var url = "{{ route('attendance.index') }}?date=" + selectedDate;
                    window.location.href = url;
                });
            });
        </script>
        @endsection
@endsection
