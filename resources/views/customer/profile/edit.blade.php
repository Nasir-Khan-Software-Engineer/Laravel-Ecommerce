@extends('customer.layouts.master')

@section('title')
Update Profile | {{Auth::user()->name}}
@endsection



@section('content')


<div class="row ">
	<div class="col-12 col-xl-10 offset-xl-1 ">
		<div class="card p-3">
			<h4 class="font-20 font-pt my-3 text-center font-weight-bold">Update Your Information</h4>
			
			<form action="{{route('customer.profile.update')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<label for="name"><b>Name*</b></label>
				<input id="name" required class="form-control" name="name" type="text" value="{{Auth::user()->name}}">

				<label for="image" class="mt-2"><b>Profile Picture*</b></label>
				<input id="image" style="height: 45px;"  class="form-control" name="image" type="file" value="">


				<label for="phone" class="mt-2"><b>Phone*</b></label>
				<input required class="form-control" id="phone" name="phone" type="text" value="{{Auth::user()->phone}}">

				

				<label for="address" class="mt-2"><b>Address*</b></label>
				<textarea  name="address" id="address" class="form-control mb-2" cols="30" rows="4">{{Auth::user()->address}}</textarea>

		

				<input type="hidden" name="id" value="{{Auth::user()->id}}">
				<input type="submit" name="submit" value="Update" class="form-control btn-dark">
			</form>
		</div>
	</div>
</div>

@endsection


















