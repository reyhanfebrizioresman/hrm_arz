@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Positions')
@section('content')
    <div class="container">
        <div class=" mb-4 d-flex justify-content-end">
            <a href="{{ route('positions.create') }}" class="btn btn-primary">Add Positions</a>
        </div>
            <table id="tabel_product" class="table datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Posisi Pekerjaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($positions as $position)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $position->job_position }}</td>
                        <td><a href="{{ route('positions.edit',$position->id) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">
                                <i class="fas fa-trash"></i>
                            </button>
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
