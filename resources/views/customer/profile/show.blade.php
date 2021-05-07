@extends('customer.layouts.master')

@section('title')
{{Auth::user()->name}}
@endsection



@section('content')

	
	<div class="row">
		<div class="col-12 col-lg-12">
			<div class="card p-3">
				<h4 class="font-pt font-25 text-center border-bottom pb-2">Information</h4>
				
				<div class="row">
					<div class="col-12 col-lg-3">
						@if(Auth::user()->image == '')
						<img width="100px;" src="{{URL::asset('assets/img/default/user.png')}}" alt="{{Auth::user()->name}}">
						@else

						@endif
					</div>
					<div class="col-12 col-lg-9">
						<ul>
							<li><b>Designation:</b> {{Auth::user()->designation}}</li>
							<li><b>Name:</b> {{Auth::user()->name}}</li>
							<li><b>Email:</b> {{Auth::user()->email}}</li>
							<li><b>Phone:</b> {{Auth::user()->phone}}</li>
							<li><b>Address:</b> {{Auth::user()->address}}</li>
						</ul>
					</div>
				</div>

				
			</div>
		</div>
		
	</div>

@endsection


















