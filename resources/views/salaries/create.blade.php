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
                <form action="{{ route('salaries.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="basic_salary">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori:</label>
                        <select class="form-control" id="category" name="category">
                            <option value="income">Income</option>
                            <option value="deduction">Deductions</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
