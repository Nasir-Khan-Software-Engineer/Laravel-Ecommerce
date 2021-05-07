@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$seo_data['description']}}">
<meta name="keywords" content="{{$seo_data['tag']}}">
@endsection

@section('title')
<title>{{$seo_data['title']}}</title>
@endsection


@section('custom-css')
	
	<style>
		.single-category{
			box-shadow: 0px 0px 5px 1px #8d8d8d;
			padding: 5px 5px;
		}
		.single-category img{
			width: 100%;

		}

	</style>

@endsection


{{-- main content --}}
@section('content')


	<!-- Start Our ShopSide Area -->
	<section class="htc__shop__sidebar  ">
	    <div class="container">
	        <div class="row mb-5">
	            <div class="col-md-12 col-lg-12  smt-30 text-center mb-5">
	               <h1>{{$seo_data['title']}}</h1>
	            </div>


	            @foreach($categories as $category)
	            @if($category->id != 1)
	            <div class="col-6 col-md-4 col-lg-2 mb-4">
	            	<div class="single-category text-center" data-toggle="tooltip" data-placement="top"  title="{{$category->products->count()}} Products">
	            		<a href="{{route('website.single_category',['slug' => $category->slug])}}">
	            			{{-- <img class="image"  src="https://via.placeholder.com/120x60" alt="{{$category->name}}"> --}}
	            			<img class="image"  src="{{URL::asset('assets/img/category/')}}/{{$category->image}}" alt="{{$category->name}}">
	            			{{-- <p class="text-capitalize name">{{$category->name}}</p> --}}
	            			{{-- <p class="product">{{$category->products->count()}}</p> --}}
	            		</a>
	            	</div>
	            </div>
	            @endif

	            @endforeach

	        </div>




	    </div>
	</section>
	<!-- End Our ShopSide Area -->



@endsection
{{-- end main content --}}

