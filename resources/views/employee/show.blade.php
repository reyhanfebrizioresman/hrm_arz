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
    
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{$employee->name}}</span><span class="text-black-50">{{$employee->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
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
            </div>      
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
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
                {{-- <div class="form-group">
                    <label for="picture">Picture:</label>
                    <input type="file" class="form-control-file" id="picture" name="picture">
                </div> --}}
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
</div>
</div>
</div>

  @endsection