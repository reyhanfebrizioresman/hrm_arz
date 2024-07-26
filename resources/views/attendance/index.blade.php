@extends('layouts.template')
@section('title','Absensi')
@section('sub-judul','Absensi')
@section('breadcrumb')
@foreach ($breadcrumbs as $breadcrumb)
    @if(isset($breadcrumb['url']))
    <div class="breadcrumb-item">
        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
    </div>
    @else
    <div class="breadcrumb-item">{{ $breadcrumb['title'] }}</div>
    @endif
@endforeach
@endsection

@section('content')

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
            <button type="submit" class="btn btn-primary" ><i class="fas fa-file-download"></i> Export</button>
            </div>
        </form>
    </div>
</div>

{{-- <section class="section">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Hadir</h4>
                    </div>
                    <div class="card-body">
                        {{ $countStatus['hadir'] ?? 0}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        Sakit
                    </div>
                    <div class="card-body">
                        {{ $countStatus['sakit'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        Izin
                    </div>
                    <div class="card-body">
                        {{ $countStatus['izin'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>      
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        Cuti
                    </div>
                    <div class="card-body">
                        {{ $countStatus['cuti'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>                  
    </div>
</section> --}}

   <div class="row">
    <div class="col-md-3 mb-2">
        <div class="input-group input-group-sm">
            <input type="date" id="filterDate" class="form-control" value="{{ request('date') ?? date('Y-m-d') }}">
                <div class="input-group-append">
            <button id="filterButton" class="btn btn-primary">Filter</button>
        </div>
    </div>
    {{-- <a href="{{ route('attendance.exportAttendance') }}" class="btn btn-primary btn-sm">
    export
</a> --}}
        <!-- Export to Excel Form -->
    {{-- <form action="{{ route('attendance.exportAttendance') }}" method="POST" >
        @csrf
        <div class="mt-3">
         <button type="submit" class="btn btn-primary btn-block">Ekspor ke Excel</button>
        </div>
    </form>  --}}
    </div>
    <div class="col-md-9">
        <div class="d-flex justify-content-end mb-2">
        <a class="btn btn-primary btn-sm" href="{{route('attendance.create')}}"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
   </div>
    {{-- <a class="btn btn-primary btn-sm" href="{{route('attendance.importExport')}}">Ekspor/Impor</a> --}}
    </div>
    <!-- Attendance Table -->
    <div class="card mb-3 shadow-md">
        <div class="card-body">
        {{-- <h5>Tanggal : {{request('date')}}</h5> --}}
            <div class="table-responsive">
                <table id="tabel_product" class="table datatable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Telat</th>
                            <th>Lembur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            {{-- <td>{{ $loop->iteration }}</td> --}}
                            <td>{{ $employee->name }}</td>
                            @if($employee->attendance != null )
                            <td>
                                @if($employee->attendance->status == 'hadir')
                                <span class="badge badge-success">{{$employee->attendance->status ?? null}}</span>
                                @elseif($employee->attendance->status == 'izin')
                                <span class="badge badge-info">{{$employee->attendance->status ?? null}}</span>
                                @elseif($employee->attendance->status == 'sakit')
                                <span class="badge badge-warning">{{$employee->attendance->status ?? null}}</span>
                                @else
                                <span class="badge badge-danger">{{$employee->attendance->status ?? null}}</span>
                                @endif
                            </td>
                            <td>
                                {{ optional($employee->attendance)->clock_in ? \Carbon\Carbon::parse($employee->attendance->clock_in)->format('H:i') : '-' }}
                            </td>
                            <td>
                                {{ optional($employee->attendance)->clock_out ? \Carbon\Carbon::parse($employee->attendance->clock_out)->format('H:i') : '-' }}
                            </td>
                            
                            <td>{{ $employee->attendance->late ? $employee->attendance->late . ' Menit' : '0' }}</td>
                            <td>{{ $employee->attendance->overtime ? $employee->attendance->overtime . ' Menit' : '0' }}</td>

                            @else
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            
                            @endif
                            
                            <td>
                                @if($employee->attendance != null)
                                <a href="{{ route('attendance.edit', $employee->attendance->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-form-{{ $employee->attendance->id }}" action="{{ route('attendance.destroy', $employee->attendance->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="date" value="{{ request('date') }}">
                                    <button type="button" onclick="deleteConfirmation({{$employee->attendance->id ?? null }})" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
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
        <script>
            function deleteConfirmation(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Buat sebuah form dengan method DELETE dan action yang sesuai
                        // Temukan formulir berdasarkan ID
                      let form = document.getElementById('delete-form-' + id);
                      // Submit formulir
                      form.submit();
                    }
                })
            }
        </script>
        @endsection
@endsection
