@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center bg-info" style="border: 1px solid #000;">Tanggal</th>
                            <th colspan="2" class="text-center bg-info" style="border: 1px solid #000;">Jam</th>
                            <th colspan="2" class="text-center bg-info" style="border: 1px solid #000;">{{$employees->name}}</th>
                        </tr>
                        <tr>
                            <th class="text-center bg-info" style="border: 1px solid #000;">In</th>
                            <th class="text-center bg-info" style="border: 1px solid #000;">Out</th>
                            <th class="text-center bg-info" style="border: 1px solid #000;">Ket</th>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000;">senin</td>
                            <td style="border: 1px solid #000;">12:00</td>
                            <td style="border: 1px solid #000;">12:00</td>
                            <td style="border: 1px solid #000;">masuk</td>
                        </tr>
                    </thead>                    
                    <tbody>
                      
                    </tbody>
                </table> --}}

                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Jam Puasa</th>
                            <th>eza</th>
                            <th>Ket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->clock_in }}</td>
                            <td>{{ $attendance->clock_out }}</td>
                            {{-- <td>{{ $attendance->fasting_time }}</td>
                            <td>{{ $attendance->eza }}</td>
                            <td>{{ $attendance->note }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

@endsection