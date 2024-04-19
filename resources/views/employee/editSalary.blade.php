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
                    <form method="POST" action="{{ route('employee.updateSalary',['employeeId' => $employee->id, 'salaryId' => $salaryComponent->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="form-group">
                            <label for="name">Nama Gaji:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $salaryComponent->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah:</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{ $salaryComponent->pivot->amount }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan Shift</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectedSalaries = JSON.parse(document.getElementById('selectedSalaries').value);
        const dropdown = document.getElementById('salaries');

        dropdown.addEventListener('change', function() {
            const selectedOption = dropdown.options[dropdown.selectedIndex];
            const selectedValue = parseInt(selectedOption.value);

            const index = selectedSalaries.indexOf(selectedValue);
            if (index !== -1) {
                selectedSalaries.splice(index, 1); // hapus opsi yang sudah dipilih dari daftar
                dropdown.removeChild(selectedOption); // hapus opsi dari dropdown
            }
        });
    });
</script>




@endsection
