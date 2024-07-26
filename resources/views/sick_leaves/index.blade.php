@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Pengajuan Sakit')
@section('content')


<div class="container">
    <div class=" mb-4 d-flex justify-content-end">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sickModal">
        <i class="fas fa-plus"></i> Pengajuan Sakit
    </button>
</div>


<div class="modal fade" id="sickModal" tabindex="-1" aria-labelledby="sickModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sickModalLabel">Form Pengajuan Sakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sick_leaves.store') }}" method="POST" enctype="multipart/form-data">
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
                      <label for="tanggal_time_off" class="form-label">Tanggal Time Off</label>
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
                  {{-- <input type="hidden" id="status_submission" name="status_submission" value="sakit"> --}}
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
    <table id="tabel_product" class="table datatable mt-2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Status Pengajuan</th>
                <th>Tanggal</th>
                <th>Tanggal Yang Di Ajukan</th>
                <th>Gambar</th>
                <th>Note</th>
                {{-- <th>Status</th> --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($sicks as $sick)
          <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$sick->employee->name}}</td>
              <td>
                @if($sick->status == 'approve')
                <span class="badge badge-success">{{$sick->status}}</span>
              @elseif($sick->status == 'pending')
                <span class="badge badge-warning">{{$sick->status}}</span>
              @else
                <span class="badge badge-danger">{{$sick->status}}</span>
              @endif
            </td>
            <td>{{$sick->date}}</td>
              <td>{{$sick->date_time_of}}</td>
              <td>{{$sick->picture ? null : '-'}}</td>
              <td>{{$sick->notes}}</td>
              {{-- <td>{{$sick->status_submission}}</td> --}}
              <td>
                @if($sick->status == 'pending')
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#statusSickModal{{ $sick->id }}">
                    <i class="fas fa-pen"></i>
                </button>    
                @endif    
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSickModal{{ $sick->id }}">
                <i class="fas fa-edit"></i>
              </button>
                <form id="delete-form-{{ $sick->id }}" action="{{ route('sick_leaves.destroy', $sick->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="button" onclick="deleteConfirmation({{ $sick->id }})" class="btn btn-danger btn-sm">
                      <i class="fas fa-trash"></i>
                  </button>
              </form>
              </td>
          </tr>

          <div class="modal fade" id="statusSickModal{{ $sick->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $sick->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel{{ $sick->id }}">Persetujuan Sakit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('sick_leaves.updateStatus', $sick->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="approve" {{ $sick->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                    <option value="reject" {{ $sick->status == 'reject' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </div>
                            <input type="hidden" name="employee_id" value="{{ $sick->employee_id }}">
                            <input type="hidden" id="Txt_Date" class="form-control" placeholder="Choose Date" name="date_time_of[]" style="cursor: pointer;" value="{{ $sick->date_time_of }}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

          <div class="modal fade" id="editSickModal{{ $sick->id }}" tabindex="-1" aria-labelledby="sickModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sickModalLabel">Form Edit Pengajuan Sakit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('sick_leaves.update', $sick->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="modal-body">
                            <div class="form-group">
                                <label for="employee_id">Nama Karyawan:*</label>
                                <select class="form-control" name="employee_id" id="employee_id">
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == $sick->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date" class="form-label">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $sick->date }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_time_off" class="form-label">Tanggal Time Off</label>
                                <input type="text" id="Txt_Date" class="form-control" placeholder="Choose Date" name="date_time_of[]" style="cursor: pointer;" value="{{ $sick->date_time_of }}">
                            </div>
                            <div class="form-group">
                                <label for="picture" class="form-label">Bukti Sakit</label>
                                <input type="file" class="form-control" id="picture" name="picture">
                            </div>
                            <div class="form-group">
                                <label for="notes" class="form-label">Catatan</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $sick->notes }}</textarea>
                            </div>
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
          multidate: 2
      });
  });
  </script>
@endsection


@endsection