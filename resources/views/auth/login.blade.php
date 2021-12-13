@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
               

                <div class="card-body login-page">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div  class="row mb-4 mt-2 text-center login-logo"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
                        <div class="row mb-3">

                         
                                <input id="email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>

                        <div class="row mb-3">
                           

                                <input id="password" type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input rounded-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                      <small class="text-secondary"> {{ __('Remember Me') }}</small> 
                                    </label>
                                </div>
                            </div>
                        </div>
                    

                        <div class="row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-dark rounded-0 btn-block">
                                    {{ __('Login') }}
                                </button>
                             

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link link-secondary" href="{{ route('password.request') }}">
                                       <small> {{ __('Forgot Your Password?') }}</small>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
