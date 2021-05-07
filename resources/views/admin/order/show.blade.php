@extends('admin.layouts.master')



@section('title')
<title>Order | {{$customer->name}}</title>
@endsection


@section('content')

<div class="row">

	@if($order->status == "Cancel") 
	<div class="col-12 ">
		<div class="my-4 rounded-0 alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Order Cancled</strong>.

		</div>
	</div>
	@endif


	<div class="col-12 col-lg-6">
		<div class="card p-3">
			<h2 class="font-20 font-pt">Update Order</h2>
			<hr>
			<form method="POST" action="{{route('admin.order.update')}}">
				@csrf
				<label for="admin_note"><b>Order Note*</b></label>
				<textarea class="form-control" name="admin_note" id="admin_note" cols="30" rows="3">{{$order->admin_note}}</textarea>

				<div class="row mt-2">
					<div class="col-12 col-lg-6 mb-2">
						<label for="payment_status"><b>Payment Status:</b></label>
						<select class="form-control" name="payment_status" id="payment_status">

							<option value="{{$order->payment}}">{{$order->payment}}</option>
							<option value="Pending">Pending</option>
							<option value="Confirm">Confirm</option>
							
						</select>
					</div>

					<div class="col-12 col-lg-6 mb-2">
						<label for="order_status"><b>Order Status:</b></label>
						<select class="form-control" name="order_status" id="order_status">
							<option value="{{$order->status}}">{{$order->status}}</option>
							<option value="Cancel">Cancel</option>
							<option value="Confirm">Confirm</option>
							<option value="Processing">Processing</option>
							<option value="On The Way">On The Way</option>
							<option value="Complete">Complete</option>
						</select>
					</div>


					<div class="col-12 col-lg-6 mb-2">
						<label for="payment_cost" class="mt-2"><b>Total Payment:</b></label>
						<input value="{{$order->payment_cost}}" type="number" id="payment_cost" step="any" class="form-control" name="payment_cost">
					</div>


					<div class="col-12 col-lg-6 mb-2">
						<label for="order_processing_percentage" class="mt-2"><b>Order Processing Percentage(%):</b></label>
						<input value="{{$order->process}}" type="number" id="order_processing_percentage" step="any" class="form-control" name="order_processing_percentage">
					</div>

				</div>

				<input type="hidden" id="order_id" name="id" value="{{$order->id}}">
				<input type="submit" name="submit" class="btn_1 form-control mt-2"  value="Update">

			</form>
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

				<dt class="col-sm-3">Area</dt>
				<div class="col-sm-1"><b>:</b></div>
				<dd class="col-sm-8">{{$order->area}}</dd>
			</dl>
		</div>
	</div>








	<div class="col-12 col-lg-4 my-3">
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


	



	<div class="col-12 col-lg-4 my-3">
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

	<div class="col-12 col-lg-4 my-3">
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






	<div class="col-12  mb-3">
		<div class="card p-3 rounded-0">
			<h4 class="font-20 font-pt border-bottom pb-2">Customer Note</h4>
			{{$order->customer_note}}
		</div>
	</div>





	<div class="col-12">
		<div class="card p-3">
			<h2 class="font-20 font-pt">Products of This Order ({{$order->total_product}})</h2>
			<hr>

			<table class="table table-striped table-dark display ">
				<thead>
					<tr align="center">

						
						<th scope="col">Code</th>
						<th scope="col">Image</th>
						<th scope="col">Price</th>
						<th scope="col">Quantity</th>
						<th scope="col">Current Stock</th>
						<th scope="col">Subtotal</th>
						<th scope="col">Action</th>

					</tr>
				</thead>
				<tbody>
					@php 
					$i= -1;
					$total_quantity = 0;
					$grand_total 	= 0;




					@endphp
					@foreach($products as $product)
					@php 
					$i++;

					$total_quantity += $product['quantity'];

					$sub_total = ($product['quantity'] * $product['price']);
					$grand_total += $sub_total;
					@endphp
					<tr align="center"> 


						<td><a target="_blank" href="{{route('admin.product.show',['slug' => $product['slug']])}}" class="text-light font-pt font-18">{{$product['code']}}</a></td>
						<td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product['image']}}" alt=""></td>
						<td class="font-pt font-18">৳ {{$product['price']}}</td>
						<td class="font-pt font-18">{{$product['quantity']}}</td>
						<td class="font-pt font-18">{{$product['currnt_stock']}}</td>
						<td class="font-pt font-18">৳ {{$sub_total}}</td>

						<td class="font-pt font-18">
							<div class="dropdown show">
							  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Actions
							  </a>

							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

							    <form class="text-left" method="POST" action="{{route('admin.order.accept_product')}}" class="dropdown-item">
							      @csrf
							      <input   type="hidden" name="order_id" value="{{$order->id}}">
							      <input   type="hidden" name="customer_qty" value="{{$product['quantity']}}">
							      <input   type="hidden" name="product_id" value="{{$product['id']}}">
							      <input   type="hidden" name="action"  value="accept">
							      <button  class="text-left dropdown-item"  type="submit">Accept</button>
							    </form>

							    <form class="text-left" method="POST" action="{{route('admin.order.accept_product')}}" class="dropdown-item">
							      @csrf
							      <input   type="hidden" name="order_id" value="{{$order->id}}">
							      <input   type="hidden" name="customer_qty" value="{{$product['quantity']}}">
							      <input   type="hidden" name="product_id" value="{{$product['id']}}">
							      <input   type="hidden" name="action"  value="cancel">
							      <button  class="text-left dropdown-item"  type="submit">Cancel</button>
							    </form>
							   
							  </div>
							</div>
						</td>

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


@section('footer-section')

<script>
	$(document).ready(function(){

		var id = $("#order_id").val();
		$.ajax({
			type:'POST',
			url:'/admin/order/auto_seen',
			data:{id:id},
			success:function(data){

			}
		});

	})

</script>

@endsection