@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Pengajuan Cuti')
@section('content')


<div class="container">
    <div class=" mb-4 d-flex justify-content-end">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#leaveModal">
            <i class="fas fa-plus"></i> Pengajuan Cuti
        </button>
    </div>

<div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="leaveModalLabel">Form Pengajuan Cuti</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('paid_leaves.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="categories_id">Kategori Cuti:*</label>
                    <select class="form-control" name="categories_id" id="categories_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" data-maximum-leaves="{{ $category->maximum_leaves }}"">{{ $category->name }} -- max hari : {{ $category->maximum_leaves}}</option>
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

</div>
    <table id="tabel_product" class="table datatable mt-2">
        <thead>
            <tr>    
                <th>No.</th>
                <th>Nama</th>
                <th>Kategori Cuti</th>
                <th>Status Pengajuan</th>
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Yang Di Ajukan</th>
                <th>Note</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($leaves as $leave)
          <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$leave->employee->name}}</td>
              <td>{{$leave->categories->name}}</td>
              <td>
                @if($leave->status == 'approve')
                  <span class="badge badge-success">{{$leave->status}}</span>
                @elseif($leave->status == 'pending')
                  <span class="badge badge-warning">{{$leave->status}}</span>
                @else
                  <span class="badge badge-danger">{{$leave->status}}</span>
                @endif
                </td>
              <td>{{$leave->date}}</td>
              <td>{{$leave->date_time_of}}</td>
              <td>{{$leave->notes}}</td>
              <td>
                @if($leave->status == 'pending')
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#statusLeaveModal{{ $leave->id }}">
                    <i class="fas fa-pen"></i>
                </button>    
                @endif            
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editLeaveModal{{ $leave->id }}">
                    <i class="fas fa-edit"></i>
                  </button>
                  <form id="delete-form-{{ $leave->id }}" action="{{ route('paid_leaves.destroy', $leave->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteConfirmation({{ $leave->id }})" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
              </td>
          </tr>
          <div class="modal fade" id="statusLeaveModal{{ $leave->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $leave->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel{{ $leave->id }}">Form Edit Pengajuan Cuti</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('paid_leaves.updateStatus', $leave->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="approve" {{ $leave->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                    <option value="reject" {{ $leave->status == 'reject' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </div>
                            <input type="hidden" name="employee_id" value="{{ $leave->employee_id }}">
                            <input type="hidden" id="Txt_Date" class="form-control" placeholder="Choose Date" name="date_time_of[]" style="cursor: pointer;" value="{{ $leave->date_time_of }}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
          <div class="modal fade" id="editLeaveModal{{ $leave->id }}" tabindex="-1" aria-labelledby="sickModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sickModalLabel">Form Edit Pengajuan Cuti</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('paid_leaves.update', $leave->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="modal-body">
                            <div class="form-group">
                                <label for="employee_id">Nama Karyawan:*</label>
                                <select class="form-control" name="employee_id" id="employee_id">
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == $leave->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date" class="form-label">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $leave->date }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_time_off" class="form-label">Tanggal Time Off</label>
                                <input type="text" id="Txt_Date" class="form-control" placeholder="Choose Date" name="date_time_of[]" style="cursor: pointer;" value="{{ $leave->date_time_of }}">
                            </div>
                            <div class="form-group">
                                <label for="notes" class="form-label">Catatan</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $leave->notes }}</textarea>
                            </div>
                            {{-- <input type="hidden" name="status" value="{{ $leave->status }}"> --}}
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
            multidate: 5,
            beforeShowDay: function(date){
                var maximumLeaves = parseInt($('#categories_id option:selected').data('maximum-leaves'));
                var selectedDates = $('#Txt_Date').datepicker('getDates');
                if (selectedDates.length >= maximumLeaves) {
                    return {
                        enabled: false,
                        classes: 'date-disabled',
                        tooltip: 'Maximum leaves exceeded'
                    };
                } else {
                    return {
                        enabled: true
                    };
                }
            }
        });
        
        // Mendengarkan perubahan pada elemen select dengan id 'categories_id'
        $('#categories_id').change(function() {
            // Mendapatkan nilai maksimum hari cuti dari opsi terpilih
            var maximumLeaves = parseInt($(this).find('option:selected').data('maximum-leaves'));
            
            // Memperbarui pesan peringatan dengan nilai maksimum hari cuti yang dipilih
            var warningMessage = 'Anda hanya dapat memilih ' + maximumLeaves + ' hari cuti';
  
            // Menghapus pesan peringatan yang mungkin ada
            $('#warning_message').html('');
  
            // Mendengarkan perubahan pada elemen input tanggal
            $('.date_picker').change(function() {
                // Mendapatkan tanggal yang dipilih
                var selectedDates = $('.date_picker:checked');
  
                // Memeriksa apakah jumlah tanggal yang dipilih melebihi batas maksimum
                if (selectedDates.length > maximumLeaves) {
                    // Menampilkan pesan peringatan jika melebihi batas maksimum
                    $('#warning_message').html(warningMessage);
                    // Reset nilai input tanggal yang terakhir dipilih
                    $(this).prop('checked', false);
                }
            });
        });
    });
  </script>


  
@endsection


@endsection