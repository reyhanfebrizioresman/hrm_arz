@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Karyawan')

@section('breadcrumb')
@foreach ($breadcrumbs as $breadcrumb)
    @if(isset($breadcrumb['url']))
    <div class="breadcrumb-item">
        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
    </div>
    @else
    <div class="breadcrumb-item">{{ $breadcrumb['title'] }}</div>
    @endif
@endforeach
@endsection

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
        <li class="nav-item">
          <a class="nav-link" id="shift-tab" data-toggle="tab" href="#shift" role="tab" aria-controls="shift" aria-selected="false">Shift Kerja</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="salaries-tab" data-toggle="tab" href="#salaries" role="tab" aria-controls="salaries" aria-selected="false">Gaji Karyawan</a>
    </li>
    </ul>

    
    <!-- Isi tab -->
    <div class="tab-content" id="myTabContent">
        <!-- Tab Profile -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <!-- Dropdown -->
              <div class="dropdown d-flex justify-content-end">
                <button class="btn btn-primary dropdown-toggle mt-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-pen"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('employee.edit', $employees->id) }}"> <i class="fas fa-edit"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch-{{ $employees->id }}" {{ $employees->status === 'active' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitch-{{ $employees->id }}">Status</label>
                        </div>
                        <form id="toggle-form-{{ $employees->id }}" action="{{ route('employee.toggleStatus', $employees->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PATCH')
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Kolom 1: Image dan Career History -->
                <div class="col-md-3">
                    <div class="card shadow-md">
                      
                        <div class="card-body text-center">
                            <!-- Gambar bundar -->
                            <img src="{{ asset('/storage/pictures/'. $employees->picture) }}" class="card-img rounded-circle mx-auto d-block mb-3" alt="Profile Picture" style="object-fit:cover; width: 150px; height: 150px;">
                            <!-- Nama -->
                            <h5 class="card-title">{{ $employees->name }}</h5>
                            <!-- Email -->
                            <p class="card-text">{{ $employees->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header"><h5>Informasi</h5></div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Full Name</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employees->name }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Email</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employees->email }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Phone Number</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employees->phone_number }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">No darurat</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employees->phone_number }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">No Identitas</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employees->identity_no }}</p>
                            </div>
                          </div>
                          <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0 font-weight-bold">Domisili</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $employees->city }}</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Alamat</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employees->address }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tanggal Lahir</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ date('d F Y', strtotime($employees->date_of_birth)) }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tempat Lahir</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{$employees->place_of_birth}}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Jenis Kelamin</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employees->gender }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Status Pernikahan</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ $employees->marital_status }}</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">PTKP</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">
                                {{$employees->ptkp}}
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
                                @if($employees->status == 'active')
                                            <span class="badge badge-success">{{ ucfirst($employees->status == 'active' ? 'Aktif' : '') }}</span>
                                        @else
                                            <span class="badge badge-danger font-weight-bold">{{ ucfirst($employees->status == 'inactive' ? 'Non Aktif' : '') }}</span>
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
                              <p class="text-muted mb-0">{{ $employees->employment_status }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tanggal Bergabung</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ date('d F Y', strtotime($employees->joining_date)) }}</p>
                            </div>
                          </div>
                        <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0 font-weight-bold">Tanggal Keluar</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ date('d F Y', strtotime($employees->exit_date)) }}</p>
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
                                            @foreach ($employees->careerHistories as $history)
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

        {{-- shift kerja --}}
        <div class="tab-pane fade" id="shift" role="tabpanel" aria-labelledby="shift-tab">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">Shift Kerja</div>
                          <div class="card-body">
                            <div class=" mb-4 d-flex justify-content-end">
                              <a href="{{ route('employee.addShift',$employees->id) }}" class="btn btn-primary">Tambah Shift</a>
                          </div>
                              <div class="card-footer">
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th>No</th>
                                              <th>Shift Kerja</th>
                                              <th>Tanggal Mulai</th>
                                              <th>Aksi</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                       @foreach($employees->shifts as $employee)
                                          <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$employee->name}}</td>
                                            <td></td>
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

      {{-- Komponen Gaji --}}
      <div class="tab-pane fade" id="salaries" role="tabpanel" aria-labelledby="salaries-tab">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h5>Gaji</h5>
                      </div>
                        <div class="card-body">
                          <div class=" mb-4 d-flex justify-content-end">
                            <a href="{{ route('employee.addSalary',$employees->id) }}" class="btn btn-primary">Tambah Gaji</a>
                        </div>
                            <div class="card-footer">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($employees->salaryComponents as $salaryComponent)
                                     {{-- @if($salaryComponent->created_at == $employees->latestSalaryDate()) --}}
                                        <tr>
                                          <td>{{$loop->iteration}}</td>
                                          <td>{{$salaryComponent->name}}</td>
                                          <td>{{"Rp " . number_format($salaryComponent->pivot->amount,2,',','.')}}</td>
                                          <td>
                                            <a href="{{ route('employee.editSalary',['employeeId' => $employees->id, 'salaryId' => $salaryComponent->id]) }}" class="btn btn-primary  btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('employee.deleteSalary', ['employeeId' => $employees->id, 'salaryId' => $salaryComponent->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger btn-sm">
                                              <i class="fas fa-trash"></i>
                                              </button>
                                            </form>
                                            {{-- <a href="{{ route('employee.deleteSalary', ['employeeId' => $employees->id, 'salaryId' => $salaryComponent->id]) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                              <i class="fas fa-trash"></i>
                                            </a> --}}
                                          {{-- <form id="delete-form-{{  $employees->id }}-{{ $salaryComponent->id }}" action="{{ route('employee.deleteSalary', ['employeeId' => $employees->id, 'salaryId' => $salaryComponent->id]) }}" method="POST" style="display: none;">
                                              @csrf
                                              @method('DELETE')
                                          </form>  --}}
                                          </td>
                                        </tr> 
                                        {{-- @endif --}}
                                     @endforeach
                                     {{-- {{dd($employees)}} --}}
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
    document.getElementById('customSwitch-{{ $employees->id }}').addEventListener('change', function() {
        document.getElementById('toggle-form-{{ $employees->id }}').submit();
    });
</script>

@endsection
