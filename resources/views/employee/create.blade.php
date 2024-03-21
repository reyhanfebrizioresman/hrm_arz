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
    {{-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif --}}
    <div class="card">
        <div class="card-header">
            <h4>Create Employee</h4>
        </div>
        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="card-body">
                <div class="row">
                    <!-- Kolom 1: Form Pribadi -->
                    <div class="col-md-6">
                    <h5>Data Pribadi</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture:</label>
                            <input type="file" id="image" name="picture" onchange="previewImage(event)">
                            <div id="image-preview"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_number">Emergency Number:</label>
                                    <input type="number" class="form-control" id="emergency_number" name="emergency_number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="identity_no">Identity Number:</label>
                            <input type="number" class="form-control" id="identity_no" name="identity_no">
                        </div>
                        <div class="form-group">
                            <label for="religion">Religion:</label>
                            <select class="form-control" id="religion" name="religion" required>
                                <option value="">Select Religion</option>
                                <option value="islam">Islam</option>
                                <option value="christianity">Christianity</option>
                                <option value="hinduism">Hinduism</option>
                                <option value="buddhism">Buddhism</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City:</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth:</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                                </div>
                            </div>
                        </div>
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
                    </div>
                    <!-- Kolom 2: Form Perusahaan -->
                    <div class="col-md-6">
                        <h5>Data Karyawan</h5>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
