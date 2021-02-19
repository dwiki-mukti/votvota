@extends('luar.master')

@section('dashboard','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
          <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Belum Memilih</li>
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
            <h3 class="card-title">Siswa yang belum melakukan pemilihan</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 30px;">No</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>NISN</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=1;
                 ?>
                @foreach($siswa as $s)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$s->nama}}</td>
                  <td>{{$s->kelas}}</td>
                  <td>{{$s->id}}</td>
                </tr>
                <?php $i++; ?>
                @endforeach
              </tfoot>
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
  });
</script>
@endsection