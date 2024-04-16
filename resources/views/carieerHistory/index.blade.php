@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Riwayat Karir')
@section('content')

    <div class="container">
        <!-- Button trigger modal -->
        <div class=" mb-4 d-flex justify-content-end">
            <a href="{{ route('carieerHistory.create') }}" class="btn btn-primary">Tambah Karir</a>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                   <div class="modal-body">
                     <div class="form-group">
                        <label>Name Category</label>
                        <input class="form-control" type="text" name="nama_categories" placeholder="Name Category">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>    
    </div>

      <!-- Modal -->
      {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('carieerHistory.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="employee_id">Karyawan:</label>
                    <select class="form-control" name="employee_id" id="employee_id">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="position_id">Posisi:</label>
                    <select class="form-control" name="position_id" id="position_id">
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->job_position }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="department_id">Departemen:</label>
                    <select class="form-control" name="department_id" id="department_id">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Tanggal:</label>
                    <input type="date" class="form-control" name="date" id="date">
                </div>
                <button type="submit" class="btn btn-primary mt-1">Kirim</button>
            </form>
            </div>
          </div>
        </div>
      </div> --}}

      <div class="table-responsive">
            <table class="data table" id="tabel_product">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Karyawan</th>
                        <th>Posisi</th>
                        <th>Departemen</th>
                        <th>Tanggal</th>
                        <th>Ubah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($careerHistories as $careerHistory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $careerHistory->employee->name }}</td>
                        <td>{{ $careerHistory->position->job_position }}</td>
                        <td>{{ $careerHistory->department->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($careerHistory->date)) }}</td>
                        <td><!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary bg-primary btn-sm" data-toggle="modal" data-target="#editCareerHistoryModal">
                        <i class="fas fa-edit"></i>               
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade z-3" id="editCareerHistoryModal" tabindex="-1" role="dialog" aria-labelledby="editCareerHistoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog z-index: 100" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCareerHistoryModalLabel">Ubah Riwayat Karir</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('carieerHistory.update', $careerHistory->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="employee_id">Karir:</label>
                                                    <select class="form-control" name="employee_id" id="employee_id">
                                                        @foreach($employees as $employee)
                                                            <option value="{{ $employee->id }}" {{ $careerHistory->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="position_id">Posisi:</label>
                                                    <select class="form-control" name="position_id" id="position_id">
                                                        @foreach($positions as $position)
                                                            <option value="{{ $position->id }}" {{ $careerHistory->position_id == $position->id ? 'selected' : '' }}>{{ $position->job_position }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="department_id">Departemen:</label>
                                                    <select class="form-control" name="department_id" id="department_id">
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}" {{ $careerHistory->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Tanggal:</label>
                                                    <input type="date" class="form-control" name="date" id="date" value="{{ $careerHistory->date }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary bg-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('carieerHistory.destroy', $careerHistory->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                <i class="fas fa-trash"></i>
                            </a>
                            <form id="delete-form-{{ $careerHistory->id }}" action="{{ route('carieerHistory.destroy', $careerHistory->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
        </div>
        @section('addon')
        <script>
            $(document).ready( function () {
            $('#tabel_product').DataTable();
        } );
        </script>
        @endsection
        @endsection