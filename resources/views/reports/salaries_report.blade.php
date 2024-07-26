@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Laporan')
@section('content')

<div class="container">
    {{-- <div class="card mb-3">
        <div class="card-header">Export Laporan Lembur</div>
        <div class="card-body">
            <!-- Export to Excel Form -->
            <form action="{{ route('reports.salaryExport') }}" method="POST" class="mb-3">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="start_date">Tanggal Di Mulai:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">Tanggal Berakhir:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-file-download"></i> Ekspor ke Excel</button>
                    </div>
                    </div>
                </form>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header bg-primary text-white">
            Perhitungan Lembur
        </div>
        <div class="card-body">
            <p>Pilih bulan dan tahun kemudian klik tombol Generate untuk Eksport Ke Excel</p>
            <form action="{{ route('reports.salaryExport') }}" method="POST" >
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="bulan">Bulan</label>
                        <select id="bulan" name="bulan" class="form-control">
                            @foreach ($months as $monthName => $monthNumber)
                                <option value="{{ $monthNumber }}" {{ $selectedMonth == $monthNumber ? 'selected' : '' }}>{{ $monthName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tahun">Tahun</label>
                        <select id="tahun" name="tahun" class="form-control">
                            <option selected>Pilih Tahun...</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" >Generate</button>
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