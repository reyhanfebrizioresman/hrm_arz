@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Laporan')
@section('content')

<div class="container">
    <div class="card mb-3">
        <div class="card-header">Export Laporan</div>
        <div class="card-body">
            <!-- Export to Excel Form -->
            <form action="{{ route('reports.salaryExport') }}" method="POST" class="mb-3">
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
                    <button type="submit" class="btn btn-primary btn-sm">Ekspor ke Excel</button>
                    </div>
                </form>
        </div>
    </div>
    {{-- <a href="{{ route('reports.salaryExport') }}" class="btn btn-primary">Export to Excel</a>
    <table id="tabel_product" class="table datatable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Gaji Pokok</th>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Lembur</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
            <td>{{ $employee->name }}</td>
            <td>
                {{$employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount, 2, ',', '.'}}
            </td>
            @if($employee->attendance != null)
              
                        <td>{{ $employee->attendance->date }}</td>
                        <td>{{ $employee->attendance->clock_in }}</td>
                        <td>{{ $employee->attendance->clock_out }}</td>
                        <td>{{ $employee->attendance->overtime }}</td>
               
                @else
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                @endif

            </tr>

        @endforeach
        </tbody>
        
        
    </table>  --}}
</div>

@section('addon')
<script>
    $(document).ready( function () {
    $('#tabel_product').DataTable();
} );
</script>
@endsection
@endsection