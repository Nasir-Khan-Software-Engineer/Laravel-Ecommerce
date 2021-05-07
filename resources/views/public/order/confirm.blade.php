@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="Order Confirm,{{$settings->tag}}">
@endsection

@section('title')
<title>Order Confirm | {{$settings->title}}</title>
@endsection



@section('custom-js')
<style>
	.alert-heading{
		font-size: 25px;
	}
	h2{
		font-size: 18px;
	}
</style>
@endsection


@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 my-2">

			<div class="alert alert-success" role="alert">
				<h1 style="font-size: 22px;" class="alert-heading"><i class="fa fa-check-circle"></i> Thank You <b>{{$customer['name']}}</b>, successfully your order submitted.</h1>
				<p>Please login to check your order status.</p>
			</div>

		</div>
	</div>
	<div class="row py-5">
		<div class="col-12 col-lg-12 mb-2">
			<div class="card p-3">
				<dl class="row">
					<dt class="col-sm-3">Order Code:</dt>
					<dd class="col-sm-9">{{$order['order_code']}}</dd>

					<dt class="col-sm-3">Total Products:</dt>
					<dd class="col-sm-9">{{$order['total_product']}}</dd> 


					<dt class="col-sm-3">Total Quantity:</dt>
					<dd class="col-sm-9">{{$order['total_quantity']}}</dd>

					<dt class="col-sm-3">Subtoal Cost:</dt>
					<dd class="col-sm-9">{{$order['sub_total_cost']}}</dd>


					<dt class="col-sm-3">Area:</dt>
					<dd class="col-sm-9">{{$order['area']}}</dd>



					<dt class="col-sm-3">Shipping Cost:</dt>
					<dd class="col-sm-9">{{$order['shipping_cost']}}</dd>


					<dt class="col-sm-3">Grand Total:</dt>
					<dd class="col-sm-9">{{$order['total_costl']}}</dd>



					<dt class="col-sm-3">Payment Method:</dt>
					<dd class="col-sm-9">{{$order['billing_method']}}</dd>


				</dl>
				<b class="text-center"><a class="text-right" href="{{route('login')}}">Check Full Information</a></b>
			</div>
		</div>	
	</div>
</div>
@endsection


@section('footer')


@endsection


