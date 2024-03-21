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
   <div class="dropdown d-flex justify-content-end">
    <button class="btn btn-success dropdown-toggle mt-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Option
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('employee.edit', $employee->id) }}">Edit</a>
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $employee->id }}').submit();">Non Aktif</a>
        <form id="delete-form-{{ $employee->id }}" action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
   <!-- Isi tab -->
   <div class="tab-content" id="myTabContent">
       <!-- Tab Profile -->
       <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="row">
           <!-- Kolom 1: Image dan Career History -->
           <div class="col-md-6">
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
           <div class="col-md-6">
               <div class="card">
                   <h5>Informasi</h5>
                   <div class="card-body">
                       <!-- Form Employee -->
                       <div class="row">
                           <div class="col-md-6">
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
                               <table class="table">
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

  @endsection
