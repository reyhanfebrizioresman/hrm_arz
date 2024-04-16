@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Tambah Shift  ')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">Create Shift</div> --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('employee.storeShift') }}">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="form-group">
                            <label for="shift">Pilih Shift:</label>
                            <select name="shifts[]" id="shift" class="form-control">
                                @foreach($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan Shift</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
