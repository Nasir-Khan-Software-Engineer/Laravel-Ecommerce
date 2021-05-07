@extends('customer.layouts.master')



@section('title')
{{Auth::user()->name}}
@endsection


@section('content')
<!-- page title area  -->


	<div class="row">

		<div class="col-12 col-lx-3 col-lg-4 mb-3">
			<div class="card rounded-0 p-3">
				<h5 class="card-title font-pt">Total Orders</h5>
				<span class="number h4 text-center">{{$data['total_order']}}</span>
			</div>
		</div>

		<div class="col-12 col-lx-3 col-lg-4 mb-3">
			<div class="card rounded-0 p-3">
				<h5 class="card-title font-pt">Complete Order</h5>
				<span class="number h4 text-center">{{$data['complete_order']}}</span>
			</div>
		</div>

		<div class="col-12 col-lx-3 col-lg-4 mb-3">
			<div class="card rounded-0 p-3">
				<h5 class="card-title font-pt">Pending Order</h5>
				<span class="number h4 text-center">{{$data['pending_order']}}</span>
			</div>
		</div>

		<div class="col-12 col-lx-3 col-lg-4 mb-3">
			<div class="card rounded-0 p-3">
				<h5 class="card-title font-pt">Confirm Orders</h5>
				<span class="number h4 text-center">{{$data['confirm_order']}}</span>
			</div>
		</div>

		<div class="col-12 col-lx-3 col-lg-4 mb-3">
			<div class="card rounded-0 p-3">
				<h5 class="card-title font-pt">Total Reviews</h5>
				<span class="number h4 text-center">{{$data['total_reviews']}}</span>
			</div>
		</div>

		<div class="col-12 col-lx-3 col-lg-4 mb-3">
			<div class="card rounded-0 p-3">
				<h5 class="card-title font-pt">Pending Reviews</h5>
				<span class="number h4 text-center">{{$data['pending_review']}}</span>
			</div>
		</div>

		<div class="col-12 col-lx-3 col-lg-4 mb-3">
			<div class="card rounded-0 p-3">
				<h5 class="card-title font-pt">Confirm Reviews</h5>
				<span class="number h4 text-center">{{$data['confirm_review']}}</span>
			</div>
		</div>

	</div>



@endsection