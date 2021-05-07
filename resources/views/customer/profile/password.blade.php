@extends('customer.layouts.master')

@section('title')
Update Profile | {{Auth::user()->name}}
@endsection



@section('content')


<div class="row ">
	<div class="col-12 col-xl-10 offset-xl-1 ">
		<div class="card p-3">
			<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Change Password</h3>
			
			<form action="{{route('customer.profile.password_change')}}" method="post">
				@csrf
				<input type="hidden" name="id" value="{{Auth::user()->id}}">
				<div class="row">
					<div class="col-12 col-lg-6 mb-2 offset-lg-3">
						<label for="old_password mt-2"><b>Old Password*</b></label>
						<input required  type="password" name="old_password" id="old_password" class="form-control " >
					</div>
					<div class="col-12 col-lg-6 mb-2 offset-lg-3">
						<label for="new_password mt-2"><b>New Password*</b></label>
						<input required  type="password" name="new_password" id="new_password" class="form-control " >
					</div>
					<div class="col-12 col-lg-6 mb-2 offset-lg-3">
						<label for="confirm_new_password mt-2"><b>Confirm Password*</b></label>
						<input required  type="password" name="confirm_new_password" id="confirm_new_password" class="form-control " >
					</div>
				</div>
				<input type="submit" class="btn-dark mt-2 form-control" value="Update">
			</form>
		</div>
	</div>
</div>

@endsection


















