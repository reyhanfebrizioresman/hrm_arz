@extends('layouts.template')
@section('title','Departemen')
@section('sub-judul','Departemen')
@section('content')
<form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}" method="POST">
    @csrf
    @if(isset($department))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ isset($department) ? $department->name : '' }}">
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($department) ? 'Ubah' : 'Buat' }}</button>
</form>
@endsection
