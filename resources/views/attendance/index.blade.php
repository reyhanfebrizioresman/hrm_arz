@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')

    

   <div class="row">
    <div class="col-md-3 mb-2">
        <div class="input-group input-group-sm">
            <input type="date" id="filterDate" class="form-control" value="{{ request('date') }}">
                <div class="input-group-append">
            <button id="filterButton" class="btn btn-primary">Filter</button>
        </div>
    </div>
        <!-- Export to Excel Form -->
    <form action="{{ route('attendance.exportAttendance') }}" method="POST" >
        @csrf
        <div class="mt-3">
         <button type="submit" class="btn btn-primary btn-block">Export to Excel</button>
        </div>
    </form> 
    </div>
    <div class="col-md-9">
        <div class="d-flex justify-content-end mb-2">
        <a class="btn btn-primary btn-sm" href="{{route('attendance.create')}}"><i class="fas fa-plus"></i></a>
        </div>
    </div>
   </div>
    {{-- <a class="btn btn-primary btn-sm" href="{{route('attendance.importExport')}}">Export/Import</a> --}}
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
                                <span class="badge badge-secondary">{{$employee->attendance->status ?? null}}</span>
                                @else
                                <span class="badge badge-danger">{{$employee->attendance->status ?? null}}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($employee->attendance->clock_in ?? null)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($employee->attendance->clock_out ?? null)->format('H:i') }}</td>
                            <td>{{$employee->attendance->late ?? null}} Menit</td>
                            <td>{{$employee->attendance->overtime ?? null}} Menit</td>
                            @else
                            <td>-</td>
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
                                <a href="{{ route('attendance.destroy',  $employee->attendance->id ?? null) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <form id="delete-form-{{ $employee->attendance->id ?? null }}" action="{{ route('attendance.destroy', $employee->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
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
        @endsection
@endsection
