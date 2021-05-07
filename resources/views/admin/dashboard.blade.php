@extends('admin.layouts.master')



@section('title')
<title>Dashboard</title>
@endsection


@section('content')


<div class="row">
	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Total Orders</h3>
			<span class="number">{{$order_data['total']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Complete Order</h3>
			<span class="number">{{$order_data['complete']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Pending Order</h3>
			<span class="number">{{$order_data['pending']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Confirm Orders</h3>
			<span class="number">{{$order_data['confirm']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Total Customers</h3>
			<span class="number">{{$customer}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Total Categories</h3>
			<span class="number">{{$categories}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt ">Total Products</h3>
			<span class="number">{{$products_data['total_products']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4">
		<div class="dashboard-card rounded-0 bg-danger">
			<h3 class="card-title font-pt text-dark">Out of Stock</h3>
			<span class="number">{{$products_data['total_out_of_stock_products']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-4" title="Products Stock Under 10">
		<div class="dashboard-card rounded-0 bg-warning">
			<h3 class="card-title font-pt text-dark">Low Stock</h3>
			<span class="number">{{$products_data['total_low_stock_products']}}</span>
		</div>
	</div>


</div>

 <div class="row mt-2">
   <div class="col-12 col-lg-6">
     <div class="card p-3 rounded-0 table-responsive">
		 <h3 class="card-title font-pt text-center">Low Stock Products</h3>
		 <hr>
	     <table class="table table-striped table-warning display custom-data-table" >
	       <thead>
	         <tr>
	           <th scope="col">No</th>
	           <th scope="col">Code</th>
	           <th scope="col">Image</th>
	           <th scope="col">Stock</th>
	           <th scope="col">Action</th>
	         </tr>
	       </thead>
	      <tbody>
			@php 
				$i= 0;
			@endphp
			@foreach($products as $product)
				@php 
					$i++;
					if($product->stock >= 10 || $product->stock < 1){
						continue;
					}
				@endphp
	         <tr>
	           <th class="font-pt font-18" >{{$i}}</th>
	           <td class="font-pt font-18">{{$product->code}}</td>
	           <td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product->image}}" alt="{{$product->name}}"></td>
	           <td>{{$product->stock}}</td>
	           <td class="font-pt font-18">
	           	  <a href="{{route('admin.product.show', ['slug' => $product->slug])}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
	           </td>
	         </tr>
	       @endforeach
	     </table>
     </div>
   </div>


      <div class="col-12 col-lg-6">
        <div class="card p-3 rounded-0 table-responsive">
   		 <h3 class="card-title font-pt text-center">Out of Stock Products</h3>
   		 <hr>
   	     <table class="table table-striped table-danger display custom-data-table " >
   	       <thead>
   	         <tr>
   	           <th scope="col">No</th>
   	           <th scope="col">Name</th>
   	           <th scope="col">Image</th>
   	           <th scope="col">Stock</th>
   	           <th scope="col">Action</th>
   	         </tr>
   	       </thead>
           <tbody>
	     		@php 
	     			$i= 0;
	     		@endphp
	     		@foreach($products as $product)
	     			@php 
	     				$i++;
	     				if($product->stock > 0){
	     					continue;
	     				}
	     			@endphp
	              <tr>
	                <th class="font-pt font-18" >{{$i}}</th>
	                <td class="font-pt font-18">{{$product->name}}</td>
	                <td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product->image}}" alt="{{$product->name}}"></td>
	                <td>{{$product->stock}}</td>
	                <td class="font-pt font-18">
	                	  <a href="{{route('admin.product.show', ['slug' => $product->slug])}}" class="btn-admin btn-details">Details</a>
	                </td>
	              </tr>
	            @endforeach
          </table>
        </div>
      </div>


 </div>
 <!-- website info area end -->


{{--  <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr>
           <th scope="col">No</th>
           <th scope="col">Name</th>
           <th scope="col">Image</th>
           
           <th scope="col">Total Order</th>
           <th scope="col">Total Sell</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($products_data as $product)
			@php 
				$i++;
			@endphp
         <tr>
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$product['name']}}</td>
           <td class="font-pt font-18"><img width="50px" class="" src="{{Storage::url($product['image'])}}" alt=""></td>
           <td class="font-pt font-18">{{$product['total_order']}}</td>
           <td class="font-pt font-18">{{$product['total_sell']}}</td>
         </tr>
       @endforeach
       </tbody> 

       <tr>
       	
       </tr>
     </table>
     </div>
   </div>
 </div> --}}
 <!-- website info area end -->




@endsection