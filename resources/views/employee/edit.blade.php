@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Employee')
@section('content')
<style>
    #image-preview {
        width: 200px;
        height: 200px;
        border: 1px solid #ddd;
        margin-top: 10px;
        display: none;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Update Employee</h4>
        </div>
        <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <!-- Kolom 1: Form Pribadi -->
                <div class="col-md-6">
                    <h5>Data Pribadi</h5>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
                    </div>
                    <div class="form-group">
                        <label for="picture">Picture:</label>
                        <input type="file" id="image" name="picture" onchange="previewImage(event)">
                        <div id="image-preview">
                            <img src="{{ asset('storage/pictures/' . $employee->picture) }}" alt="Employee Picture" style="max-width: 200px; max-height: 200px;">  
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ $employee->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="emergency_number">Emergency Number:</label>
                        <input type="number" class="form-control" id="emergency_number" name="emergency_number" value="{{ $employee->emergency_number }}">
                    </div>
                    <div class="form-group">
                        <label for="identity_no">Identity Number:</label>
                        <input type="number" class="form-control" id="identity_no" name="identity_no" value="{{ $employee->identity_no }}">
                    </div>
                    <div class="form-group">
                        <label for="religion">Religion:</label>
                        <select class="form-control" id="religion" name="religion" required>
                            <option value="">Select Religion</option>
                            <option value="islam" {{ $employee->religion == 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="christianity" {{ $employee->religion == 'christianity' ? 'selected' : '' }}>Christianity</option>
                            <option value="hinduism" {{ $employee->religion == 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                            <option value="buddhism" {{ $employee->religion == 'buddhism' ? 'selected' : '' }}>Buddhism</option>
                            <option value="other" {{ $employee->religion == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $employee->city }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $employee->date_of_birth }}">
                            </div>
                        </div>
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
                </div>
                <!-- Kolom 2: Form Perusahaan -->
                <div class="col-md-6">
                    <h5>Data Karyawan</h5>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                        <label for="joining_date">Joining Date:</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ $employee->joining_date }}">
                    </div>
                    <div class="form-group">
                        <label for="exit_date">Exit Date:</label>
                        <input type="date" class="form-control" id="exit_date" name="exit_date" value="{{ $employee->exit_date }}">
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
                </div>
                
            </div>
            
        </form>
    </div>
</div>


  <script>
    function previewImage(event) {
        const reader = new FileReader();
        const imagePreview = document.getElementById('image-preview');
        reader.onload = function() {
            imagePreview.style.display = 'block';
            imagePreview.innerHTML = `<img src="${reader.result}" alt="Image Preview" style="max-width: 100%; max-height: 100%;">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
