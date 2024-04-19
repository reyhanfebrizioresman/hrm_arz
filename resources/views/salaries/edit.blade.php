@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Tambah Shift  ')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Salary Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('salaries.update', $salaries->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="basic_salary">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$salaries->name}}">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori:</label>
                        <select class="form-control" id="category" name="category">
                            <option value="income" {{$salaries->category == 'income' ? 'selected' : ''}}>Penambahan</option>
                            <option value="deduction" {{$salaries->category == 'deduction' ? 'selected' : ''}}>Pengurangan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
