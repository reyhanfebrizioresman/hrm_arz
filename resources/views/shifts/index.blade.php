@extends('layouts.template')
@section('title','Shift')
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Shift Kerja</th>
                                <th>Senin</th>
                                <th>Selasa</th>
                                <th>Rabu</th>
                                <th>Kamis</th>
                                <th>Jumat</th>
                                <th>Sabtu</th>
                                <th>Minggu</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $shif)
                                <tr>
                                    <td>{{ $shif->name }}</td>
                                    <td>@if ($shif->monday)
                                        <div>
                                            <strong>Jam Mulai:</strong> {{ \Carbon\Carbon::parse($shif->monday_start_time)->format('H:i') ?? '-' }}
                                        </div>
                                        <div>
                                            <strong>Jam Keluar:</strong> {{ \Carbon\Carbon::parse($shif->monday_end_time)->format('H:i') ?? '-' }}
                                        </div>
                                        @else
                                        -
                                    @endif</td>
                                    <td>@if ($shif->tuesday)
                                        <div>
                                            <strong>Jam Mulai:</strong> {{ \Carbon\Carbon::parse($shif->tuesday_start_time)->format('H:i') ?? '-' }}
                                        </div>
                                        <div>
                                            <strong>Jam Keluar</strong> {{ \Carbon\Carbon::parse($shif->tuesday_end_time)->format('H:i') ?? '-' }}
                                        </div>
                                        @else
                                        -
                                    @endif</td>

                                    <td>@if ($shif->wednesday)
                                        <div>
                                            <strong>Jam Masuk:</strong> {{ \Carbon\Carbon::parse($shif->wednesday_start_time)->format('H:i') ?? '-' }}
                                        </div>
                                        <div>
                                            <strong>Jam Keluar:</strong> {{ \Carbon\Carbon::parse($shif->wednesday_end_time)->format('H:i') ?? '-' }}
                                        </div>
                                        @else
                                        -
                                    @endif</td>

                                    <td>@if ($shif->thursday)
                                        <div>
                                            <strong>Jam Masuk:</strong> {{ \Carbon\Carbon::parse($shif->thursday_start_time)->format('H:i') ?? '-' }}
                                        </div>
                                        <div>
                                            <strong>Jam Keluar:</strong> {{ \Carbon\Carbon::parse($shif->thursday_end_time)->format('H:i') ?? '-' }}
                                        </div>
                                        @else
                                        -
                                    @endif</td>

                                    <td>@if ($shif->friday)
                                        <div>
                                            <strong>Jam Masuk:</strong> {{ \Carbon\Carbon::parse($shif->friday_start_time)->format('H:i') ?? '-' }}
                                        </div>
                                        <div>
                                            <strong>Jam Keluar:</strong> {{ \Carbon\Carbon::parse($shif->friday_end_time)->format('H:i') ?? '-' }}
                                        </div>
                                        @else
                                        -
                                    @endif</td>
                                    
                                    <td>@if ($shif->saturday)
                                        <div>
                                            <strong>Jam Masuk:</strong> {{ \Carbon\Carbon::parse($shif->saturday_start_time)->format('H:i') ?? '-' }}
                                        </div>
                                        <div>
                                            <strong>Jam Keluar:</strong> {{ \Carbon\Carbon::parse($shif->saturday_end_time)->format('H:i') ?? '-' }}
                                        </div>
                                        @else
                                        -
                                    @endif</td>

                                    <td>@if ($shif->sunday)
                                        <div>
                                            <strong>Jam Masuk:</strong> {{ \Carbon\Carbon::parse($shif->sunday_start_time)->format('H:i') ?? '-' }}
                                        </div>
                                        <div>
                                            <strong>Jam Keluar:</strong> {{ \Carbon\Carbon::parse($shif->sunday_end_time)->format('H:i') ?? '-' }}
                                        </div>
                                        @else
                                         -
                                    @endif</td>
                                    
                                    
                                    {{-- <td>{{ $shif->tuesday ? 'Selasa' : '-'}}</td>
                                    <td>{{ $shif->wednesday ? 'Rabu' : '-'}}</td>
                                    <td>{{ $shif->thursday ? 'Kamis' : '-'}}</td>
                                    <td>{{ $shif->friday ? 'Jumat' : '-'}}</td>
                                    <td>{{ $shif->saturday ? 'Sabtu' : '-'}}</td>
                                    <td>{{ $shif->sunday ? 'Minggu' : '-'}}</td> --}}
                                    <td>
                                        <a href="{{ route('shifts.edit',$shif->id) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>

                                        <!-- Tombol Delete -->
                                        <a href="{{ route('shifts.destroy', $shif->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $shif->id }}" action="{{ route('shifts.destroy', $shif->id) }}" method="POST" style="display: none;">
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