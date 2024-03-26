@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')
<div class="container">
    <div class="mb-3">
        <form action="{{ route('attendance.export') }}" method="POST">
            @csrf
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
    
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
    
            <button type="submit" class="btn btn-primary">Export to Excel</button>
        </form>
    </div>
    <form action="{{ route('attendance.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="file" accept=".xlsx, .xls">
        </div>
        <button type="submit" class="btn btn-primary">Import from Excel</button>
    </form>
    <table id="tabel_product" class="table datatable">
        <thead>
            <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Tipe absen</th>
                    <th>cek in</th>
                    <th>cek out</th>
                    <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $item)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
        @endsection
@endsection
