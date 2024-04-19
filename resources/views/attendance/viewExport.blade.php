@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Absensi')
@section('content')


<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center bg-info" style="border: 1px solid #000;">Tanggal</th>
                            <th colspan="2" class="text-center bg-info" style="border: 1px solid #000;">Jam</th>
                            <th colspan="2" class="text-center bg-info" style="border: 1px solid #000;">eza</th>
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
                </table>
            </div>
        </div>

@endsection