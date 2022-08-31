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
                        <div class="text-center text-uppercase">
                            VOTING {{ $currentVote->title }} <br> SMKN 1 JENANGAN {{ date('Y    ') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 nol"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="label mb-1">Login Pengguna</div>
                        <div class="mb-5">Masuk ke akun anda untuk melakukan pemilihan</div>

                        @if(Session::has('message'))
                        <div class="text-center text-danger">{{ Session::get('message') }}</div>
                        @endif

                        <form method="post">
                            @csrf
                            <div class="bungkus">
                                <div class="wrap-input1">
                                    <input class="input1" type="text" value="{{ old('email') }}" name="email" placeholder="Username" autofocus="" autocomplete="off">
                                    <span class="shadow-input1"></span>
                                </div>
                                @error('email')
                                <div class="text-danger mt-1" style="font-size: 14px;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror

                                <div class="wrap-input1">
                                    <input class="input1" type="password" value="{{ old('password') }}" name="password" placeholder="Password" autocomplete="off">
                                </div>
                                @error('password')
                                <div class="text-danger mt-1" style="font-size: 14px;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror

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