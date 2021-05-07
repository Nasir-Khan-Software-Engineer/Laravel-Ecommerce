@extends('customer.layouts.master')



@section('title')
Your All Orders
@endsection


@section('content')
<!-- page title area  -->


 <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-light display " id="dataTable">
       <thead>
         <tr align="center">
           <th scope="col">No</th>
           <th scope="col">Order Id</th>
           <th scope="col">Date</th>
           <th scope="col">Process</th>
           <th scope="col">Status</th>
           <th scope="col">Payment</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($orders as $order)
			@php 
				$i++;
			@endphp
         <tr align="center" @if($order->status =="Cancel")class="bg-danger text-light" @endif>
           <td class="font-pt" >{{$i}}</td>
           <td class="font-pt">{{$order->order_code}}</td>
           <td class="font-pt">{{$order->created_at->format('Y-m-d')}}</td>
           <td class="font-pt">

            @if($order->process == 0)
            0%
            @else
            <div class="progress">
              <div class="progress-bar bg-success" role="progressbar" style="width: {{$order->process}}%" aria-valuenow="{{$order->process}}" aria-valuemin="0" aria-valuemax="100">{{$order->process}}%</div>
            </div>
            
            @endif

             
           </td>
           <td class="font-pt @if($order->status == "Cancle") text-danger @endif ">{{$order->status}}</td>
          

            <td class="font-pt">{{$order->payment}}</td>
           <td class="font-pt">

            <div class="dropdown show">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class=" dropdown-item" href="{{route('customer.order.single', ['id' => $order->id])}}">Details</a>
                @if($order->status !="Cancel")
                <form class="text-left" method="POST" action="{{route('customer.order.cancel', ['id' => $order->id])}}" class="dropdown-item">
                  @csrf
                  <button  class="text-left dropdown-item"  type="submit">Cancel</button>
                </form>
                @endif
              </div>
            </div>


            
          



         </td>
         </tr>
       @endforeach
       </tbody> 


     </table>
     </div>
   </div>
 </div>
 <!-- website info area end -->

@endsection