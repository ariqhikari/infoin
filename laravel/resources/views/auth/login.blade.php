@extends('layouts.login')

@section('title', 'Login - Hil•fe')

@section('content')
{{-- <div class="page-login">
    <div class="container-fluid">
        <div class="row justify-content-center" style="height: 100vh;">
            <div class="col-lg-6 d-none d-lg-flex justify-content-end align-items-end illustration">
                <img src="{{ asset('/assets/frontend/illustration/sign-in.svg')}}" alt="sign up" class="img-fluid">
            </div>
            <div class="col-md-12 col-lg-6 d-flex align-items-center">
                <div class="container">
                    <div class="row py-5 justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h2>Sign In</h2>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('google') }}" class="btn btn-primary btn-block">
                                        <img src="{{ asset('/assets/frontend/icons/google.svg') }}" alt="google">
                                        Sign in with Google
                                    </a>
                                </div>
                                <div class="col-md-12 d-flex align-items-center mb-4">
                                    <hr class="w-100">
                                    <span class="mx-2">or</span>
                                    <hr class="w-100">
                                </div>
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-check ml-3">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                        <div class="forgot-password d-flex flex-column align-items-center mt-3">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4">Sign
                                                    In</button>
                                            </div>
                                            <div class="mt-5 text-center">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="d-block mb-2">Lupa password?</a>
                                                @endif
                                                <a href="{{ route('register') }}" class="d-block">Belum punya akun?</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

