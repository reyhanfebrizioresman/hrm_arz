@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Laporan')
@section('content')

<div class="container">
    <a href="{{ route('reports.salaryExport') }}" class="btn btn-primary">Export to Excel</a>
    <table id="tabel_product" class="table datatable">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                {{-- <th>Divisi</th> --}}
                <th>Gaji Pokok</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Lembur</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                @foreach($employee->salaryComponents as $salaryComponent)
                @if($salaryComponent->name == 'gaji pokok')
                    <tr>
                        <td>{{ $employee->attendance->date }}</td>
                        <td>{{ $employee->name }}</td>
                        {{-- <td>{{ $employee->careerHistories->department->name }}</td> --}}
                        <td>
                            @if($salaryComponent->name == 'gaji pokok')
                            {{ "Rp " . number_format($salaryComponent->pivot->amount,2,',','.') }}
                            @endif
                        </td>
                        <td>{{ $employee->attendance->clock_in }}</td>
                        <td>{{ $employee->attendance->clock_out }}</td>
                        <td>{{ $employee->attendance->overtime }}</td>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                    @endif
                @endforeach
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