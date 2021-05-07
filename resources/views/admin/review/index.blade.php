@extends('admin.layouts.master')



@section('title')
<title>All Reviews</title>
@endsection


@section('content')


<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right ">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

     <form class="d-inline" action="{{route('admin.customer.download')}}" method="POST">
       @csrf
       <button data-toggle="tooltip" data-placement="top" title="Donwload Category Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
     </form>

      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
</div>



<div class="row">
	<div class="col-12">

		<div class="tab-content" >
			<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
				<div class="row mt-2">
					<div class="col-12">
						<div class="card p-3 rounded-0 table-responsive">

							<table id="dataTable" class="table table-striped table-dark display custom-data-table " id="">
								<thead>
									<tr align="center">
										<th scope="col">No</th>
										<th scope="col">Customer</th>
										<th scope="col">Product Code</th>
										<th scope="col">Product</th>
										<th scope="col">Date</th>
										<th scope="col">Approve</th>
										<th scope="col">Action</th>

									</tr>
								</thead>
								<tbody>
									@php 
									$i= 0;
									@endphp
									@foreach($reviews as $review)
									@php 
									$i++;
									@endphp
									<tr align="center">
										<th class="font-pt font-16" >{{$i}}</th>
										<td class="font-pt font-16">{{$review->user->name}}  </td>
										<td class="font-pt font-16">{{$review->product->code}}  </td>
										<td class="font-pt font-18">
											<a href="{{route('admin.product.show', ['slug' => $review->product->slug])}}">
												
												<img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$review->product->image}}" alt="">
											</a>

										</td>
										<td class="font-pt font-16">{{$review->created_at->format('d-m-Y')}}</td>


										<td>
											<div class="custom-control custom-switch">
												<input type="checkbox" @if($review->active == 1) checked @endif class="custom-control-input review-active" data-id="{{$review->id}}" id="show-home-{{$review->id}}">
												<label class="custom-control-label" for="show-home-{{$review->id}}">Active</label>
											</div>
										</td>

										<td class=" ">
											<a data-toggle="tooltip" data-placement="top" title="Show review"  href="{{route('admin.review.show', ['id' => $review->id])}}" class="cusron  font-pt btn btn-success">
												<i class="fa fa-eye" aria-hidden="true"></i> 
											</a>

											<button  data-toggle="tooltip" data-placement="top" title="Delete review"   data-id="{{$review->id}}" class="btn btn-danger delete-review" type="button" >
												<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
												<i class="fa fa-trash" aria-hidden="true"></i>
											</button>
										</td>
									</tr>
									@endforeach
								</tbody> 

							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>



@endsection

@section('footer-section')

<script>

    // ajax call setup header 
    $.ajaxSetup({
    	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
    });
    // end header setup 


    $(".delete-review").click(function(){
    	var id = $(this).data('id');
    	var is_delete = delete_data(this,id,'/admin/review/delete');
      }) // edn delete


    $(".review-active").click(function(e){

    	var id = $(this).data('id');

    	$.ajax({

    		type:'POST',
    		url:'/admin/review/active',
    		data:{id:id},
    		success:function(data){

    			Toast.fire({
    				icon: 'success',
    				title: "Success"

    			}) // end alert

    		} // end success

    	}); // end ajax

    })  // end onclick


</script>

@endsection