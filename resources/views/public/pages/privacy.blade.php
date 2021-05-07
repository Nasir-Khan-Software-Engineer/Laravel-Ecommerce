@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$privacy->description}}">
<meta name="keywords" content="{{$privacy->tag}}">
@endsection

@section('title')
<title>Privacy Policy</title>
@endsection

@section('custom-css')
<style>
	#privacy-section{
		margin-top: -70px;
	}
</style>
@endsection

@section('content')
	
	<section class="htc__shop__sidebar  ">
	    <div class="container">
	        <div class="row mb-5">
	            <div class="col-md-12 col-lg-12  smt-30 text-center mb-5">
	               <h1>Privacy Policy</h1>
	            </div>

	           	<p>
	           		{!! $privacy->privacy !!}
	           	</p>
	        </div>
	    </div>
	</section>
@endsection


@section('custom-js')
@endsection