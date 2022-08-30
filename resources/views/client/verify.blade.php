@extends('layouts.client')

@section('content')
<div class="content pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 nol"></div>
            <div class="col-lg-4 nol">
                <div class="card">
                    <div class="card-body">
                        <img class="img-fluid pad" src="/frontend/images/undraw_online_organizer_ofxm.svg">
                        <div class="text-center">
                            PEMILIHAN KETUA OSIS ONLINE <br> SMKN 1 JENANGAN 2020
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 nol"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="label mb-1">Verifikasi User</div>
                        <div class="mb-4">Masukkan token valid yang telah diberikan <br> oleh panitia</div>

                        @if(Session::has('message'))
                        <div class="text-center text-danger">{{ Session::get('message') }}</div>
                        @endif

                        <form method="post">
                            @csrf
                            <div class="bungkus">
                                <div class="wrap-input1">
                                    <input class="input1" type="text" name="token" placeholder="Vote Token" autofocus="" autocomplete="off">
                                    <span class="shadow-input1"></span>
                                </div>
                            </div>
                            <div class="bungkus">
                                <button class="btn-submit">VERIFIKASI</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection