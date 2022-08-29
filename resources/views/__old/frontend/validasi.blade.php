@extends('frontend.master')

@section('content')
<div class="content-wrapper" id="kanan">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-1 nol"></div>
        <div class="col-lg-4 nol">
          <div class="card">
            <div class="card-body">
              <img class="img-fluid pad" src="/frontend/images/undraw_online_organizer_ofxm.svg">
              <span>
                <center>
                PEMILIHAN KETUA OSIS ONLINE <br> SMKN 1 JENANGAN 2020
                </center>
              </span>
            </div>
          </div>
        </div>
        <div class="col-lg-1 nol"></div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body text-center">
              <span class="label">
                Gunakan NISN untuk 
                <br> Verifikasi User
              </span>

              @if(Session::has('gagal'))
                <center>
                  <span class="text-danger">NIS tidak valid</span>
                </center>
              @endif

              @if(Session::has('sudah'))
                <center>
                  <span class="text-success">Siswa ini Sudah Melakukan Pemilihan</span>
                </center>
              @endif

              <form action="/" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="bungkus">
                  <div class="wrap-input1" data-validate="Masukan NIS">
                    <input class="input1" type="number" name="nis" placeholder="NIS" style="scroll-behavior: none;" autofocus="" autocomplete="off">
                    <span class="shadow-input1"></span>
                  </div>
                </div>
                <div class="bungkus">
                  <button class="btn-submit">
                    <span>
                      MASUK
                    </span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
