@extends('customer.layouts.master')



@section('title')
Order | {{$order->id}}
@endsection


@section('content')


	<div class="row">

		<div class="col-12 col-lg-12 mb-3">
			<div class="row">

				@if($order->status == "Cancel") 

					<div class="col-12 ">
						<div class="my-4 rounded-0 alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Order Cancled</strong>.
						  
						</div>
					</div>

				@endif


				@if(Session::has("order-submit-message"))
				<div class="col-12 ">
					<div class="my-4 rounded-0 alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Hello {{$customer->name}}</strong> Your order place successfully, we will contact with you very soon.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
				@endif


				<div class="col-12 col-lg-6 ">
					<div class="card p-3 rounded-0">
						<h4 class="font-20 font-pt border-bottom pb-2">Admin Note</h4>
							{{$order->admin_note}}
					</div>
				</div>

				<div class="col-12 col-lg-6 ">
					<div class="card p-3 rounded-0">
						<h4 class="font-20 font-pt border-bottom pb-2">Customer Note</h4>
							{{$order->customer_note}}
					</div>
				</div>

				<div class="col-12 col-lg-6 my-3">
					<div class="card p-3 rounded-0">
						<h4 class="text-center">Payment and Delivery Process</h4>
						<hr class="my-2">


						<dl class="row mb-2">
						
						  <dt class="col-sm-3">Payment Method:</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">----</dd>

						  <dt class="col-sm-3">Delivery Method</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">----</dd>
						  
						</dl>

					</div>
				</div>


				<div class="col-12 col-lg-6 my-3">
					<div class="card p-3 rounded-0">
						<h4 class="text-center">Customer Info</h4>
						<hr class="my-2">


						<dl class="row mb-2">
						
						  <dt class="col-sm-3">Name:</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$customer->name}}</dd>

						  <dt class="col-sm-3">Email</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$customer->email}}</dd>


						  <dt class="col-sm-3">Phone</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$customer->phone}}</dd>

						  <dt class="col-sm-3">Address</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$customer->address}}</dd>

						</dl>

					</div>
				</div>


				<div class="col-12 col-lg-6 my-3">
					<div class="card p-3 rounded-0">
						<h4 class="text-center">Order Info</h4>
						<hr class="my-2">

						<dl class="row mb-2">
						
						  <dt class="col-sm-3">Order Code</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$order->order_code}}</dd>


						  <dt class="col-sm-3">Order Status</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$order->status}}</dd>


						  <dt class="col-sm-3">Order Process</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">

						  	@if($order->process == 0)
						  	0%
						  	@else
						  	<div class="progress">
						  	  <div class="progress-bar bg-success" role="progressbar" style="width: {{$order->process}}%" aria-valuenow="{{$order->process}}" aria-valuemin="0" aria-valuemax="100">{{$order->process}}%</div>
						  	</div>
						  	
						  	@endif
						  	
						  	

						  </dd>

						  <dt class="col-sm-3">Address</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$order->address}}</dd> 

						  <dt class="col-sm-3">Phone</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$order->emergency_phone}}</dd>

						  <dt class="col-sm-3">Area</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$order->area}}</dd>
						</dl>
					</div>
				</div>



				<div class="col-12 col-lg-6 my-3">
					<div class="card p-3 rounded-0">
						<h4 class="text-center">Discount / Coupon</h4>
						<hr class="my-2">

						@if($coupon)
						<dl class="row mb-2">
						  <dt class="col-sm-3">Code:</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$coupon->code}}</dd>

						  <dt class="col-sm-3">Start Time</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$coupon->start_time}}</dd>

						  <dt class="col-sm-3">End Time</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">{{$coupon->end_time}}</dd>

						  <dt class="col-sm-3">Active</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">
						  	@if($coupon->active)
						  	<span class="text-success">Yes</span>
						  	@else
						  	<span class="text-danger">No</span>
						  	@endif
						  </dd>

						  <dt class="col-sm-3">Min Cost</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">৳ {{$coupon->min_cost}}</dd>

						  <dt class="col-sm-3">Discount</dt>
						  <div class="col-sm-1"><b>:</b></div>
						  <dd class="col-sm-8">৳ {{$coupon->discount}}</dd>
						  @php
						  $discount = $coupon->discount;
						  @endphp
						</dl>
						@else
						<div class="alert alert-info">
							@php
							$discount = 0;
							@endphp
							No Coupon applied
						</div>
						@endif

					</div>
				</div>

				<div class="col-12 col-lg-6 my-3">
					<div class="card p-3 rounded-0">
						<h4 class="text-center">Products / Payment</h4>
						<hr class="my-2">

						
						<dl class="row mb-2">


							<dt class="col-sm-3">Total Products</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">{{$order->total_product}}</dd>

							<dt class="col-sm-3">Total Quantity</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">{{$order->total_quantity}}</dd>

							<dt class="col-sm-3">Total Cost</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">৳ {{$order->sub_total_cost}}</dd>

							<dt class="col-sm-3">Delivery Cost</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">৳ {{$order->shipping_cost}}</dd>

							<dt class="col-sm-3">Discount</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">৳ {{$discount}}</dd>	

							<dt class="col-sm-3">Grand Total</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">৳ {{$order->total_cost}}</dd>

							<dt class="col-sm-3">Payment Status</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">{{$order->payment}}</dd>


							<dt class="col-sm-3">Total Paid</dt>
							<div class="col-sm-1"><b>:</b></div>
							<dd class="col-sm-8">৳ {{$order->payment_cost}}</dd>

						</dl>

					</div>
				</div>


			</div>
		</div>


		<div class="col-12  ">
			<div class="card p-3">
				<h3 class="font-20 font-pt">Products({{$order->total_product}})</h3>
				<hr>

				     <table class="table table-striped table-dark display ">
				       <thead>
				         <tr align="center">
				           
				           <th scope="col">Name</th>
				           <th scope="col">Code</th>
				           <th scope="col">Image</th>
				           <th scope="col">Price</th>
				           <th scope="col">Quantity</th>
				           <th scope="col">Subtotal</th>
				           
				         </tr>
				       </thead>
				      <tbody>
						@php 
							$i= -1;
							$total_quantity = 0;
							$grand_total = 0;
						@endphp
						@foreach($products as $product)
							@php 
								$i++;

								$total_quantity += $product['quantity'];

								$sub_total = ($product['quantity'] * $product['price']);
								$grand_total += $sub_total;
							@endphp
				        <tr align="center"> 
				           
				           
				           <td><a target="_blank" href="{{route('admin.product.show',['slug' => $product['slug']])}}" class="text-light font-pt font-18">{{$product['name']}}</a></td>
				           <td><a target="_blank" href="{{route('admin.product.show',['slug' => $product['slug']])}}" class="text-light font-pt font-18">{{$product['code']}}</a></td>
				           <td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product['image']}}" alt=""></td>
				           <td class="font-pt font-18">৳ {{$product['price']}}</td>
				           <td class="font-pt font-18">{{$product['quantity']}}</td>
				           <td class="font-pt font-18">৳ {{$sub_total}}</td>
				        </tr>


				       @endforeach

				       <tr align="center">
				       	<td colspan="4" align="right">Grand</td>
				       	<td>{{$total_quantity}}</td>
				       	<td>৳ {{$grand_total}}</td>
				       </tr>
				       </tbody> 

				     </table>
			</div>
		</div>


	</div>








@endsection