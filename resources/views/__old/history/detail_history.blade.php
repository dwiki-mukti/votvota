@extends('luar.master')

@section('history','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item"><a href="/history">History</a></li>
	              <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Detail Voting</li>
	            </ol>
          </div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">

					<div class="card card-primary card-outline">
		              <div class="card-body box-profile" style="min-height: 447px">

		                <div class="text-center">
		                  <img class="profile-user-img img-fluid img-circle" src="/adminlte/img/LOGOSTMJ.png" alt="User profile picture">
		                </div>

		                <h3 class="profile-username text-center">{{$voting->judul}}</h3>
		                <p class="text-muted text-center">Sudah Berakhir</p>

						<ul class="list-group list-group-unbordered mb-3">
		                  <li class="list-group-item">
		                    <b>Jumlah Peserta</b> <a class="float-right">{{$voting->total_peserta}} siswa</a>
		                  </li>
		                  <li class="list-group-item">
		                    <b>Pemilih</b> <a class="float-right">{{$voting->total_peserta-$voting->golput}} siswa</a>
		                  </li>
		                  <li class="list-group-item">
		                    <b>Golput</b> <a class="float-right">{{$voting->golput}} siswa</a>
		                  </li>
		                </ul>

		              </div>
		              <!-- /.card-body -->
		            </div>


				</div>


				<div class="col-md-8">

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data {{$voting->judul}}</h3>
	<div class="card-tools">
		<div></div>
	</div>
  </div>
  <div class="card-body" style="min-height: 400px">
    <div style="">
    <table class="table table-bordered table-striped table-hover" style="border: 1px solid #dee2e6; margin-bottom: 0;" id="example2">
      <thead>
        <tr>
          <th style="width: 120px;">No Kandidat</th>
          <th >Nama</th>
          <th>Perolehan Suara</th>
          <th style="width: 50px;">more</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach($kandidat as $k)
        <tr>
          <td>{{$i}}</td>
          <td>{{$k->name}}</td>
          <td>{{$k->suara}}</td>
          <td style="display: flex; padding-top: 5px; padding-bottom: 0;">

            <span data-toggle="modal" data-target="#detail-{{$k->nomer}}"  class="text-primary text-center p-fs12" style="cursor: pointer;">
              <i class="fa fa-eye"></i><p>details</p>
            </span>


<div class="modal fade" id="detail-{{$k->nomer}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">
        <div class="card card-widget widget-user-2">
          <div class="widget-user-header bg-info">
            <div class="widget-user-image">
              <img class="img-circle elevation-2" src="/images/{{$k->foto}}" alt="User Avatar">
            </div>
            <h3 class="widget-user-username">{{$k->name}}</h3>
            <h5 class="widget-user-desc">{{$k->kelas}}</h5>
            <div style="position: absolute; right: 0; top: 0; margin-top: 10px; margin-right: 17px;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-light">×</span>
              </button>

            </div>
          </div>
          <div class="card-body p-0">
    <center>
      <b>VISI</b>
      <p>{{$k->visi}}</p>

      <b>MISI</b>
      <p>{{$k->misi}}</p>
    </center>
          </div>
        </div>

        <div class="card">
        	<div class="card-body">
        		<center>
        			<h6>Suara yang di Peroleh</h6><br>
        			<h1>{{$k->suara}}</h1><br>
        		</center>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>

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
	</div>
</section>



@endsection


@section('js')
<script>
    $(document).ready(function () {
     $('#modal-detail').click(function() {
       var id=$(this).children('.idku').val();
       $('#nama').text('')
     });
    });

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