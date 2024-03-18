<x-app-layout>
<div class="container">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary bg-primary mt-3 mb-5" data-toggle="modal" data-target="#exampleModal">
    Add Employee
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
          <form action={{route('employee.store')}} method="POST" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="form-group">
                <label for="identity_no">Identity Number:</label>
                <input type="number" class="form-control" id="identity_no" name="identity_no">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address"></textarea>
            </div>
            <div class="form-group">
                <label for="merried_status">Marital Status:</label>
                <select class="form-control" id="marital_status" name="marital_status">
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="employment_status">Employment Status:</label>
                <select class="form-control" id="employment_status" name="employment_status">
                    <option value="full-time">Full Time</option>
                    <option value="part-time">Part Time</option>
                    <option value="contract">Contract</option>
                </select>
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" class="form-control-file" id="picture" name="picture">
            </div>
            <div class="form-group">
                <label for="joining_date">Joining Date:</label>
                <input type="date" class="form-control" id="joining_date" name="joining_date">
            </div>
            <div class="form-group">
                <label for="exit_date">Exit Date:</label>
                <input type="date" class="form-control" id="exit_date" name="exit_date">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Identity No</th>
                    <th>Gender</th>
                    <th>City</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Marital Status</th>
                    <th>Employment Status</th>
                    <th>Picture</th>
                    <th>Joining Date</th>
                    <th>Exit Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
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
    <label for="picture">Picture:</label><br>
    @if ($employee->picture)
        <img src="{{ asset('storage/pictures/' . $employee->picture) }}" alt="Employee Picture" style="max-width: 200px;">
    @else
        <p>No picture available</p>
    @endif
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
        </table>
  </div>
    </div>
</x-app-layout>