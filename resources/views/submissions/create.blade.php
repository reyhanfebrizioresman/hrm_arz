@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Tambah Shift  ')
@section('content')



<form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="employee_id">Nama Karyawan:*</label>
            <select class="form-control" name="employee_id" id="employee_id">
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date" class="form-label">Tanggal Pengajuan</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
          <label for="tanggal_time_off" class="form-label">Tanggal Time Off</label>
          <input type="date" class="form-control" id="tanggal_time_off" name="date_time_of">
          <small class="form-text text-muted">Atau biarkan kosong jika tidak perlu.</small>
      </div>
        <div class="form-group">
            <label for="picture" class="form-label">Bukti Sakit</label>
            <input type="file" class="form-control" id="picture" name="picture">
        </div>
        <div class="form-group">
            <label for="notes" class="form-label">Catatan</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="status_submission" name="status_submission" {{ $status === 'sakit' ? 'checked' : '' }}>
            <label class="form-check-label" for="status_submission">Setuju Pengajuan</label>
        </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>

@endsection