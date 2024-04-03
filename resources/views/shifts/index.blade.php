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
<<<<<<< HEAD
                                <th>Shift Kerja</th>
                                <th>Jam Mulai</th>
=======
                                <th>Tanggal Shift</th>
                                <th>Jam Masuk</th>
>>>>>>> 8fe16ff95b0c4b052b37c2d31b19b30ba71b24a5
                                <th>Jam Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
<<<<<<< HEAD
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->monday_start_time}}</td>
                                    <td>{{ $item->monday_end_time}}</td>
=======
                                    <td>{{ date('Y-m-d', strtotime($shiftGroup->first()->end_time)) }}</td>
                                    <td>{{ date('H:i', strtotime($shiftGroup->first()->start_time)) }}</td>
                                    <td>{{ date('H:i', strtotime($shiftGroup->first()->end_time)) }}</td>
>>>>>>> 8fe16ff95b0c4b052b37c2d31b19b30ba71b24a5
                                    <td>
                                        <a href="{{ route('shifts.edit',$item->id) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>

                                        <!-- Tombol Delete -->
                                        <a href="{{ route('shifts.destroy', $item->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('shifts.destroy', $item->id) }}" method="POST" style="display: none;">
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