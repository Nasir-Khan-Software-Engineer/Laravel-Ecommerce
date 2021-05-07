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
		.single_product{
			position: relative;
		}
		.single_product .offer{
			position: absolute;
			z-index: 98;
			top: 0;
			right: 0;
			font-size: 12px;
			color:#fff;
			padding: 0px 3px;
		}
	</style>

@endsection


{{-- main content --}}
@section('content')


	<!-- Start Our ShopSide Area -->
	<section class="htc__shop__sidebar  ">
	    <div class="container">
	        <div class="row mb-5">
	            <div class="col-md-12 col-lg-12 order-lg-12 order-1 col-sm-12 col-xs-12 smt-30">
	                <div class="row">
	                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	                        <h1  class="text-center">{{$seo_data['title']}}</h1>
	                    </div>
	                </div>
	                <div class="tab-contet shop__grid__view__wrap">
	                    <!-- Start Single View -->
	                    <div role="tabpanel" id="grid-view" class="row single-grid-view tab-pane  active clearfix">

	                        @foreach($products as $product)

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


	                        	<!-- End Single Product -->
	                        @endforeach
	                    </div>
	                    <!-- End Single View -->
	                    
	                </div>

	                 <div id="pagination">
	                       	{{ $products->links() }}
	                 </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- End Our ShopSide Area -->



@endsection
{{-- end main content --}}

