@extends('admin.layouts.master')

@section('title')
<title>All Orders</title>
@endsection


@section('content')

	<div class="row">
		<div class="col-12 py-3">
			<div class="text-right">


      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>


			<form class="d-inline" action="{{route('admin.orders.reports.download')}}" method="GET">
				
		        <input type="hidden"  name="type" value="{{ request()->has('type') ? request()->get('type') : '' }}">
		        <input type="hidden"  name="from" value="{{ request()->has('from') ? request()->get('from') : '' }}">
		        <input type="hidden"  name="to" value="{{ request()->has('to') ? request()->get('to') : '' }}">


				<button data-toggle="tooltip" data-placement="top" title="Donwload Sells Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
			</form>

      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>


			</div>
		</div>
	</div>


<div class="row mt-2">
	<div class="col-12 col-lg-12">
		<div class="card p-3 rounded-0">

			<div class="row">
				<div class="col-12 text-center">
					<h2 class="font-pt font-25">Orders Report</h2>
				</div>
			</div>
			<hr class="mb-3">
			<div class="row">
				<div class="col-11">
					<form action="{{route('admin.reports.orders')}}" method="GET">
						<span class="">
							<input  disabled="true" required id="order-from" name="form" class="font-pt" type="date" style="background: none; color: #333; border:1px solid #333; border-radius: 0px;">
						</span>

						<span class="">
							<input disabled="true"  required id="order-to"  name="to" class="font-pt" type="date" style="background: none; color: #333; border:1px solid #333; border-radius: 0px;">
						</span>

						<span class="">
							<select required name="type" id="type" style="background: none; color: #333; border:1px solid #333; border-radius: 0px; width: 100px; height: 37px;text-align: center; margin-top: -2px;">
								<option value="">Select Type</option>
								<option value="from-to">From -> To</option>
								<option value="today">Today</option>
								<option value="yesterday">Yesterday</option>
								<option value="this-week">This Week</option>
								<option value="last-week">Last Week</option>
								<option value="this-month">This Month</option>
								<option value="last-month">Last Month</option>
								<option value="this-year">This Year</option>
								<option value="last-year">Last Year</option>
							</select>
						</span>

						<span>
							<button type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Find" >
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</span>
					</form>



				</div>
				<div class="col-1 text-right">
					<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
				</div>
			</div>
			<hr class="mb-3">

			<div class="row">
				<div class="col-12 col-lg-4">

					<div class="card bg-info text-white p-3">
						<h3 class="text-white font-pt font-25">Total Orders</h3>
						<span id="show_total_order" class="number text-center font-30">0</span>
						<span id="show_total_tk" class="number text-center font-30">0</span>
						<span id="show_total_product" class="number text-center font-30">0</span>
					</div>

				</div>
				<div class="col-12 col-lg-4">
					<div class="card bg-success text-white p-3">
						<h3 class="text-white font-pt font-25">Confirm Orders</h3>
						<span id="show_total_confirm_order" class="number text-center font-30">0</span>
						<span id="confirm_tk" class="number text-center font-30">0</span>
						<span id="confirm_total_products" class="number text-center font-30">0</span>
					</div>
				</div>				

				<div class="col-12 col-lg-4">
					<div class="card bg-warning text-dark p-3">
						<h3 class="text-dark font-pt font-25">Pending Orders</h3>
						<span id="show_total_pending_order" class="number text-center font-30">0</span>

						<span id="pending_tk" class="number text-center font-30">0</span>
						<span id="pending_total_products" class="number text-center font-30">0</span>
					</div>
				</div>



			</div>
			<hr class="mb-3">

			<div class="row" style="max-height: 500px; overflow-y: scroll;">
				<div class="col-12">
					<table class="table table-striped table-dark display " id="dataTable">
						<thead>
							<tr align="center">
								<th scope="col">No</th>
								<th scope="col">Id</th>
								<th scope="col">Date</th>
								<th scope="col">Status</th>
								<th scope="col">Payment</th>
							</tr>
						</thead>
						<tbody id="order_table_data">
							@php 
							$i= 0;
							$show_total_product = 0;
							$show_total_tk      = 0;
							$total_confirm 			= 0;
							$pending 				= 0;


							$confirm_tk 			= 0;
							$confirm_total_products = 0;

							$pending_tk 			= 0;
							$pending_total_products = 0;


							@endphp
							@foreach($orders as $order)
							@php 
							$i++;

							if($order->status == 'confirm'){
								$total_confirm++;

								$confirm_tk 			+= $order->total_cost;
								$confirm_total_products += $order->total_product;

							}else{
								$pending++;

								$pending_tk 			+= $order->total_cost;
								$pending_total_products += $order->total_product;

							}

							$show_total_product = $confirm_total_products + $pending_total_products;
							$show_total_tk 		= $confirm_tk + $pending_tk;

							@endphp
							<tr align="center">
								<th class="font-pt font-18" >{{$i}}</th>
								<td class="font-pt font-18">

									<a target="_blank" data-toggle="tooltip" data-placement="top" title="View" class="text-white" href="{{route('admin.order.show', ['id' => $order->id])}}">
										{{$order->order_code}}
									</a>


								</td>
								<td class="font-pt font-18">{{$order->created_at->format('Y-m-d')}}</td>
								<td class="font-pt font-18">{{$order->status}}</td>

								<td class="font-pt font-18">{{$order->payment}}</td>

							</tr>
							@endforeach
						</tbody>

						<input type="hidden" id="total_order" value="{{$i}}">
						<input type="hidden" id="total_confirm_order" value="{{$total_confirm}}">
						<input type="hidden" id="total_pending_order" value="{{$pending}}">


					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- website info area end -->

@endsection





@section('footer-section')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>

	

	$(document).ready(function(){




		var total_order = $("#total_order").val();
		var total_confirm_order = $("#total_confirm_order").val();
		var total_pending_order = $("#total_pending_order").val();


		$("#show_total_order").html(total_order);
		$("#show_total_confirm_order").html(total_confirm_order);
		$("#show_total_pending_order").html(total_pending_order);

		$("#pending_tk").html('Total: '+ {{$pending_tk}} + ' Tk');
		$("#pending_total_products").html('Product: '+{{$pending_total_products}});

		$("#confirm_tk").html('Total: '+ {{$confirm_tk}} + ' Tk');
		$("#confirm_total_products").html('Product: '+{{$confirm_total_products}});

		$("#show_total_product").html('Product: '+{{$show_total_product}});
		$("#show_total_tk").html('Total: '+{{$show_total_tk}}+ ' Tk');



		$("#type").change(function(){
			var type = $(this).val();

			if(type == 'from-to'){
				$("#order-from").removeAttr('disabled');
				$("#order-to").removeAttr('disabled');

			}else{
				$("#order-from").attr('disabled',true);
				$("#order-to").attr('disabled',true);
			}

		})


  })// end jquery



	
</script>
@endsection