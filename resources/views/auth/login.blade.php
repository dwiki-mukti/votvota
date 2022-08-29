@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-center" style="margin: 30px 0;">
            <h3>Admin SMKN 1 JENPO</h3>
            <img src="/frontend/images/LOGOSTMJ.png" style="margin: 40px 0px; height: 200px">
        </div>

        <form method="POST" class="row justify-content-center">
            @csrf
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
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100px;">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection