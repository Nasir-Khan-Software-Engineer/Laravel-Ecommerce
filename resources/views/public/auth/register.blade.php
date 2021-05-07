@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="{{$settings->tag}}">
@endsection

@section('title')
<title>Registration | {{$settings->title}}</title>
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
                    <h1>Create a new account</h1>
                </div>
                <div class="col-12 col-lg-6 text-right">
                    <p>Already member? <a class="text-info" href="{{route('website.customer.login')}}">Login</a> here.</p>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2 pb-5">
            <div class="card p-4 rounded-0">
                <div class="">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="name" class="col-md-12 col-form-label">{{ __('Name') }}</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="email" class="col-md-12 ">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    <label for="password" class="col-md-12 ">{{ __('Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control rounded-0" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row ">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary form-control rounded-0 submit-btn">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
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

@section('footer')
@endsection