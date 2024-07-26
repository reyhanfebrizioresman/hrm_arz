@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Pengajuan Izin')
@section('content')


<div class="container">
    <div class=" mb-4 d-flex justify-content-end">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sickModal">
            <i class="fas fa-plus"></i> Pengajuan Izin
        </button>
    </div>

<div class="modal fade" id="sickModal" tabindex="-1" aria-labelledby="sickModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sickModalLabel">Form Pengajuan Izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('permission_leaves.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="employee_id">Nama Karyawan:*</label>
                        <select class="form-control" name="employee_id" id="employee_id">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date" class="form-label">Tanggal Pengajuan</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_time_off" class="form-label">Tanggal Time Off </label>
                        <input type="text" id="Txt_Date" class="form-control" placeholder="Choose Date" name="date_time_of[]" style="cursor: pointer;">
                  </div>
                    <div class="form-group">
                        <label for="picture" class="form-label">Bukti Sakit</label>
                        <input type="file" class="form-control" id="picture" name="picture">
                    </div>
                    <div class="form-group">
                        <label for="notes" class="form-label">Catatan</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" id="status" name="status" value="pending">
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="approve">
                        <label class="form-check-label" for="status_checkbox">Setuju Pengajuan</label>
                    </div>
                  </div>                  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
    <table id="tabel_product" class="table datatable mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Status Pengajuan</th>
                <th>Tanggal</th>
                <th>Tanggal Yang di ajukan</th>
                <th>Gambar</th>
                <th>Note</th>
                {{-- <th>Status</th> --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($permissions as $permission)
          <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$permission->employee->name}}</td>
              <td>
                @if($permission->status == 'approve')
                <span class="badge badge-success">{{$permission->status}}</span>
              @elseif($permission->status == 'pending')
                <span class="badge badge-warning">{{$permission->status}}</span>
              @else
                <span class="badge badge-danger">{{$permission->status}}</span>
              @endif
            </td>
              <td>{{$permission->date}}</td>
              <td>{{$permission->date_time_of}}</td>
              <td>{{$permission->picture ? null : '-'}}</td>
              <td>{{$permission->notes}}</td>
              {{-- <td>{{$sick->status_submission}}</td> --}}
              <td>
                @if($permission->status == 'pending')
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#statusPermissionModal{{ $permission->id }}">
                    <i class="fas fa-pen"></i>
                </button>    
                @endif    
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPermissionModal{{ $permission->id }}">
                  <i class="fas fa-edit"></i>
              </button>
              <form id="delete-form-{{ $permission->id }}" action="{{ route('permission_leaves.destroy', $permission->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteConfirmation({{ $permission->id }})" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
              </td>
          </tr>
          <div class="modal fade" id="statusPermissionModal{{ $permission->id }}" tabindex="-1" aria-labelledby="statusPermissionModal{{ $permission->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusPermissionModal{{ $permission->id }}">Persetujuan Sakit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('permission_leaves.updateStatus', $permission->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="approve" {{ $permission->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                    <option value="reject" {{ $permission->status == 'reject' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </div>
                            <input type="hidden" name="employee_id" value="{{ $permission->employee_id }}">
                            <input type="hidden" id="Txt_Date" class="form-control" placeholder="Choose Date" name="date_time_of[]" style="cursor: pointer;" value="{{ $permission->date_time_of }}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
          <div class="modal fade" id="editPermissionModal{{ $permission->id }}" tabindex="-1" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPermissionModalLabel">Form Edit Izin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('permission_leaves.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Menambahkan method PUT untuk form update -->
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="employee_id">Nama Karyawan:*</label>
                              <select class="form-control" name="employee_id" id="employee_id">
                                  @foreach($employees as $employee)
                                      <option value="{{ $employee->id }}" {{ $permission->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="date" class="form-label">Tanggal Pengajuan</label>
                              <input type="date" class="form-control" id="date" name="date" value="{{ $permission->date }}">
                          </div>
                          <div class="form-group">
                              <label for="tanggal_time_off" class="form-label">Tanggal Time Off </label>
                              <input type="text" id="Txt_Date" class="form-control" placeholder="Choose Date" name="date_time_of[]" value="{{ $permission->date_time_of }}" style="cursor: pointer;">
                          </div>
                          <div class="form-group">
                              <label for="picture" class="form-label">Bukti Sakit</label>
                              <input type="file" class="form-control" id="picture" name="picture">
                          </div>
                          <div class="form-group">
                              <label for="notes" class="form-label">Catatan</label>
                              <textarea class="form-control" id="notes" name="notes" rows="3">{{ $permission->notes }}</textarea>
                          </div>
                      </div>
                                      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
          @endforeach
        </tbody>
       
      </table>


</div>





@section('addon')
<script>
    $(document).ready( function () {
    $('#tabel_product').DataTable();
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
  $(document).ready(function(){
      $('#Txt_Date').datepicker({
          format: 'yyyy-mm-dd',
          inline: false,
          language: 'en',
          autoclose: true,
          multidate: 2,
          closeOnDateSelect: true
      });
  });
  </script>
@endsection


@endsection