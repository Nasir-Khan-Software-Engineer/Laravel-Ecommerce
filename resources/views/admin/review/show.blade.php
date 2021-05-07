@extends('admin.layouts.master')



@section('title')
<title>{{$review->comment}}</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right pb-3">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

       <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
</div>



<div class="row mt-2">
	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<input type="hidden" name="id" value="{{$review->id}}" id="review_id">
			<h4 class="text-center">Review</h4>
			<hr>
			<p class="font-pt font-17">
				<b>{{$review->comment}}</b> <br>
				{{$review->details}}
			</p>
			<p class="mt-2 font-17">
				<b>Star: </b>

 				@for($i=0;$i<$review->star;$i++)
					<i class="fa fa-star font-16 star-color" aria-hidden="true"></i>
				@endfor

				&nbsp;&nbsp;&nbsp;
				
				<b>Date:</b> {{$review->created_at}}

				

			</p>

			<p>
				

				<div class="custom-control custom-checkbox my-1 mr-sm-2">
				   <input data-id="{{$review->id}}"  @if($review->active == 1) checked @endif type="checkbox" class="custom-control-input review-active" id="customControlInline">
				   <label class="custom-control-label" for="customControlInline">Active</label>
				 </div>

			</p>
		</div>
	</div>
	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h4 class="text-center">Products</h4>
			<hr>
			<dl class="row mb-2">
			  <dt class="col-sm-3">Name</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8"><a target="_blank" href="{{route('admin.product.show',['slug' => $review->product->slug])}}">{{$review->product->name}}</a></dd>
			  <dt class="col-sm-3">Current Stock</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">{{$review->product->stock}}</dd>
			  <dt class="col-sm-3">Current Price</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">{{$review->product->price}}</dd>
			  <dt class="col-sm-3">Total Review</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">{{$review->product->reviews->count()}}</dd>
			  <dt class="col-sm-3">Average Star</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">

			  	@for($i=0;$i<$review->product->rating;$i++)
			  		<i class="fa fa-star font-16 star-color" aria-hidden="true"></i>
			  	@endfor
			  </dd>
			</dl>
			
		</div>
	</div>

	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h4 class="text-center">Reviewer | Customer</h4>
			<hr>
			<dl class="row mb-2">
			  <dt class="col-sm-3">Name</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">{{$review->user->name}}</dd>
			  <dt class="col-sm-3">Phone Number</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">{{$review->user->pone}}</dd>
			  <dt class="col-sm-3">Total Order</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">{{$review->user->orders->count()}}</dd>
			  <dt class="col-sm-3">Total Review</dt>
			   <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8">{{$review->user->reviews->count()}}</dd>
			  
			</dl>
			<img src="" class="img-fluid" alt="">
		</div>
	</div>

</div>





@endsection



@section('footer-section')
  
<script>
  $(document).ready(function(){

  	var id = $("#review_id").val();
  	$.ajax({
  	   type:'POST',
  	   url:'/admin/review/auto_seen',
  	   data:{id:id},
  	   success:function(data){
  	      
  	   }
  	});


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


  })

</script>

@endsection