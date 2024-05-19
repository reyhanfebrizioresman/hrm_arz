@extends('layouts.template')
@section('title','Dasboard')
@section('sub-judul','Pengajuan')
@section('content')

<div class="container">
<div class="row mt-5">
  <div class="col-6">
      <div class="card">
          <div class="card-body">
            <form action="{{ route('submissions.store') }}" method="POST">
              @csrf
              <div class="form-group">
                  <label for="date" class="form-label">Kategori Cuti</label>
                  <input type="text" class="form-control" id="date" name="name">
              </div>
              <div class="form-group">
                <label for="date" class="form-label">Maksimal Cuti</label>
                <input type="number" class="form-control" id="maximum_leaves" name="maximum_leaves">
            </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
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
                <th>Hari Cuti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$category->name}}</td>
              <td>{{$category->maximum_leaves}}</td>
              <td></td>
          </tr>
          @endforeach
        </tbody>
       
    </table>
</div>

@section('addon')
<script>
  document.getElementById('status_checkbox').addEventListener('change', function() {
    var statusInput = document.getElementById('status');
    // var statusSubmissionInput = document.getElementById('status_submission');
    
    if (this.checked) {
      statusInput.value = 'approve';
    } else {
      statusInput.value = 'pending';
    }

    // statusSubmissionInput.value = 'sakit';
  });
</script>


<script>
  $(document).ready(function(){
      $('#Txt_Date').datepicker({
          format: 'yyyy-mm-dd',
          inline: false,
          language: 'en',
          autoclose: true,
          multidate: 5
      });
  });
  </script>
@endsection


@endsection