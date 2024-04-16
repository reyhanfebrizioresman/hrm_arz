@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Karyawan')
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
            <h4>Perbarui Karyawan</h4>
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
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Foto:</label>
                        <input type="file" class="form-control" name="picture" accept="image/*"
                            onchange="loadFile(event)">
                        <div class="image-box">
                            <img id="output" style="max-width: 100%; max-height: 100%;" src="{{ asset('/storage/pictures/'. $employee->picture) }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone_number">No hp:</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ $employee->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="emergency_number">No Darurat:</label>
                        <input type="number" class="form-control" id="emergency_number" name="emergency_number" value="{{ $employee->emergency_number }}">
                    </div>
                    <div class="form-group">
                        <label for="identity_no">No Identitas:</label>
                        <input type="number" class="form-control" id="identity_no" name="identity_no" value="{{ $employee->identity_no }}">
                    </div>
                    <div class="form-group">
                        <label for="religion">Agama:</label>
                        <select class="form-control" id="religion" name="religion" required>
                            <option value="">Pilih Agama</option>
                            <option value="islam" {{ $employee->religion == 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="christianity" {{ $employee->religion == 'christianity' ? 'selected' : '' }}>Kristen</option>
                            <option value="hinduism" {{ $employee->religion == 'hinduism' ? 'selected' : '' }}>Hindu</option>
                            <option value="buddhism" {{ $employee->religion == 'buddhism' ? 'selected' : '' }}>Budha</option>
                            <option value="other" {{ $employee->religion == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Kota:</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $employee->city }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_birth">Tanggal Lahir:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $employee->date_of_birth }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_birth">Tempat Lahir:</label>
                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ $employee->place_of_birth }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat:</label>
                        <textarea class="form-control" id="address" name="address">{{ $employee->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="marital_status">Status Pernikahan:</label>
                        <select class="form-control" id="marital_status" name="marital_status">
                            <option value="single" {{ $employee->marital_status == 'single' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="married" {{ $employee->marital_status == 'married' ? 'selected' : '' }}>Menikah</option>
                            <option value="divorced" {{ $employee->marital_status == 'divorced' ? 'selected' : '' }}>Cerai</option>
                            <option value="widowed" {{ $employee->marital_status == 'widowed' ? 'selected' : '' }}>Janda/Duda</option>
                        </select>
                    </div>
                </div>
                <!-- Kolom 2: Form Perusahaan -->
                <div class="col-md-6">
                    <h5>Data Karyawan</h5>
                    <div class="form-group">
                        <label for="status">PTKP:</label>
                        <select class="form-control" id="ptkp" name="ptkp">
                            <option value="TK0" {{ (old('status', $employee->ptkp ?? '') == 'TK0') ? 'selected' : '' }}>Lajang - 0 tanggungan</option>
                            <option value="TK1" {{ (old('status', $employee->ptkp ?? '') == 'TK1') ? 'selected' : '' }}>Lajang - 1 tanggungan</option>
                            <option value="TK2" {{ (old('status', $employee->ptkp ?? '') == 'TK2') ? 'selected' : '' }}>Lajang - 2 tanggungan</option>
                            <option value="TK3" {{ (old('status', $employee->ptkp ?? '') == 'TK3') ? 'selected' : '' }}>Lajang - 3 tanggungan</option>
                            <option value="K0" {{ (old('status', $employee->ptkp ?? '') == 'K0') ? 'selected' : '' }}>Menikah - 0 tanggungan</option>
                            <option value="K1" {{ (old('status', $employee->ptkp ?? '') == 'K1') ? 'selected' : '' }}>Menikah - 1 tanggungan</option>
                            <option value="K2" {{ (old('status', $employee->ptkp ?? '') == 'K2') ? 'selected' : '' }}>Menikah - 2 tanggungan</option>
                            <option value="K3" {{ (old('status', $employee->ptkp ?? '') == 'K3') ? 'selected' : '' }}>Menikah - 3 tanggungan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employment_status">Status Karyawan:</label>
                        <select class="form-control" id="employment_status" name="employment_status">
                            <option value="full-time" {{ $employee->employment_status == 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ $employee->employment_status == 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ $employee->employment_status == 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="joining_date">Tanggal Masuk:</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ $employee->joining_date }}">
                    </div>
                    <div class="form-group">
                        <label for="exit_date">Tanggal Keluar:</label>
                        <input type="date" class="form-control" id="exit_date" name="exit_date" value="{{ $employee->exit_date }}">
                    </div>
                    <div class="form-group">
                        <label for="shift">Pilih Shift:</label>
                        <select name="shifts[]" id="shift" class="form-control">
                            @foreach($shifts as $shift)
                                <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
                </div>
                
            </div>
            
        </form>
    </div>
</div>


<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>


@endsection
