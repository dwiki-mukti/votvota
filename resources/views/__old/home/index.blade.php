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
      <div class="col-md-12">
        <div class="card" style="min-height: 400px;">
          <div class="card-header">
            <h3 class="card-title">{{$voting[0]->judul}}
              <span class="text text-secondary" style="cursor: pointer;" data-toggle="modal" data-target="#edit-voting">
                <i class="fa fa-edit"></i>
              </span>
            </h3>
            <!-- modal -->
            <div class="modal fade" id="edit-voting">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Judul Pemilihan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="/admin">
                      {{csrf_field()}}
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="id" value="{{$voting[0]->id}}">
                      <div class="input-group">
                        <input name="judul" type="text" class="form-control" value="{{ $voting[0]->judul }}">
                        <div class="input-group-append">
                          <button class="input-group-text">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- end modal -->
            <div class="card-tools">
              <form method="post" action="/admin">
                <input type="hidden" name="id" value="{{$voting[0]->id}}">
                <button class="btn btn-outline-danger btn-sm" style="width: 200px;" type="submit" onclick="return confirm('Apakah anda benar-benar ingin membatalkan pemilihan ini?');">Batalkan Pemilihan</button>
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
              </form>
            </div>
          </div>
          <div class="card-body" style="min-height: 400px">
            <table class="table table-condensed table-hover" style="border: 1px solid #dee2e6; margin-bottom: 0;">
              <thead>
                <tr>
                  <th style="width: 50px;">No</th>
                  <th style="width: 250px">Nama</th>
                  <th>Kelas</th>
                  <th style="width: 140px;">more</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                @foreach($kandidat as $k)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$k->name}}</td>
                  <td>{{$k->kelas}}</td>
                  <td style="display: flex; justify-content: space-between; padding-top: 5px; padding-bottom: 0;">
                    <span data-toggle="modal" data-target="#detail-{{$k->id}}" class="text-primary text-center p-fs12" style="cursor: pointer;">
                      <i class="fa fa-eye"></i>
                      <p>details</p>
                    </span>
                    <!-- modal -->
                    <div class="modal fade" id="detail-{{$k->id}}">
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
                    <!-- end modal -->
                    <a href="/kandidat/{{$k->id}}" class="text-warning text-center p-fs12"><i class="fas fa-edit"></i>
                      <p>edit</p>
                    </a>
                    <form method="post" action="kandidat">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="id" value="{{$k->id}}">
                      <button class="text-danger text-center p-fs12" onclick="return confirm('Apakah anda ingin menghapus data ini?');"><i class="fas fa-trash"></i>
                        <p>delete</p>
                      </button>
                    </form>
                  </td>
                  <?php $i++; ?>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="/kandidat" class="btn btn-block" style="background-color: #F4F6F9;border: 1px solid #dee2e6; border-radius: 0; margin-bottom: 20px;"><i class="fas fa-plus"></i> NEW CANDIDAT</a>
            @if(count($kandidat)>1)
            <div>
              <center>
                <form method="post" action="/start-voting">
                  <input type="hidden" name="id" value="{{$voting[0]->id}}">
                  <button class="btn btn-success" type="submit" onclick="return confirm('Apakah pemilihan sudah siap?');">
                    Mulai Pemilihan
                  </button>
                  {{csrf_field()}}
                </form>
              </center>
            </div>
            @else
            <div>
              <span>*) Voting bisa di mulai setelah ada 2 data kandidat yang sudah lengkap</span>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection