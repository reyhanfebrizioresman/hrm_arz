@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Positions')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
    <button type="button" class="btn bg-primary btn-primary mt-3 mb-5" data-toggle="modal" data-target="#exampleModal">
        Add Position
      </button>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action={{route('positions.store')}} method="POST">
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="Job Position">Name:</label>
                    <input type="text" class="form-control" id="job_position" name="job_position">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
          </div>
        </div>
      </div>
        
      <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Job Position</th>            
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($positions as $position)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $position->job_position }}</td>
                        <td><button type="button" class="btn btn-primary bg-primary btn-sm" data-toggle="modal" data-target="#editPositionsModal">
<i class="fas fa-edit"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editPositionsModal" tabindex="-1" role="dialog" aria-labelledby="editPositionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPositionsModalLabel">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('positions.update', $position->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="job_position" value="{{ $position->job_position }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
                        <!-- Tombol Delete -->
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
        </div>
@endsection