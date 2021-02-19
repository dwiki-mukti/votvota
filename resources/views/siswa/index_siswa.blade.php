@extends('luar.master')

@section('siswa','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Data SIswa</li>
        </ol>
      </div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Table Data Siswa</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 30px;">No</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>NISN</th>
                  <th style="width: 200px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach($siswa as $s)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$s->nama}}</td>
                  <td>{{$s->kelas}}</td>
                  <td>{{$s->nisn}}</td>
                  <td style="display: flex;">
                    <a href="/edit_siswa/{{$s->id}}" class="btn btn-warning">
                      <i class="fas fa-edit"></i> edit
                    </a>
                    <form method="post" action="/siswa" style="margin-left: 4px;">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="id" value="{{$s->id}}">
                      <button class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');"><i class="fas fa-trash"></i>delete</button>
                    </form>

                  </td>
                </tr>
                <?php $i++; ?>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
			</div>
		</div>
	</div>
</section>
@endsection


@section('js')
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });


        const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });


    @if(Session::has('Gagal'))
      toastr.error('{{Session::get("Gagal")}}')
    @endif
  });
</script>
@endsection