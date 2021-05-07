@extends('admin.layouts.master')



@section('title')
<title>Dashboard</title>
@endsection


@section('content')

	<div class="row">
		<div class="col-12 py-3">
			<div class="text-right">


      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>


			<form class="d-inline" action="{{route('admin.customer.reports.download')}}" method="GET">
				
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
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">



     <div class="row">
      <div class="col-12 text-center">
        <h2 class="font-pt font-25">Customer Report</h2>
      </div>
     </div>
     <hr class="mb-3">
     <form action="{{route('admin.reports.customer')}}" method="GET">
       <div class="row">
        <div class="col-11">

          <span class="">
            <input disabled="true" required name="from" id="from" class="font-pt" type="date" style="background: none; color: #333; border:1px solid #333; border-radius: 0px;">
          </span>

          <span class="">
            <input disabled="true" required name="to" id="to" class="font-pt" type="date" style="background: none; color: #333; border:1px solid #333; border-radius: 0px;">
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
        </div>

    

       </div>
     </form>


     <hr class="mb-3">



          <table class="table table-striped table-dark display " id="dataTable">
            <thead>
              <tr align="center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Total Order</th>
                
              </tr>
            </thead>
           <tbody>
        @php 
          $i= 0;
        @endphp
        @foreach($customers as $customer)
          @php 
            $i++;
          @endphp
              <tr align="center">
                <th class="font-pt font-18" >{{$i}}</th>
                <td class="font-pt font-18">{{$customer->name}}</td>
                <td class="font-pt font-18">{{$customer->email}}</td>
               
                <td class="font-pt font-18">{{$customer->phone}}</td>
                <td class="font-pt font-18">{{$customer->orders->count()}}</td>

              </tr>
            @endforeach
            </tbody> 

          </table>


     </div>
   </div>
 </div> 
 <!-- website info area end -->




@endsection



@section('footer-section')

<script>
  
  $("#type").change(function(){
    var type = $(this).val();

    if(type == 'from-to'){
      $("#from").removeAttr('disabled');
      $("#to").removeAttr('disabled');

    }else{
      $("#from").attr('disabled',true);
      $("#to").attr('disabled',true);
    }

  })
</script>



@endsection