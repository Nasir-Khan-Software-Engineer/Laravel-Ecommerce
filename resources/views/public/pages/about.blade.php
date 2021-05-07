@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$about->description}}">
<meta name="keywords" content="{{$about->tag}}">
@endsection

@section('title')
<title>About Us</title>
@endsection

@section('custom-css')
<style>
	#about-section{
		margin-top: -70px;
	}
</style>
@endsection


@section('content')


<section class="htc__shop__sidebar  ">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 col-lg-12  smt-30 text-center mb-5">
               <h1>About Us</h1>
            </div>

           	<p>
           		{!! $about->about !!}
           	</p>
        </div>
    </div>
</section>


	
@endsection


@section('custom-js')
@endsection