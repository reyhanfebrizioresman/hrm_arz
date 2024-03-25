@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Departemen')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <div class=" mb-4 d-flex justify-content-end">
            <a href="{{ route('departments.create') }}" class="btn btn-primary">Tambah Departemen</a>
        </div>
            <table id="tabel_product" class="table datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Ubah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $department->name }}</td>
                        <td><a href="{{ route('departments.edit',$department->id) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>


                        <!-- Tombol Delete -->
                        <a href="{{ route('departments.destroy', $department->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $department->id }}" action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: none;">
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
