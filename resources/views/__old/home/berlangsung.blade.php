@extends('luar.master')

@section('dashboard','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Dashboard</li>
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
            <h3 class="profile-username text-center">{{$voting[0]->judul}}</h3>
            <p class="text-muted text-center">Sedang Berlangsung</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Jumlah Peserta</b>
                <a class="float-right">{{$total}} siswa</a>
              </li>
              <li class="list-group-item">
                <b>Belum Memilih</b>
                <a href="/{{$voting[0]->id}}/belum-memilih" class="float-right btn btn-outline-warning btn-sm">{{$student}} siswa</a>
              </li>
            </ul>
          </div>
        </div>
			</div>
			<div class="col-md-8">
        <div class="card">
          <div class="card-body" style="min-height: 400px">
            <table class="table table-condensed table-hover" style="border: 1px solid #dee2e6; margin-bottom: 0;">
              <thead>
                <tr>
                  <th style="width: 50px;">No</th>
                  <th >Nama</th>
                  <th>Kelas</th>
                  <th style="width: 140px;">more</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach($kandidat as $k)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$k->name}}</td>
                  <td>{{$k->kelas}}</td>
                  <td style="display: flex; padding-top: 5px; padding-bottom: 0;">
                    <span data-toggle="modal" data-target="#detail-{{$i}}"  class="text-primary text-center p-fs12" style="cursor: pointer; margin-right: 10px;">
                      <i class="fa fa-eye"></i><p>details</p>
                    </span>
                    <div class="modal fade" id="detail-{{$i}}">
                      <div class="modal-dialog">
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
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="/edit/{{$k->id}}" class="text-warning text-center p-fs12"><i class="fas fa-edit"></i><p>edit</p></a>
                  </td>
                  <?php $i++; ?>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div style="margin-top: 20px;">
              <center>
                <form method="post" action="/stop-voting">
                  <input type="hidden" name="id" value="{{$voting[0]->id}}">
                  <button class="btn btn-success" type="submit" onclick="return confirm('Apakah anda ingin menghentikan pemilihan yang sedang berlangsung?');"> 
                    Hentikan Pemilihan
                  </button>
                  {{csrf_field()}}
                </form>
              </center>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>
</section>
@endsection


@section('js')
<!-- <script>
    $(document).ready(function () {
     $('#modal-detail').click(function() {
       var id=$(this).children('.idku').val();
       $('#nama').text('')
     });
    });
</script> -->
@endsection