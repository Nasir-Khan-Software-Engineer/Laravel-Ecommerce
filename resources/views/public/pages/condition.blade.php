@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$condition->description}}">
<meta name="keywords" content="{{$condition->tag}}">
@endsection

@section('title')
<title>Terms and Conditions</title>
@endsection
@section('custom-css')
<style>
	
</style>
@endsection


@section('content')
	
	<section class="htc__shop__sidebar  ">
	    <div class="container">
	        <div class="row mb-5">
	            <div class="col-md-12 col-lg-12  smt-30 text-center mb-5">
	               <h1>Terms and Conditions</h1>
	            </div>

	           	<p>
	           		{!! $condition->condition !!}
	           	</p>
	        </div>
	    </div>
	</section>

@endsection


@section('custom-js')
@endsection