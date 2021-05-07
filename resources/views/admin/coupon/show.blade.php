@extends('admin.layouts.master')

@section('title')
<title>{{$coupon->code}}</title>
@endsection


@section('content')
	<div class="row">
		<div class="col-12 col-lg-6">
			
			<div class="card p-3 rounded-0">
				<h4 class="text-center">Coupon Details</h4>
				<hr class="my-2">
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

					<dt class="col-sm-3">Discount</dt>
					<div class="col-sm-1"><b>:</b></div>
					<dd class="col-sm-8">{{$coupon->discount}} {{$coupon->discount_type}}</dd>

					<dt class="col-sm-3">Minimum cost</dt>
					<div class="col-sm-1"><b>:</b></div>
					<dd class="col-sm-8">{{$coupon->min_cost}} {{$coupon->discount_type}}</dd>

					<dt class="col-sm-3">Active</dt>
					<div class="col-sm-1"><b>:</b></div>
					<dd class="col-sm-8">{{$coupon->active}}</dd>

				</dl>
			</div>

		</div>

		<div class="col-12 col-lg-6 mb-2" style="max-height: 600px; overflow-y: scroll;">
			<div class="card p-3">
				<h1 class="text-center font-20 font-pt">All Orders ({{$coupon->orders->count()}})</h1>
				<hr>

				<table class="table table-bordered">
				  <thead>
				    <tr align="center">
				      <th scope="col">No</th>
				      <th scope="col">Code</th>
				      <th scope="col">Customer</th>
				     
				      <th scope="col">Date</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@php
				  	$i=0;
				  	@endphp
				  	@foreach($coupon->orders as $order)
				  	@php
				  	$i++;	
					@endphp

				    <tr align="center">
				      <th scope="row">{{$i}}</th>
				      <td><a target="_blank" href="{{route('admin.order.show',['id' => $order->id])}}">{{$order->order_code}}</a></td>
				      <td><a target="_blank" href="{{route('admin.customer.show', ['id' => $order->customer_id])}}">View Customer</a></td>
				      
				      <td>{{$order->created_at->format('d-m-Y')}}</td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>

				

			</div>
		</div>




		
	</div>
@endsection






