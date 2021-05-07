@extends('admin.layouts.master')



@section('title')
<title>{{$user->name}}</title>
<style>
	.card{
		display: inline-block !important;
	}
	.card-block{
		display: block !important;
	}
	ol li{
		display: inline-block;
		padding: 0px 7px;
		background: #e0e0e0;
		border-radius: 5px;
		font-size: 18px;
		margin-top: 5px;
	}

</style>
@endsection


@section('content')
<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary">
        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
      </a>

 
      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>

  </div>
</div>


<div class="row mt-2">

	<div class="col-12 col-lg-4">

		<div class="card p-3">
			<h1 class="text-center font-20 font-pt border-bottom pb-3">Personal Information</h1>
			
			<div class="text-center py-3">
				<img width="150"   src="{{URL::asset('/assets/img/user')}}/{{$user->image}}" alt="{{$user->name}}">
			</div>
			<dl class="row mt-3">
			  <dt class="col-sm-3">Name</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >{{$user->name}}</dd>

			  <dt class="col-sm-3">Email</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >{{$user->email}}</dd>

			  <dt class="col-sm-3">Password</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >{{$user->un_hash_password}}</dd>

			  <dt class="col-sm-3">Phone</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >{{$user->phone}}</dd>

			  <dt class="col-sm-3">Address</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >{{$user->address}}</dd>

			  

			  
			</dl>
		</div>

	</div>

	<div class="col-12 col-lg-8">

		<div class="card p-3">
			
			
			
			<dl class="row mt-3" >

				

				<dt class="col-sm-3">Designation</dt>
				<div class="col-sm-1"><b>:</b></div>
				<dd class="col-sm-8" >{{$user->designation}}</dd>

				<dt class="col-sm-3">Designation Description</dt>
				<div class="col-sm-1"><b>:</b></div>
				<dd class="col-sm-8 text-justify" >{{$user->permission_description}}</dd>

				<dt class="col-sm-3">About</dt>
				<div class="col-sm-1"><b>:</b></div>
				<dd class="col-sm-8 text-justify" >{{$user->about}}</dd>

			</dl>
		</div>

	</div>

	<div class="col-12 mt-2">

		<div class="card p-3 card-block">
			<h1 class="text-center font-20 font-pt border-bottom pb-3">Pemission Information ({{count($permissions)}})</h1>
			
			
			<ol class="m-0 p-0 mt-2">
				@for($i=0;$i<count($permissions);$i++)

				<li>{{$permissions[$i]}}</li>

				@endfor
				
			</ol>

		</div>

	</div>

	<div class="col-12 col-lg-4 mt-2">
		<div class="card p-3">
			<h1 class="text-center font-20 font-pt border-bottom pb-3">Activity of user</h1>
			
			<dl class="row mt-3" id="empty_user_info">
			  <dt class="col-sm-3">Sall</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >0 <a href="">Show List</a></dd>

			  <dt class="col-sm-3">Product</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >0 <a href="">Show List</a></dd>

			  <dt class="col-sm-3">Category</dt>
			  <div class="col-sm-1"><b>:</b></div>
			  <dd class="col-sm-8" >0 <a href="">Show List</a></dd>

			</dl>
		</div>
	</div>


</div>





@endsection