@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Karyawan')
@section('content')

<style>
    .bold-label {
        font-weight: bold;
    }
</style>

<div class="container rounded bg-white">
    <!-- Tab navigasi -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="career-tab" data-toggle="tab" href="#career" role="tab" aria-controls="career" aria-selected="false">Riwayat Karir</a>
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
                <div class="custom-control custom-switch">
            <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch" {{ $employee->status === 'active' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customSwitch">Status</label>
                </div>                            
            </div>
            </div>
            <form id="toggle-form-{{ $employee->id }}" action="{{ route('employee.toggleStatus', $employee->id) }}" method="POST" style="display: none;">
                @csrf
                @method('PATCH')
            </form>
            
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
                            <img src="{{ asset('/storage/pictures/'. $employee->picture) }}" class="card-img rounded-circle mx-auto d-block mb-3" alt="Profile Picture" style="object-fit:cover; width: 150px; height: 150px;">
                            <!-- Nama -->
                            <h5 class="card-title">{{ $employee->name }}</h5>
                            <!-- Email -->
                            <p class="card-text">{{ $employee->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header"><h5>Informasi</h5></div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Full Name</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employee->name }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Email</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employee->email }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Phone Number</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employee->phone_number }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">No darurat</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employee->phone_number }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">No Identitas</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employee->identity_no }}</p>
                            </div>
                          </div>
                          <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Domisili</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employee->city }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Alamat</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employee->address }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tanggal Lahir</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ date('d F Y', strtotime($employee->date_of_birth)) }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tempat Lahir</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{$employee->place_of_birth}}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Jenis Kelamin</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employee->gender }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Status Pernikahan</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employee->marital_status }}</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">PTKP</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">
                                {{$employee->ptkp}}
                              </p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Status</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">
                                @if($employee->status == 'active')
                                            <span style="color: black" class="badge badge-success font-weight-bold">{{ ucfirst($employee->status) }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ ucfirst($employee->status) }}</span>
                                        @endif
                              </p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Status Pekerja</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employee->employment_status }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tanggal Bergabung</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ date('d F Y', strtotime($employee->joining_date)) }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tanggal Keluar</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ date('d F Y', strtotime($employee->exit_date)) }}</p>
                            </div>
                          </div>
                        <hr>
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
                                    <h5>Riwayat Karir</h5>
                                    <!-- Tabel Career History -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Posisi</th>
                                                <th>Departemen</th>
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
    document.getElementById('customSwitch').addEventListener('change', function() {
        document.getElementById('toggle-form-{{ $employee->id }}').submit();
</script>
@endsection
