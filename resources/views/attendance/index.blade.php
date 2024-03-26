@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')
    <div class="container">
        <form action="{{ route('attendance.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx, .xls">
            <button type="submit">Import</button>
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
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
