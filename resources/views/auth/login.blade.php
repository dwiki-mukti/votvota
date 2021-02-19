@extends('luar.master_login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    
                    <div class="text-center" style="margin: 30px 0;">
                        <h3>Admin SMKN 1 JENPO</h3>
                    <img src="/frontend/images/LOGOSTMJ.png" style="margin: 40px 0px; height: 200px">
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row justify-content-center">

                            <div class="col-md-8">

                                @error('email')
                                    <span class="text-danger text-center" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror

                                @error('password')
                                    <span class="text-danger text-center" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror

<div class="input-group mb-3">
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
    </div>
</div>

<div class="input-group mb-3">
    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
    </div>
</div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8 text-center">


                                <button type="submit" class="btn btn-primary" style="width: 100px;">
                                    {{ __('Login') }}
                                </button>


<!--                                 @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
