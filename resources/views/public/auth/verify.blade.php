@extends('admin.layouts.app')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="{{$settings->tag}}">
@endsection

@section('title')
<title>Verify Your Email Address | {{$settings->title}}</title>
@endsection


@section('content')

            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>

@endsection
