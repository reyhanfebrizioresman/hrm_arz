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
                                    <label for="name">Nama:</label>
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
                            <label for="picture">Gambar:</label>
                            <input type="file" id="image" name="picture" onchange="previewImage(event)">
                            <div id="image-preview"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">No Hp:</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_number">No Darurat:</label>
                                    <input type="number" class="form-control" id="emergency_number" name="emergency_number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="identity_no">No Identitas:</label>
                            <input type="number" class="form-control" id="identity_no" name="identity_no">
                        </div>
                        <div class="form-group">
                            <label for="religion">Agama:</label>
                            <select class="form-control" id="religion" name="religion" required>
                                <option value="">Select Religion</option>
                                <option value="islam">Islam</option>
                                <option value="christianity">Kristen</option>
                                <option value="hinduism">Hindu</option>
                                <option value="buddhism">Budha</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="male">Laki - Laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">Tempat lahir:</label>
                                    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">Domisili:</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Alamat:</label>
                                    <textarea class="form-control" id="address" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                
                <div class="form-group">
                            <label for="marital_status">Status Pernikahan:</label>
                            <select class="form-control" id="marital_status" name="marital_status">
                                <option value="single">Belum Menikah</option>
                                <option value="married">Menikah</option>
                                <option value="divorced">Cerai</option>
                                <option value="widowed">Janda/Duda</option>
                            </select>
                        </div>
                    </div>
                    <!-- Kolom 2: Form Perusahaan -->
                    <div class="col-md-6">
                        <h5>Data Karyawan</h5>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Aktif</option>
                                <option value="inactive">Non Aktif</option>
                            </select>
                        </div>
                <div class="form-group">
                            <label for="employment_status">Status Karyawan:</label>
                            <select class="form-control" id="employment_status" name="employment_status">
                                <option value="full-time">Full Time</option>
                                <option value="part-time">Part Time</option>
                                <option value="contract">Contract</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="joining_date">Tanggal masuk:</label>
                            <input type="date" class="form-control" id="joining_date" name="joining_date">
                        </div>
                        <div class="form-group">
                            <label for="exit_date">Tanggal Keluar:</label>
                            <input type="date" class="form-control" id="exit_date" name="exit_date">
                        </div>
                        <h5>Karir Histori</h5>
                       
                    
                        <div class="form-group">
                            <label for="position_id">Position:</label>
                            <select class="form-control" name="position_id" id="position_id">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->job_position }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="department_id">Department:</label>
                            <select class="form-control" name="department_id" id="department_id">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" name="date" id="date">
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
