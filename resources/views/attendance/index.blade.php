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
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Telat</th>
                            <th>Lembur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $item)
                        <tr>
                            {{-- <td>{{ $loop->iteration }}</td> --}}
                            <td>{{ $item->name }}</td>
                            <td>{{ date('Y-m-d', strtotime($item->attendance->date)) }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->attendance->clock_in)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->attendance->clock_out)->format('H:i') }}</td>
                            <td>{{$item->attendance->late}} Menit</td>
                            <td>{{$item->attendance->overtime}} Menit</td>
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
