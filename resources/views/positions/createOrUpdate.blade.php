@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Position')
@section('content')
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
<form id="myForm" action="{{ isset($position) ? route('positions.update', $position->id) : route('positions.store') }}" method="POST">
    @csrf
    @if(isset($position))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="job_position">Nama:</label>
        <!-- Use old() to keep the old value after a validation error -->
        <input type="text" class="form-control" id="job_position" name="job_position" value="{{ old('job_position', isset($position) ? $position->job_position : '') }}">
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($position) ? 'Update' : 'Create' }}</button>
</form>

@endsection
