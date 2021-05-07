@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="{{$settings->tag}}">
@endsection

@section('title')
<title>{{$settings->title}}</title>
@endsection

@section('custom-css')
<style>
	.category-name{
		font-size:22px;
		font-weight: bold;
	}
	.category-button{
		font-weight: bold;
	}
	#pop_up{
		position: fixed;
		top: 0%;
		left: 0%;
		z-index: 10000;
		width:100%;
		height: 100vh;
		background:#0000008a;
		display: none;
	}
	#pop_up #pop_up_content{
		position: absolute;
		top: 40%;
		left: 50%;
		transform: translate(-50%,-50%);
	}

	#pop_up #pop_up_content button{
		position: absolute;
		top: 0;
		right: 0;
		border:0;
		font-size:20px;
		background:none;
		padding: 0px;
		margin: 0px;
		text-align: center;
		width: 25px;
		height: 25px;
		border-radius: 25px;
		line-height: 25px;
		
	}
	#pop_up #pop_up_content button:hover{
		border:1px solid #333;
	}
</style>
@endsection

{{-- main content --}}
@section('content')
	
	@if($popup)
	<div id="pop_up">
		{{-- <input type="hidden" name="poppu_name"> --}}
		<div id="pop_up_content">
			<button id="pop_up_close_btn">x</button>
			<img src="{{URL::asset('/assets/img/popup')}}/{{$popup->image}}" alt="popup">
		</div>
	</div>
	@endif
	
	<div class="container">
	    <div class="row">
        @foreach($categories as $category)
        	@if($category->show_home == 1 && $category->id > 1 && $category->products->count() > 0)
	    	<div class="col-12 ">
	    		<div class="row my-3">
	    			<div class="col-6">
	    				<h2 class="text-capitalize category-name">{{$category->name}}</h2>
	    			</div>
	    			<div class="col-6 text-right">
	    				<a class="category-button" href="{{route('website.single_category',['slug' => $category->slug])}}">All Products</a>
	    			</div>
	    		</div>

	    		<div class="row ">
                    @foreach($category->products as $product)
                    @if($product->home_show == 1)


                 
	    			<div class="col-6 col-xl-2 col-lg-3 col-md-4 mb-4 single__pro ">
	    				<div class="card p-2 rounded-0">
	    					
		                	<a href="{{route('website.single_product',['slug' => $product->slug])}}">
		                		<div class="product-img">
		                			<img width="100%;"  src="{{URL::asset('assets/img/products/')}}/{{$product->image}}" alt="product images">
		                		</div>

		                		<div class="product__details">
		                		    <h3>{{$product->name}}</h3>
		                		    
		                		    @if($product->price != $product->old_price)
		                		    <span class="old__prize text-secondary mr-2 mt-2"><del>৳ {{$product->old_price}}</del></span>
		                		    <span class="popular__pro__prize text-dark mt-0">৳ {{$product->price}}</span>
		                		    @else
		                		    <span class="popular__pro__prize text-dark mt-2">৳ {{$product->price}}</span>
		                		    @endif
		                		    
		                		</div>
		                	</a>

	    				</div>
	    			</div>
	    			
	    			@endif
	    			@endforeach


	    		</div>

	    	</div>
	    	@endif
	    @endforeach
	    </div>

	    <div class="row mb-5">
	    	<div class="col-12">
	    		<div class="text-center">
	    			<a href="/shop" class="find-more-btn">Find More </a>
	    		</div>
	    	</div>
	    </div>
	</div>

@endsection
{{-- end main content --}}


@section("custom-js")
	
	<script>
		$(document).ready(function(){
		

			@if($popup)

			// Check browser support
			if (typeof(Storage) !== "undefined") {

			  var pop_up = sessionStorage.getItem("pop_up");

			  if(pop_up != "alredy show"){
			  	
			  	$("#pop_up").show();
			  	sessionStorage.setItem("pop_up", "alredy show");

			  }
			} else {
			    $("#pop_up").show();
			    sessionStorage.setItem("pop_up", "alredy show");
			}


			$("#pop_up_close_btn").click(function(){
				$("#pop_up").hide();
				sessionStorage.setItem("pop_up", "alredy show");
			})


			@endif




			

			



		})
	</script>

@endsection