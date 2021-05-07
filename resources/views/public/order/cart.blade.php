@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="cart,{{$settings->description}}">
@endsection

@section('title')
<title>Cart | {{$settings->title}}</title>
@endsection

@section('custom-css')
	
	<style>
		.color-view{
			display: inline-block;  
			width: 15px; 
			height: 15px; 
			border-radius: 100%;
		}
	</style>

@endsection


{{-- main content --}}
@section('content')



<!-- cart-main-area start -->
<div class="cart-main-area   mb-5">
	<div class="container">
		<div class="row mb-5">
			<div class="col-12 text-center">
				<h1>Your Products</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-12">
				<form action="#">               
					<div class="table-content table-responsive">
						<table>
							<thead>
								<tr>
									<th class="product-thumbnail">Image</th>
									<th class="product-name">Product</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-subtotal">Total</th>
									<th class="product-remove">Remove</th>
								</tr>
							</thead>
							<tbody>


								<?php 
								$total = 0;

								
								?>
								@foreach(Session::get('cart-products') as $product)



								<?php 
								$sub_total = $product['quantity'] * $product['price'];


								$total += $sub_total;
								?>


								<tr id="delete-tr-{{$product['code']}}">
									<td class="product-thumbnail"><a href="{{route('website.single_product',['slug' => $product['slug']])}}"><img style="width: 50px;" src="{{URL::asset('assets/img/products/')}}/{{$product['image']}}" alt="{{$product['name']}}" /></a></td>
									<td class="product-name">
										<a href="{{route('website.single_product',['slug' => $product['slug']])}}">
											{{$product['name']}}
											 {{-- @if($product['size'] != ''), size: {{$product['size']}} @endif @if($product['color'] != ''), color: <span class="color-view" style="background: #{{$product['color']}};"></span> @endif --}}
									    </a>
									</td>
									<td class="product-price"><span class="amount">৳ {{bcdiv($product['price'], 1, 2)}}</span></td>


									<td class="product-quantity">

										<input min="1" class="product-quantity-input" id="quantity-{{$product['code']}}" data-price="{{$product['price']}}"  data-code="{{$product['code']}}" type="number" value="{{$product['quantity']}}" />
										{{-- <sub>{{ App\Product::find($product['id'])->unit }}</sub> --}}
										<sub>{{ $product['unit'] }}</sub>
										
									</td>


									<td class="product-subtotal" >
										৳ <span id="product-subtotal-{{$product['code']}}">{{bcdiv($sub_total, 1, 2)}}</span>
									</td>


									<td class="product-remove"><a data-code="{{$product['code']}}" class="delete_product" href="#">X</a></td>
								</tr>


								@endforeach



							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<div class="buttons-cart">
								
								<a href="{{route('website.shop_page')}}">Continue Shopping</a>
							</div>

							<div class="coupon">
								<h3>Coupon</h3>
								<p>Enter your coupon code if you have one.</p>
								<form></form>
								@if(Session::has('order-coupon'))
								<form  action="{{route('website.cart.delete_coupon')}}" method="POST">
									@csrf
									
									<input style="cursor: pointer;" type="submit" class="bg-danger" value="Delete Coupon" />
								</form>
								@else
								<form  action="{{route('website.cart.apply_coupon')}}" method="POST">
									@csrf
									<input type="hidden" name="total_cost" value="{{$total}}">
									<input required type="text" placeholder="Coupon code" name="code" />
									<input style="cursor: pointer;" type="submit" value="Apply Coupon" />
								</form>
								@endif
								
							</div>
							@if(Session::has("coupon-message"))
							<div>
								<div class="alert alert-info">
									{{Session::get("coupon-message")}}
								</div>
							</div>
							@endif
							
						</div>
						<div class="col-md-4 col-sm-12 ">
							{{-- <h2 class="text-right border-bottom mb-3">Cart Totals</h2> --}}
							<div class="cart_totals">
								
								<table>
									<tbody>
										

										@if(Session::has('order-coupon'))
											@php
												$coupon 		= Session::get('order-coupon');
												$discount 		= $coupon->discount;
												$sub_total 		= $total;
												$grand_total    = $sub_total - $discount;
											@endphp
										<tr class="order-total">
											<th>Sub Total</th>
											<td>
												<strong ><span class="amount">৳ {{bcdiv($sub_total, 1, 2)}}</span></strong>
											</td>
										</tr> 

										<tr class="order-total">
											<th>Discount Coupon</th>
											<td>
												<strong id="total_price"><span class="amount">৳ {{bcdiv($discount, 1, 2)}}</span></strong>
											</td>
										</tr> 

										<tr class="order-total">
											<th>Total</th>
											<td>
												<strong ><span class="amount">৳ {{bcdiv($grand_total, 1, 2)}}</span></strong>
											</td>
										</tr> 

										@else
										<tr class="order-total">
											<th>Total</th>
											<td>
												<strong id="total_price"><span class="amount">৳ {{bcdiv($total, 1, 2)}}</span></strong>
											</td>
										</tr>

										@endif

									</tbody>
								</table>
								
							</div>
							<div class="wc-proceed-to-checkout text-right">
								<a  href="{{route('website.cart.check_out')}}">Proceed to Checkout</a>
							</div>
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>
<!-- cart-main-area end -->


@endsection
{{-- end main content --}}



@section('custom-js')

<script>
	$(document).ready(function(){
		$(".delete_product").click(function(){
			var code = $(this).data('code');

			$.ajax({
				type:'POST',
				url:'/delete-cart-product',

				data:{code:code},
				success:function(data){
					
				   		$("#notificaton-text").html("Product deleted");
				   		$("#notificaton-div").addClass("bg-danger");
				   		$("#notificaton-div").fadeIn();
					   		
					   	mekeCart(products);

				   } // end success

				}) // end ajax call

			location.reload();



			}) // end delete


		$('.product-quantity-input').on('keyup change', function(e) {

			var quantity = $(this).val();
			quantity = Number(quantity);

			var code = $(this).data('code');

			if(quantity<1){
				input.val(1)
				return false;
			}

			$("#notificaton-text").html("Quantity Updated");
			$("#notificaton-div").addClass("bg-success");
			$("#notificaton-div").fadeIn();


			update_product_quantity(code,quantity);

			location.reload();

		})

	


		}) // end jquery 




	function update_product_quantity(code,quantity){

		
		$.ajax({
			type:'POST',
			url:'/update-cart',

			data:{
				code:code,
				quantity:quantity
			},
			success:function(data){
				

			   		// update top cart
			   		mekeCart(products);

			   } // end success

			}) // end ajax call


	}

</script>
@endsection


