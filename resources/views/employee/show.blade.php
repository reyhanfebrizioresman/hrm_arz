@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Employee')
@section('content')



<div class="container rounded bg-white">
    <!-- Tab navigasi -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="career-tab" data-toggle="tab" href="#career" role="tab" aria-controls="career" aria-selected="false">Career History</a>
        </li>
    </ul>
    <!-- Dropdown -->
    <div class="dropdown d-flex justify-content-end">
        <button class="btn btn-primary dropdown-toggle mt-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('employee.edit', $employee->id) }}">Edit</a>
            <div class="dropdown-divider"></div>
            <div class="dropdown-item">
                <label class="switch">
                    <input type="checkbox" onchange="toggleEmployeeStatus({{ $employee->id }})" {{ $employee->status == 'active' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
                <span id="status-text-{{ $employee->id }}">{{ $employee->status == 'active' ? 'Aktif' : 'Non Aktif' }}</span>
            </div>
            <form id="toggle-form-{{ $employee->id }}" action="{{ route('employee.toggleStatus', $employee->id) }}" method="POST" style="display: none;">
                @csrf
                @method('PATCH')
            </form>
        </div>
    </div>
    <!-- Isi tab -->
    <div class="tab-content" id="myTabContent">
        <!-- Tab Profile -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <!-- Kolom 1: Image dan Career History -->
                <div class="col-md-3">
                    <div class="card shadow-md">
                        <div class="card-body text-center">
                            <!-- Gambar bundar -->
                            <img src="{{ asset('/storage/pictures/'. $employee->picture) }}" class="card-img rounded-circle mx-auto d-block mb-3" alt="Profile Picture" style="width: 200px; height: 200px;">
                            <!-- Nama -->
                            <h5 class="card-title">{{ $employee->name }}</h5>
                            <!-- Email -->
                            <p class="card-text">{{ $employee->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <h5 class="ml-4 mt-3">Informasi:</h5>
                        <div class="card-body">
                            <!-- Form Employee -->
                            <div class="row">
                                <div class="col-3">
                                    <!-- Kolom pertama -->
                                    <div class="form-group">
                                        <label for="name">Nama:</label>
                                        <p>{{ $employee->name }}</p>
                                        <label for="email">Email:</label>
                                        <p>{{ $employee->email }}</p>
                                        <label for="phone_number">No Hp:</label>
                                        <p>{{ $employee->phone_number }}</p>
                                        <label for="phone_number">No darurat:</label>
                                        <p>{{ $employee->emergency_number }}</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="gender">Jenis Kelamin:</label>
                                        <p>{{ $employee->gender }}</p>
                                        <label for="identity_no">No Identitas:</label>
                                        <p>{{ $employee->identity_no }}</p>
                                        <label for="religion">Agama:</label>
                                        <p>{{ $employee->religion }}</p>
                                        <label for="address">Domisili:</label>
                                        <p>{{ $employee->city }}</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="address">Alamat:</label>
                                    <p>{{ $employee->address }}</p>
                                    <label for="date_of_birth">Tanggal lahir:</label>
                                    <p>{{ date('d-F-Y', strtotime($employee->date_of_birth)) }}</p>
                                </div>
                                <div class="col-3">
                                    <label for="status">Status:</label>
                                    <p>@if($employee->status == 'active')
                                        <span class="badge badge-success">{{ ucfirst($employee->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($employee->status) }}</span>
                                    @endif</p>
                                    <label for="employment_status">Status Pekerja:</label>
                                    <p>{{ $employee->employment_status }}</p>
                                    <label for="joining_date">Tanggal Bergabung: </label>
                                    <p>{{ date('d-F-Y', strtotime($employee->joining_date)) }}</p>
                                    <label for="exit_date">Tanggal Keluar:</label>
                                    <p>{{ $employee->exit_date ? date('d-F-Y', strtotime($employee->exit_date)) : '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab Career History -->
        <div class="tab-pane fade" id="career" role="tabpanel" aria-labelledby="career-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-footer">
                                    <h5>Career History</h5>
                                    <!-- Tabel Career History -->
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleEmployeeStatus(employeeId) {
        var formId = 'toggle-form-' + employeeId;
        document.getElementById(formId).submit();
    }
</script>
  @endsection
