@extends('frontend.master')

@section('content')
<div class="content-wrapper" id="kanan">
  <div class="content-header">
    <div class="container">
      <div class="row jarak-atas">
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <div class="row">
        @foreach($kandidat as $k)
          <div class="col-lg-4">
            <center>
              <img class="gambar" src="/images/{{$k->foto}}" alt="">
            </center>
            <div class="cardis"> 
              <h2 class="name" style="margin-top: 80px; padding-left: 20px;padding-right: 20px;">{{$k->name}}</h2>
              <div class="title">{{$k->kelas}}</div>
              <div class="desc">
                <strong>VISI.</strong>
                {{$k->visi}}
              <br><br>
                <strong>MISI.</strong>
                {{$k->misi}}
              </div>
              <div class="actions">
                <div class="follow-btn">
                  <form method="post" action="/">
                    {{ csrf_field() }}
                    <input type="hidden" name="pilihan" value="{{$k->id}}">
                    <input type="hidden" name="siswa" value="{{$siswa->id}}">
                    <button type="submit">Pilih</button>
                  </form>
                </div>
              </div>
            </div>  
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection