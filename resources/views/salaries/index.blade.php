@extends('layouts.template')
@section('title','Gaji')
@section('sub-judul','Gaji')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <div class=" mb-4 d-flex justify-content-end">
            <a href="{{ route('salaries.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
            <table id="tabel_product" class="table datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        {{-- <th>Bonus</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salaries as $salary)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $salary->name }}</td>
                        {{-- <td>{{ $salary->category }}</td> --}}
                        <td>
                            @if($salary->category == 'income')
                            <span class="badge badge-light">{{$salary->category ? 'Pendapatan' : ''}}</span>
                            @else
                            <span class="badge badge-dark">{{$salary->category ? 'Potongan' : ''}}</span>
                            @endif
                        </td>
                        <td><a href="{{ route('salaries.edit',$salary->id) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>


                        <!-- Tombol Delete -->
                        <a href="{{ route('salaries.destroy', $salary->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $salary->id }}" action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form> 
                        </td>
                    </tr>
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
