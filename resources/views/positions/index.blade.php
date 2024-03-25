@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Posisi')
@section('content')
    <div class="container">
        <div class=" mb-4 d-flex justify-content-end">
            <a href="{{ route('positions.create') }}" class="btn btn-primary">Tambah Posisi</a>
        </div>
            <table id="tabel_product" class="table datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Posisi Pekerjaan</th>
                        <th>Ubah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($positions as $position)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $position->job_position }}</td>
                        <td><a href="{{ route('positions.edit',$position->id) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('positions.destroy', $position->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                <i class="fas fa-trash"></i>
                            </a>
                            <form id="delete-form-{{ $position->id }}" action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>                            
                        {{-- <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-danger btn-sm" >
                                <i class="fas fa-trash"></i>
                            </button>
                        </form> --}}
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
