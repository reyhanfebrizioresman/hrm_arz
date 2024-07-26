@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Penggajian')
@section('content')

<style>
    .nav-link {
        border: none !important;
    }
    </style>

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter" style="cursor: pointer;">
            Run Payroll
        </div>
        <div id="collapseFilter" class="collapse">
            <div class="card-body">
                <p>Pilih bulan dan tahun kemudian klik tombol Generate untuk menghitung gaji</p>
                <form action="{{ route('payrolls.index') }}" method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bulan">Bulan</label>
                            <select id="bulan" name="bulan" class="form-control">
                                @foreach ($months as $monthName => $monthNumber)
                                    <option value="{{ $monthNumber }}" {{ $selectedMonth == $monthNumber ? 'selected' : '' }}>{{ $monthName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tahun">Tahun</label>
                            <select id="tahun" name="tahun" class="form-control">
                                <option selected>Pilih Tahun...</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="card mb-3 shadow-md">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Belum Di Buat</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Di Buat</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Edit Semua</button>
                    </li>
                </ul>
             </div>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        {{-- //section --}}
                        <section class="section mt-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Karyawan</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $totalEmployees ?? 0}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-warning">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                            Total Take Home Pay
                                            </div>
                                            <div class="card-body">
                                                {{ "Rp " . number_format($totalTHP, 0) }}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </section>
                    @if(isset($employees))
                    <form action="{{ route('payrolls.store') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-end mb-2">
                            <button type="submit" class="btn btn-primary" id="generate_payslip">Simpan Slip Gaji <span id="selected_count"></span></button>
                        </div>
                        {{-- <h3>Employee Attendance for {{ $months[$selectedMonth] }} {{ $selectedYear }}</h3> --}}
                        <div class="table-responsive">
                        <table id="tabel_product" class="table datatable table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select_all" >
                                    </th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Take Home Pay</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="employee_ids[]" value="{{ $employee->id }}" class="employee_checkbox">
                                            <input type="hidden" name="positions[]" value="{{ $employee->careerHistories->last()->position->job_position ?? '' }}">
                                            <input type="hidden" name="periods[]" value="{{ $selectedYear . '-' . $selectedMonth . '-26'}}">
                                            {{-- <input type="hidden" name="periods[]" value="{{ $employee->attendance->date->first() ?? null }}"> --}}
                                            <input type="hidden" name="basic_salaries[]" value="{{ $employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount ?? 0 }}">
                                            <input type="hidden" name="overtimes[]" value="{{ $employee->totalOvertimePay ?? 0 }}">
                                            <input type="hidden" name="lates[]" value="{{ $employee->latePinalty ?? 0 }}">
                                            <input type="hidden" name="total_pays[]" value="{{ $employee->totalSalary ?? 0 }}">
                                            <input type="hidden" name="bulan" value="{{ $selectedMonth }}">
                                            <input type="hidden" name="tahun" value="{{ $selectedYear }}">
                                        </td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{$employee->careerHistories->last()->position->job_position ?? null}}</td>
                                        {{-- <td>{{$employee->attendance->first()->date}}</td> --}}
                                        <td>{{"Rp "  .number_format($employee->totalSalary, 2 )}}</td>
                                        @if($employee->attendance != null)
                                    <td><!-- Button trigger modal -->
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#payrollModal{{ $employee->id }}">
                                            <i class="fas fa-list-ul"></i> Detail
                                        </button>
                                    
                                        <!-- Modal -->
                                        <div class="modal fade" id="payrollModal{{ $employee->id }}" tabindex="-1" aria-labelledby="payrollModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="payrollModalLabel">Detail Gaji</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center mb-3">
                                                            <h5 class="mb-1">{{$employee->name}}</h5>
                                                            <small class="text-muted">{{$employee->careerHistories->last()->position->job_position ?? null}}</small>
                                                        </div>
                                    
                                                        <h6>Pendapatan</h6>
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama</th>
                                                                    <th class="text-right">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Gaji Pokok</td>
                                                                    <td class="text-right">{{"Rp " . number_format($employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount,0,',','.')}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lembur</td>
                                                                    <td class="text-right">{{"Rp "  .number_format($employee->totalOvertimePay, 2)}}</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total Pendapatan</th>
                                                                    <th class="text-right">{{"Rp "  .number_format($employee->totalOvertimePay + $employee->gapok, 2)}}</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                    
                                                        <h6>Potongan</h6>
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama</th>
                                                                    <th class="text-right">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Telat</td>
                                                                    <td class="text-right">{{"Rp "  .number_format ($employee->latePinalty,2 )}}</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total Potongan</th>
                                                                    <th class="text-right">{{"Rp "  .number_format($employee->latePinalty,2)}}</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                    
                                                        <div class="bg-light p-3 text-right">
                                                            {{"Rp "  .number_format($employee->totalSalary,2)}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>  
                        </form>
                        @endif
                    </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    {{-- <h3>Employee Attendance for {{ $months[$selectedMonth] }} {{ $selectedYear }}</h3> --}}

                        {{-- //section --}}
                        <section class="section mt-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Karyawan</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $employeePayrolls ?? 0}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-warning">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                            Total Take Home Pay
                                            </div>
                                            <div class="card-body">
                                                {{ "Rp " . number_format($totalThpPayrolls, 0) }}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </section>
                    <form action="{{ route('payrolls.payrollExport') }}" method="POST" class="mt-3 mb-3" >
                        @csrf
                        <input type="hidden" name="bulan" value="{{ $selectedMonth }}">
                        <input type="hidden" name="tahun" value="{{ $selectedYear }}">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success"><i class="fas fa-file-download"></i> Export to Excel</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                    <table id="table" class="table datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Gaji Pokok</th>
                                <th>Take Home Pay</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payrolls as $payroll)
                           
                                <tr>
                                    <td>{{ $payroll->employee->name ?? null }}</td>
                                    <td>{{$payroll->position ?? null}}</td>
                                <td>{{ "Rp " . number_format($payroll->basic_salary ?? null,0)}}</td>
                                <td>{{ "Rp " . number_format($payroll->total_pay ?? null,0)}}</td>
                                <td>
                                    <a href="{{ route('payrolls.generatePdf', $payroll->id) }}" class="btn btn-success btn-sm"><i class="fas fa-print"></i></a>
                                    {{-- <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a> --}}
                                    <form id="delete-form-{{ $payroll->id }}" action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="bulan" value="{{ $selectedMonth }}">
                                        <input type="hidden" name="tahun" value="{{ $selectedYear }}">
                                        <button type="button" onclick="deleteConfirmation({{ $payroll->id }})" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#payrollCreateModal{{ $payroll->employee_id }}">
                                        <i class="fas fa-list-ul"></i>
                                    </button>

                                    <div class="modal fade" id="payrollCreateModal{{ $payroll->employee_id }}" tabindex="-1" aria-labelledby="payrolCreatelModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="payrolCreatelModalLabel">Detail Gaji</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center mb-3">
                                                        <h5 class="mb-1">{{$payroll->employee->name}}</h5>
                                                    </div>
                                
                                                    <h6>Pendapatan</h6>
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th class="text-right">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Gaji Pokok</td>
                                                                <td class="text-right">{{"Rp " . number_format($payroll->basic_salary,2)}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Lembur</td>
                                                                <td class="text-right">{{"Rp "  .number_format($payroll->overtime_pay, 2)}}</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Total Pendapatan</th>
                                                                <th class="text-right">{{"Rp "  .number_format($payroll->overtime_pay + $payroll->basic_salary, 2)}}</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                
                                                    <h6>Potongan</h6>
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th class="text-right">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Telat</td>
                                                                <td class="text-right">{{"Rp "  .number_format($payroll->late_pay, 2)}}</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Total Potongan</th>
                                                                <th class="text-right">{{"Rp "  .number_format($payroll->late_pay, 2)}}</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                
                                                    <div class="bg-light p-3 text-right">
                                                        {{"Rp "  .number_format($payroll->total_pay, 2)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>  
                 </div>

                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <!-- Form Edit Semua -->
                    <form action="{{ route('payrolls.updateAll') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Gaji Pokok</th>
                                        <th>Lembur</th>
                                        <th>Telat</th>
                                        <th>Take Home Pay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payrolls as $payroll)
                                        <tr>
                                            <td>{{ $payroll->employee->name }}</td>
                                            <td>{{ $payroll->employee->careerHistories->last()->position->job_position ?? '' }}</td>
                                            <td><input type="number" name="basic_salary[{{ $payroll->id }}]" value="{{ $payroll->basic_salary }}" class="form-control"></td>
                                            <td>
                                                <input type="number" name="overtime_pay[{{ $payroll->id }}]" value="{{ $payroll->overtime_pay }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" name="late_pay[{{ $payroll->id }}]" value="{{ $payroll->late_pay }}" class="form-control">
                                            </td>
                                            <td>
                                               {{$payroll->total_pay}}
                                            </td>
                                            <input type="hidden" name="bulan" value="{{ $selectedMonth }}">
                                            <input type="hidden" name="tahun" value="{{ $selectedYear }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Update Payrolls</button>
                        </div>
                    </form>

              </div>


        </div>
    </div>
</div>
@section('addon')


        <script>
            $(document).ready( function () {
            $('#tabel_product').DataTable();
        } );
        </script>
        <script>
            $(document).ready( function () {
            $('#table_dibuat').DataTable();
        } );
        </script>

<script>
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Buat sebuah form dengan method DELETE dan action yang sesuai
                // Temukan formulir berdasarkan ID
              let form = document.getElementById('delete-form-' + id);
              // Submit formulir
              form.submit();
            }
        })
    }
</script>

    <script>
        document.getElementById('select_all').onclick = function() {
            var checkboxes = document.querySelectorAll('.employee_checkbox');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
            updateSelectedCount();
        }

        document.querySelectorAll('.employee_checkbox').forEach(function(checkbox) {
            checkbox.onclick = function() {
                updateSelectedCount();
            }
        });

        function updateSelectedCount() {
            var selectedCount = document.querySelectorAll('.employee_checkbox:checked').length;
            document.getElementById('selected_count').innerText = '(' + selectedCount + ' Tersimpan)';
        }
    </script>
        @endsection
@endsection