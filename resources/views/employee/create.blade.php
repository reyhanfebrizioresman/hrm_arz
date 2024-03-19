@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Employee')
@section('content')
<div class="card">
      <div class="card-header">
        <h4>Create Employee</h4>
      </div>
      <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
        @method('post')
        @csrf
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="marital_status">Marital Status:</label>
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
            </div>
        </div>
      </div>
      <div class="card-footer text-right">
        <button class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>

@endsection