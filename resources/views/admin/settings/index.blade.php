@extends('admin.layouts.master')


@section('title')
<title>Website Settings</title>

<style>
	h2{
		font-size: 22px;
		text-align: center;
	}
</style>
@endsection





@section('content')

<!-- page title area  -->
<div class="row">
	<div class="col-12 text-right">
		<a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
	</div>
</div>

<div class="row mt-3">

	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h2 class="border-bottom pb-2 mb-4">Website Settings</h2>

			<form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-12 col-lg-6">
						<label for="logo" class="mt-2"><b>Logo*</b></label>
						<input type="file" name="logo" id="logo" class="form-control rounded-0" style="height: 50px;">
					</div>

					<div class="col-12 col-lg-6">
						<label for="fev_icon" class="mt-2"><b>Fev-Icon*</b></label>
						<input type="file" name="fev_icon" id="fev_icon" class="form-control rounded-0" style="height: 50px;">
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-6">
						<label for="email" class="mt-2"><b>Email*</b></label>
						<input type="email" name="email" id="email" class="form-control rounded-0" value="{{$settings->email}}">
					</div>
					<div class="col-12 col-lg-6">
						<label for="phone" class="mt-2"><b>Phone*</b></label>
						<input type="text" name="phone" id="phone" class="form-control rounded-0" value="{{$settings->phone}}">
					</div>
					<div class="col-12 col-lg-12">
						<label for="address" class="mt-2"><b>Address*</b></label>
						<input type="text" name="address" id="address" class="form-control rounded-0" value="{{$settings->address}}">
					</div>


					<div class="col-12 col-lg-12">
						<label for="location" class="mt-2"><b>Location*</b></label>

						<textarea name="location" id="location" cols="30" rows="4" class="form-control rounded-0">{{$settings->location}}</textarea>
					</div>


					<div class="col-12 col-lg-12">
						<label for="copyright" class="mt-2"><b>Copyright*</b></label>
						<input type="text" name="copyright" id="copyright" class="form-control rounded-0" value="{{$settings->copyright}}">
					</div>
				</div>


				<input type="submit" class="btn_1 mt-2 form-control" value="Update">

			</form>

		</div>
	</div>

	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h2 class="border-bottom pb-2 mb-4">Ecommerce Settings</h2>

			<form action="{{route('admin.ecommerce.update')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-12 col-lg-6">
						<label for="product_prefix" class="mt-2"><b>Product Prefix*</b></label>
						<input type="text" name="product_prefix" id="product_prefix" class="form-control rounded-0" value="{{$settings->product_prefix}}">
					</div>

					<div class="col-12 col-lg-6">
						<label for="order_prefix" class="mt-2"><b>Order Prefix*</b></label>
						<input type="text" name="order_prefix" id="order_prefix" class="form-control rounded-0" value="{{$settings->order_prefix}}">
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-6">
						<label for="invoice_prefix" class="mt-2"><b>Invoice Prefix*</b></label>
						<input type="text" name="invoice_prefix" id="invoice_prefix" class="form-control rounded-0" value="{{$settings->invoice_prefix}}">
					</div>

					<div class="col-12 col-lg-6">
						<label for="order_prefix" class="mt-2"><b>Order Prefix*</b></label>
						<input type="text" name="order_prefix" id="order_prefix" class="form-control rounded-0" value="{{$settings->order_prefix}}">
					</div>

					<div class="col-12 col-lg-12">
						<label for="order_notification_emails" class="mt-2"><b>Order Notification Emails*</b></label>
						<textarea name="order_notification_emails" id="order_notification_emails" cols="30" rows="4" class="form-control rounded-0">{{$settings->order_notification_emails}}</textarea>
					</div>

					<div class="col-12 col-lg-12">
						<label for="review_notification_emails" class="mt-2"><b>Review Notification Emails*</b></label>
						<textarea name="review_notification_emails" id="review_notification_emails" cols="30" rows="5" class="form-control rounded-0">{{$settings->review_notification_emails}}</textarea>
					</div>

				</div>




				<input type="submit" class="btn_1 mt-2 form-control" value="Update">

			</form>

		</div>
	</div>


	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h2 class="border-bottom pb-2 mb-4 mb-2">Website SEO || Home Page </h2>
		
			<form action="{{route('admin.settings.seo.update')}}" method="post">
				@csrf

				<div class="row">

					<div class="col-12">
						<label for="title"><b>Title*</b></label>
						<input type="text" name="title" id="title" class="form-control rounded-0" value="{{$settings->title}}">
					</div>


					<div class="col-12 col-lg-12">
						<label for="tag" class="mt-2"><b>Tag*</b></label>
						<textarea class="form-control rounded-0"  id="tag" name="tag" rows="5">{{$settings->tag}}</textarea>
					</div>
					<div class="col-12 col-lg-12">
						<label for="description" class="mt-2"><b>Description*</b></label>
						<textarea class="form-control rounded-0"  id="description" name="description"  rows="8">{{$settings->description}}</textarea>
					</div>
				</div>

				<input type="submit" class="btn_1 mt-2 form-control" value="Update">
			</form>
		</div>
	</div>


	<div class="col-12 col-lg-4 mt-2">
		<div class="card p-3">
			<h2 class="border-bottom pb-2 mb-4 mb-2">Social Media</h2>
		
			<form action="{{route('admin.settings.social_media.update')}}" method="post">
				@csrf

				<div class="row">
					<div class="col-12 col-lg-12">
						<label for="facebook" class="mt-2"><b>Facebook</b></label>
						<input type="text" name="facebook" id="facebook" class="form-control rounded-0" value="{{$settings->facebook}}">
					</div>
					<div class="col-12 col-lg-12">
						<label for="youtube" class="mt-2"><b>Youtube</b></label>
						<input type="text" name="youtube" id="youtube" class="form-control rounded-0" value="{{$settings->youtube}}">
					</div>

					<div class="col-12 col-lg-12">
						<label for="twitter" class="mt-2"><b>Twitter</b></label>
						<input type="text" name="twitter" id="twitter" class="form-control rounded-0" value="{{$settings->twitter}}">
					</div>
					<div class="col-12 col-lg-12">
						<label for="instagram" class="mt-2"><b>Instagram</b></label>
						<input type="text" name="instagram" id="instagram" class="form-control rounded-0" value="{{$settings->instagram}}">
					</div>

					<div class="col-12 col-lg-12">
						<label for="facebook_messenger" class="mt-2"><b>Facebook Messenger</b></label>

						<textarea name="facebook_messenger" id="facebook_messenger" cols="30" rows="5" class="form-control rounded-0">{{$settings->facebook_messenger}}</textarea>
					</div>


				</div>

				<input type="submit" class="btn_1 mt-2 form-control" value="Update">
			</form>
		</div>
	</div>


</div>




@endsection
@section('footer-section')
<script>


	$(document).ready(function() {
		$('.html-editor').summernote({


			tabsize: 4,
			height: 400,
			toolbar: [

			['font', ['bold', 'underline', 'clear']],

			['para', ['ul', 'ol', 'paragraph']],

			['fontsize', ['fontsize']],

			]
		});
	});

</script>
@endsection
