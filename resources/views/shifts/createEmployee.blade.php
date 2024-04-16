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
                    <form method="POST" action="{{ route('shifts.storeEmployee') }}">
                        @csrf
                        {{-- <div class="form-group">
                            <label for="shift">Pilih Name:</label>
                            <select name="employee_id" id="shift" class="form-control js-example-basic-multiple form-control" multiple="multiple">
                                @foreach($employee as $em)
                                    <option value="{{ $em->id }}">{{ $em->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="shift">Pilih Shift:</label>
                            <select name="shift[]" id="shift" class="form-control">
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
