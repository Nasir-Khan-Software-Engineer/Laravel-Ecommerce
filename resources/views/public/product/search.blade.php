@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="{{$settings->tag}}">
@endsection

@section('title')
<title>{{$seo_data['title']}}</title>
@endsection


@section('custom-css')


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

	                        <!-- Start Range -->
	                        <div class="htc-grid-range border-0 mb-0">
	                            <h4 class="section-title-4">FILTER BY PRICE</h4>
	                            <div class="content-shopby">
	                                <div class="price_filter s-filter clear">
	                                    <form action="{{route('website.shop_filter')}}" method="POST">
	                                    	@csrf
	                                        <div id="slider-range"></div>
	                                        <div class="slider__range--output">
	                                            <div class="price__output--wrap">
	                                                <div class="price--output">
	                                                    <span>Price :</span><input name="price" type="text" id="amount" readonly>
	                                                </div>
	                                                <div class="price--filter">
	                                                    {{-- <a type="submit" href="#">Filter</a> --}}
	                                                    <input class="border-0 bg-dark text-light px-3 py-0" type="submit" value="Filter">
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- End Range -->

	                    </div>
	                </div>
	                <div class="tab-contet shop__grid__view__wrap">
	                    <!-- Start Single View -->
	                    <div role="tabpanel" id="grid-view" class="row single-grid-view tab-pane  active clearfix">

	                        @foreach($products as $product)
{{-- 
	                        <?php
	                            $offer_line = "";

	                            if($product->offer_id != 0){

	                                if($product->offer->type == 'tk'){

	                                    $offer_discount_tk = $product->offer->value;
	                                    $product_current_price = ($product->price - $offer_discount_tk);

	                                }else{
	                                    $offer_discount_percent = $product->offer->value;

	                                    $offer_discount_tk = ($product->price * ($offer_discount_percent / 100));

	                                    $product_current_price = ($product->price - $offer_discount_tk);
	                                   
	                                }

	                                $product_old_price     = $product->price;
	                            }else{
	                                $product_current_price = $product->price - $product->discount;
	                                $offer_discount_tk     = $product->discount;
	                            }

	                        ?> --}}
	                        
	                        	
	                        	<!-- Start Single Product -->
{{-- 	                        	<div class="col-md-3 col-lg-2 col-6">
	                        	    <div class="product single_product">
	                        	    	@if($product->offer_id != 0)
	                        	    	<span class="offer bg-danger">{{$product->offer->value}} {{$product->offer->type}}</span>
	                        	    	@elseif($product->discount > 0)
	                        	    	<span class="offer bg-danger">{{$product->discount}} Tk</span>
	                        	    	@endif
	                        	        <div class="product__inner">
	                        	            <div class="pro__thumb">
	                        	                <a href="{{route('website.single_product',['slug' => $product->slug])}}">
	                        	                    <img src="{{URL::asset('assets/img/products/')}}/{{$product->image}}" alt="product images">
	                        	                </a>
	                        	            </div>
	                        	        </div>
	                        	        <div class="product__details">
	                        	            <h2><a href="{{route('website.single_product',['slug' => $product->slug])}}">{{$product->name}}</a></h2>
	                        	            <ul class="product__price">
	                        	                <li class="new__price">৳ {{$product_current_price}}</li>
	                        	                
	                        	            </ul>
	                        	        </div>
	                        	    </div>
	                        	</div> --}}

                	    			<div class="col-6 col-xl-2 col-lg-3 col-md-4 mb-4 single__pro ">
                	    				<div class="card p-2 rounded-0">
                	    					{{-- @if($product->offer_id != 0)
                		                	<span class="offer bg-danger">{{$product->offer->value}} {{$product->offer->type}}</span>
                		                	@elseif($product->discount > 0)
                		                	<span class="offer bg-danger">{{$product->discount}} Tk</span>
                		                	@endif --}}

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

	                
	            </div>
	        </div>
	    </div>
	</section>
	<!-- End Our ShopSide Area -->



@endsection
{{-- end main content --}}

