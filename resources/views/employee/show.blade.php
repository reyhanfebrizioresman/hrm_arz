@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Employee')
@section('content')

<div class="container rounded bg-white">
    <div class="dropdown d-flex justify-content-end">
        <button class="btn btn-success dropdown-toggle mt-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Option
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('employee.careerHistory', $employee->id) }}">View Career</a>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $employee->id }}').submit();">Delete</a>
            <form id="delete-form-{{ $employee->id }}" action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Kolom 1: Image dan Career History -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Gambar rounded -->
                        <img src="{{ asset('/storage/pictures/'. $employee->picture) }}" class="card-img img-rounded mx-auto d-block" alt="Profile Picture" style="max-width: 200px; max-height: 200px;">
                    </div>
                    <div class="card-footer">
                        <!-- Tabel Career History -->
                        <h5>Career History</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee->careerHistories as $history)
                                <tr>
                                    <td>{{ $history->date }}</td>
                                    <td>{{ $history->position->job_position }}</td>
                                    <td>{{ $history->department->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
<<<<<<< HEAD
                </div>
            </div>
            <!-- Kolom 2: Form Employee -->
            <div class="col-md-6">
                <div class="card">
                    <h5>Informasi</h5>
                    <div class="card-body">
                        <!-- Form Employee -->
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Kolom pertama -->
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_number">Phone Number:</label>
                                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ $employee->phone_number }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="identity_no">Identity Number:</label>
                                        <input type="number" class="form-control" id="identity_no" name="identity_no" value="{{ $employee->identity_no }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Gender:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->gender }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tanggal Ulang Tahun:</label>
                                        <input type="text" class="form-control" id="name" name="name" value=" {{ date('d-F-Y', strtotime($employee->joining_date)) }}" disabled>
                                    </div>
    

                                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                </form>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <textarea class="form-control" id="address" name="address" disabled>{{ $employee->address }}</textarea>
                                </div>
                                <!-- Kolom kedua -->
                                <div class="form-group">
                                    <label for="name">Status Pernikahan:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $employee->marital_status }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="name">Status Pekerja:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $employee->employment_status }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="name">Joining Date:</label>
                                    <input type="text" class="form-control" id="name" name="name" value=" {{ date('d-F-Y', strtotime($employee->joining_date)) }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="name">Exit Date:</label>
                                    <input type="text" class="form-control" id="name" name="name" value=" {{ date('d-F-Y', strtotime($employee->exit_date)) }}" disabled>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
=======
                </div>
            </div>
            <!-- Kolom 2: Form Employee -->
            <div class="col-md-6">
                <div class="card">
                    <h5>Informasi</h5>
                    <div class="card-body">
                        <!-- Form Employee -->
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Kolom pertama -->
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
                                            <option value="male" {{ $employee->gender === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ $employee->gender === 'female' ? 'selected' : '' }}>Female</option>
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


                                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                </form>
                            </div>

                            <div class="col-md-6">
                                <!-- Kolom kedua -->
                                <div class="form-group">
                                    <label for="marital_status">Marital Status:</label>
                                    <select class="form-control" id="marital_status" name="marital_status">
                                        <option value="single" {{ $employee->marital_status === 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="married" {{ $employee->marital_status === 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="divorced" {{ $employee->marital_status === 'divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="widowed" {{ $employee->marital_status === 'widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="employment_status">Employment Status:</label>
                                    <select class="form-control" id="employment_status" name="employment_status">
                                        <option value="full-time" {{ $employee->employment_status === 'full-time' ? 'selected' : '' }}>Full Time</option>
                                        <option value="part-time" {{ $employee->employment_status === 'part-time' ? 'selected' : '' }}>Part Time</option>
                                        <option value="contract" {{ $employee->employment_status === 'contract' ? 'selected' : '' }}>Contract</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="joining_date">Joining Date:</label>
                                    <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ $employee->joining_date }}">
                                </div>

                                <div class="form-group">
                                    <label for="exit_date">Exit Date:</label>
                                    <input type="date" class="form-control" id="exit_date" name="exit_date" value="{{ $employee->exit_date }}">
                                </div>

                                <div class="form-group">
                                    <label for="picture">Picture:</label>
                                    <input type="file" class="form-control-file" id="picture" name="picture">
                                    <img src="{{ asset('storage/pictures/'.$employee->picture) }}" alt="Current Picture" style="max-width: 100px;">
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
>>>>>>> 2024392abe1d0242f99b87327a55d52d41a0d98c
            </div>
        </div>

    </div>

</div>
</div>
</div>

  @endsection
