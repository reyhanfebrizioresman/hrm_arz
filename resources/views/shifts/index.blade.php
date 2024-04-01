@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Shift')
@section('content')

<div class="container">
    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('shifts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Shift Kerja</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts->groupBy('name') as $shiftName => $shiftGroup)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $shiftName }}</td>
                                    <td>{{ date('Y-m-d', strtotime($shiftGroup->first()->start_time)) }}</td>
                                    <td>{{ date('Y-m-d', strtotime($shiftGroup->first()->end_time)) }}</td>
                                    <td>
                                        <a href="{{ route('shifts.edit',$shiftGroup->first()->id) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>

                                        <!-- Tombol Delete -->
                                        <a href="{{ route('shifts.destroy', $shiftGroup->first()->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $shiftGroup->first()->id }}" action="{{ route('shifts.destroy', $shiftGroup->first()->id) }}" method="POST" style="display: none;">
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
</div>
@endsection