@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Position')
@section('content')

<form action="{{ isset($position) ? route('positions.update', $position->id) : route('positions.store') }}" method="POST">
    @csrf
    @if(isset($position))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="job_position">Name:</label>
        <!-- Use old() to keep the old value after a validation error -->
        <input type="text" class="form-control" id="job_position" name="job_position" value="{{ old('job_position', isset($position) ? $position->job_position : '') }}">
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($position) ? 'Update' : 'Create' }}</button>
</form>


@endsection
