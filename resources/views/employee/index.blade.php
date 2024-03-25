@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Employee')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between">
        <form action="{{ route('employee.index') }}" method="GET" class="flex-grow-1 mr-2" id="searchForm">
            <div class="input-group">
                <input type="text" class="form-control form-control" placeholder="Search" name="search" id="searchInput" value="{{ request('search') }}">
                <div class="input-group-append">
                    <span class="input-group-text input" id="searchIcon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
            
        </form>
        <a href="{{ route('employee.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Employee</a>
    </div>
    <div class="row">
        @foreach($employees as $employee)
        <div class="col-md-6 mt-4">
            <a href="{{ route('employee.show', $employee->id) }}" style="text-decoration: none; color: inherit;">
                <div class="card mb-3 shadow-lg" style="max-width: 540px; max-height: 200px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('/storage/pictures/'. $employee->picture) }}" class="card-img h-100 w-100" style="max-height: 200px;" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ ucfirst($employee->name) }}</h5>
                                <p class="card-text">
                                    @if($employee->status == 'active')
                                        <span class="badge badge-success">{{ ucfirst($employee->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($employee->status) }}</span>
                                    @endif <br>
                                    {{ ucfirst($employee->employment_status) }} <br>
                                    <span>Bekerja Sejak: </span>{{ \Carbon\Carbon::parse($employee->joining_date)->diffForHumans() }}<br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>            
        </div>
        @endforeach
    </div>
    <div class="pagination mt-3" style="display: flex; justify-content:center;">
        {{ $employees->onEachSide(1)->render('pagination::bootstrap-4') }}
    </div>
  </div>

                {{-- @foreach($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone_number }}</td>
                    <td>{{ $employee->identity_no }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->city }}</td>
                    <td>{{ date('d-m-Y', strtotime($employee->date_of_birth)) }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->marital_status}}</td>
                    <td>{{ $employee->employment_status }}</td>
                    <td><img src="{{ asset('storage/pictures/' . $employee->picture) }}" alt="Picture {{ $employee->name }}" width="100"></td>
                    <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($employee->exit_date)) }}</td>
                    <td><!-- Button trigger modal -->
<button type="button" class="btn btn-primary bg-primary btn-sm" data-toggle="modal" data-target="#editEmployeeModal">
<i class="fas fa-edit"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ $employee->phone_number }}">
    </div>
    <div class="form-group">
        <label for="identity_no">Identity Number:</label>
        <input type="number" class="form-control" id="identity_no" name="identity_no" value="{{ $employee->identity_no }}">
    </div>
    <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" id="gender" name="gender">
            <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>
    <div class="form-group">
        <label for="city">City:</label>
        <input type="text" class="form-control" id="city" name="city" value="{{ $employee->city }}">
    </div>
    <div class="form-group">
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $employee->date_of_birth }}">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" id="address" name="address">{{ $employee->address }}</textarea>
    </div>
    <div class="form-group">
        <label for="marital_status">Marital Status:</label>
        <select class="form-control" id="marital_status" name="marital_status">
            <option value="single" {{ $employee->marital_status == 'single' ? 'selected' : '' }}>Single</option>
            <option value="married" {{ $employee->marital_status == 'married' ? 'selected' : '' }}>Married</option>
            <option value="divorced" {{ $employee->marital_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
            <option value="widowed" {{ $employee->marital_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
        </select>
    </div>
    <div class="form-group">
        <label for="employment_status">Employment Status:</label>
        <select class="form-control" id="employment_status" name="employment_status">
            <option value="full-time" {{ $employee->employment_status == 'full-time' ? 'selected' : '' }}>Full Time</option>
            <option value="part-time" {{ $employee->employment_status == 'part-time' ? 'selected' : '' }}>Part Time</option>
            <option value="contract" {{ $employee->employment_status == 'contract' ? 'selected' : '' }}>Contract</option>
        </select>
    </div>
    <div class="form-group">
        <label for="picture">Picture:</label>
        <input type="file" class="form-control-file" id="picture" name="picture">
    </div>
    <div class="form-group">
        <label for="joining_date">Joining Date:</label>
        <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ $employee->joining_date }}">
    </div>
    <div class="form-group">
        <label for="exit_date">Exit Date:</label>
        <input type="date" class="form-control" id="exit_date" name="exit_date" value="{{ $employee->exit_date }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

        </div>
    </div>
</div>

                    </a>
                    <!-- Tombol Delete -->
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm bg-danger mt-1" onclick="return confirm('Are you sure you want to delete this employee?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}
  </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                $('#searchForm').submit();
            });
        });
    </script>

@endsection
