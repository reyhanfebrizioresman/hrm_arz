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
                        <label for="basic_salary">Basic Salary:</label>
                        <input type="number" class="form-control" id="basic_salary" name="basic_salary" value="{{$salaries->basic_salary}}">
                    </div>

                    <div class="form-group">
                        <label for="allowance">Allowances:</label>
                        <input type="number" class="form-control" id="allowance" name="allowance" value="{{$salaries->allowance}}">
                    </div>

                    {{-- <div class="form-group">
                        <label for="bonus">Bonus:</label>
                        <input type="text" class="form-control" id="bonus" name="bonus">
                    </div> --}}

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control" id="category" name="category">
                            <option value="income" {{$salaries->category == 'income' ? 'selected' : ''}}>Income</option>
                            <option value="deduction" {{$salaries->category == 'deduction' ? 'selected' : ''}}>Deductions</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
