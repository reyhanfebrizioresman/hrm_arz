@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Histori Karir')
@section('content')

    <div class="container">
        <!-- Button trigger modal -->
        <div class=" mb-4 d-flex justify-content-end">
            <a href="{{ route('carieerHistory.create') }}" class="btn btn-primary">Tambah Karir</a>
        </div>

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
            <form action="{{ route('carieerHistory.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="employee_id">Employee:</label>
        <select class="form-control" name="employee_id" id="employee_id">
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="position_id">Position:</label>
        <select class="form-control" name="position_id" id="position_id">
            @foreach($positions as $position)
                <option value="{{ $position->id }}">{{ $position->job_position }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="department_id">Department:</label>
        <select class="form-control" name="department_id" id="department_id">
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" name="date" id="date">
    </div>

    <button type="submit" class="btn btn-primary mt-1">Submit</button>
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
                        <th>Employee</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($careerHistories as $careerHistory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $careerHistory->employee->name }}</td>
                        <td>{{ $careerHistory->position->job_position }}</td>
                        <td>{{ $careerHistory->department->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($careerHistory->date)) }}</td>
                        <td><!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary bg-primary btn-sm" data-toggle="modal" data-target="#editCareerHistoryModal">
                        <i class="fas fa-edit"></i>               
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="editCareerHistoryModal" tabindex="-1" role="dialog" aria-labelledby="editCareerHistoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCareerHistoryModalLabel">Edit Career History</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('carieerHistory.update', $careerHistory->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="employee_id">Employee:</label>
                                                    <select class="form-control" name="employee_id" id="employee_id">
                                                        @foreach($employees as $employee)
                                                            <option value="{{ $employee->id }}" {{ $careerHistory->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="position_id">Position:</label>
                                                    <select class="form-control" name="position_id" id="position_id">
                                                        @foreach($positions as $position)
                                                            <option value="{{ $position->id }}" {{ $careerHistory->position_id == $position->id ? 'selected' : '' }}>{{ $position->job_position }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="department_id">Department:</label>
                                                    <select class="form-control" name="department_id" id="department_id">
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}" {{ $careerHistory->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Date:</label>
                                                    <input type="date" class="form-control" name="date" id="date" value="{{ $careerHistory->date }}">
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
                        <form action="{{ route('carieerHistory.destroy', $careerHistory->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
        </div>
        @endsection