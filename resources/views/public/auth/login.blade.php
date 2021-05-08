@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="{{$settings->tag}}">
@endsection


@section('title')
<title>Login | {{$settings->title}}</title>
@endsection

@section('custom-css')
<style>
    h1{
        font-size: 20px;
    }
</style>
@endsection


@section('content')

<div class="container">

    <div class="row mb-4">
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="row">
                <div class="col-12 col-lg-6 text-lfet">
                    <h1>Login to your account</h1>
                </div>
                <div class="col-12 col-lg-6 text-right">
                    <p>New member? <a class="text-info" href="{{route('website.customer.registration')}}">Register</a> here.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12 col-lg-8 offset-lg-2 ">
            <div class="card p-4 rounded-0">
                <div class="">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label ">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-12">
                                        <input  id="email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="customer1@gmail.com" readonly required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="password" class="col-md-12 col-form-label ">{{ __('Password') }}</label>

                                    <div class="col-md-12">
                                        <input value="22222222" readonly id="password" type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class="btn btn-primary form-control submit-btn rounded-0">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-md-12 col-lg-6   mt-2">
                                @if (Route::has('password.request'))
                                <a style="padding-left: 0px;" class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                            <div class="col-md-12 col-lg-6 text-right mt-3">
                                <div class="form-check">
                                    <input class="form-check-input " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('custom-js')
@endsection