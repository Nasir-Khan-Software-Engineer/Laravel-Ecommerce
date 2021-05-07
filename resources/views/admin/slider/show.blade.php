@extends('admin.layouts.master')



@section('title')
<title>Single New Order</title>
@endsection


@section('content')
<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
  </div>
</div>


<div class="row">
	<div class="col-12 col-lg-8 offset-lg-2">
		<div class="card p-3">
			<img src="{{URL::asset('/assets/img/slider')}}/{{$slider->image}}" alt="{{$slider->title}}"> <br>
			<p>
				<b>Title:</b> {{$slider->title}}
			</p>
			<p>
				<b>Sub Title:</b> {{$slider->sub_title}}
			</p>
			<p>
				<b>Description:</b> {{$slider->discription}}
			</p>
			<p>
				<b>Page Name:</b> {{$slider->page_name}}
			</p>
			<p>
				<b>Page Link:</b> /{{$slider->link}}
			</p>
			<p>
				<b>Created At:</b> {{$slider->created_at}}
			</p>
			<p>
				<b>Added By:</b> {{$slider->user->name}}
			</p>
		</div>
	</div>
</div>







@endsection