@extends('admin.layouts.master')

@section('title')
<title>{{$user->name}}</title>
@endsection

@section('custom-css')
	
	<style>
		.permission-title h3{
			font-size: 20px;
			font-weight: bold;
		}
		.title-border{
			border-bottom: 1px solid rgba(0,0,0,0.125);
		}
		h1{
			font-size:25px;
			text-transform: capitalize;
		}
	</style>
	
@endsection



@section('content')
<!-- page title area  -->
<div class="row">
	<div class="col-12 text-right">
		<a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary">
			<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
		</a>
		<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
	</div>
</div>




<form action="{{route('admin.user.update')}}" method="post" id="user_add_form">

	<input type="hidden" name="id" value="{{$user->id}}">
<!-- website info area start  -->
	<div class="row mt-2">

		<div class="col-12 mb-2">
			<div class="card p-3">
				<h1 class="text-center">Update user information</h1>
			</div>
		</div>


		<div class="col-12 col-lg-4  mb-3">
		  <div class="card p-3 rounded-0">
			@csrf
			<label for="image" class="mb-2"><b>Image*</b></label>
			<input  style="height: 50px;"  type="file" class="form-control rounded-0 mb-2" name="image">

			<label for="title" class="mb-2"><b>Name*</b></label>
			<input value="{{$user->name}}" required  type="text" class="form-control rounded-0 mb-2" name="name">


			<label for="title" class="mb-2"><b>Email*</b></label>
			<input required  type="email" class="form-control rounded-0 mb-2" name="email" value="{{$user->email}}">


			<label for="title" class="mb-2"><b>Phone*</b></label>
			<input required  type="text" class="form-control rounded-0 mb-2" name="phone" value="{{$user->phone}}">

			<label for="title" class="mb-2"><b>Password*</b></label>
			<input required  type="text" class="form-control rounded-0 mb-2" name="password" value="{{$user->un_hash_password}}">


			<label for="title" class="mb-2"><b>Designation*</b></label>
			<input value="{{$user->designation}}" required  type="text" class="form-control rounded-0 mb-2" name="designation">

			
			
		  </div>
		</div>

		<div class="col-12 col-lg-8">
			<div class="card p-3">

				<label for="description" class="mb-2"><b>Designation Description*</b></label>
				<textarea required    id="description" cols="30" rows="5" name="description" class="form-control mb-2">{{$user->permission_description}}</textarea>
			
				<label for="address" class="mb-2"><b>Address*</b></label>
				<textarea required    id="address" cols="30" rows="1" name="address" class="form-control mb-2">{{$user->address}}</textarea>
				
				<label for="about" class="mb-2"><b>About*</b></label>
				<textarea required    id="about" cols="30" rows="5" name="about" class="form-control mb-2">{{$user->about}}</textarea>
				
				<input type="submit" value="Update" class="btn btn-primary rounded-0">

				
			</div>
		</div>


		<div class="col-12">
			<h3 class="text-center font-pt font-25">Permissions</h3>
			<hr>
		</div>



	
		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border" >
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.products',$permissions)) checked @endif type="checkbox" name="permission[]" id="products"  value="admin.products">
		   			  <label for="products">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Products</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-show" value="admin.product.show">
				        <label class="custom-control-label font-18 font-pt" for="product-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-store" value="admin.product.store,admin.product.add">
				        <label class="custom-control-label font-18 font-pt" for="product-store">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-edit" value="admin.product.edit,admin.product.update">
				        <label class="custom-control-label font-18 font-pt" for="product-edit">Edit</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-delete" value="admin.product.delete">
				        <label class="custom-control-label font-18 font-pt" for="product-delete">Delete</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.product.active_deactivated',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-active" value="admin.product.active_deactivated">
						<label class="custom-control-label font-18 font-pt" for="product-active">Active / Deactivate</label>
					</div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.product.home_show_hide',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-show-hide" value="admin.product.home_show_hide">
						<label class="custom-control-label font-18 font-pt" for="product-show-hide">Show / Hode (Home Page)</label>
					</div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.product.download',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-download" value="admin.product.download">
						<label class="custom-control-label font-18 font-pt" for="product-download">Download</label>
					</div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border" >
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.reviews',$permissions)) checked @endif type="checkbox" id="reviews" name="permission[]" value="admin.reviews">
		   			  <label for="reviews">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Review</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.review.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input review-permission" id="review-show" value="admin.review.show">
				        <label class="custom-control-label font-18 font-pt" for="review-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.review.active',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input review-permission" id="review-active" value="admin.review.active">
				        <label class="custom-control-label font-18 font-pt" for="review-active">Active</label>
				     </div>
				</div>

{{-- 				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input" id="customControlAutosizing">
				        <label class="custom-control-label font-18 font-pt" for="customControlAutosizing">Edit</label>
				     </div>
				</div> --}}
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.review.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input review-permission" id="review-delete" value="admin.review.delete">
				        <label class="custom-control-label font-18 font-pt" for="review-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>


	

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.categories',$permissions)) checked @endif type="checkbox" name="permission[]" id="categories"  value="admin.categories">
		   			  <label for="categories">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Category</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-show" value="admin.category.show">
				        <label class="custom-control-label font-18 font-pt" for="category-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-add" value="admin.category.store">
				        <label class="custom-control-label font-18 font-pt" for="category-add">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-edit" value="admin.category.edit,admin.category.update">
				        <label class="custom-control-label font-18 font-pt" for="category-edit">Edit</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.category.show_home',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-show_home" value="admin.category.show_home">
						<label class="custom-control-label font-18 font-pt" for="category-show_home">Show / Hide (Home Page)</label>
					</div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.category.left_nav',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-left_nav" value="admin.category.left_nav">
						<label class="custom-control-label font-18 font-pt" for="category-left_nav">Left Nav (Home Page)</label>
					</div>
				</div>


				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.category.download',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-download" value="admin.category.download">
						<label class="custom-control-label font-18 font-pt" for="category-download">Download</label>
					</div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-delete" value="admin.category.delete">
				        <label class="custom-control-label font-18 font-pt" for="category-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
			<div class="card p-3 rounded-0">

				<div class="permission-title title-border">
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="toggleCheck chk3 d-inline">
								<input @if(in_array('admin.front_ends',$permissions)) checked @endif type="checkbox" name="permission[]" id="features"  value="admin.front_ends">
								<label for="features">
									<div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
								</label>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<h3>Features</h3>
						</div>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.sliders',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input features-permission" id="slider-show" 
							value="admin.sliders,admin.slider.add,admin.slider.show,admin.slider.delete,admin.slider.active,admin.slider.store,admin.slider.update">
							<label class="custom-control-label font-18 font-pt" for="slider-show">Slider</label>
						</div>
					</div>
					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.faqs',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input features-permission" id="slider-add"  
							value="admin.faqs,admin.faq.add,admin.faq.show,admin.faq.delete,admin.faq.store,admin.faq.edit,admin.faq.update">
							<label class="custom-control-label font-18 font-pt" for="slider-add">Faq</label>
						</div>
					</div>

					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.popups',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input features-permission" id="popup-add"  
							value="admin.popups,admin.popup.add,admin.popup.show,admin.popup.delete,admin.popup.store,admin.popup.active">
							<label class="custom-control-label font-18 font-pt" for="popup-add">PopUp</label>
						</div>
					</div>

				</div>
			</div>
		</div>


		<div class="col-12 col-lg-4 mb-2">
			<div class="card p-3 rounded-0">
				<div class="permission-title title-border">
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="toggleCheck chk3 d-inline">
								<input @if(in_array('admin.offers',$permissions)) checked @endif type="checkbox" name="permission[]" id="offers"  value="admin.offers">
								<label for="offers">
									<div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
								</label>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<h3>Offers</h3>
						</div>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.offer.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input offer-permission" id="offer-show" value="admin.offer.show">
							<label class="custom-control-label font-18 font-pt" for="offer-show">Show</label>
						</div>
					</div>
					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.offer.add',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input offer-permission" id="offer-store" value="admin.offer.add,admin.offer.store">
							<label class="custom-control-label font-18 font-pt" for="offer-store">Add</label>
						</div>
					</div>

					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.offer.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input offer-permission" id="offer-edit" value="admin.offer.edit,admin.offer.update">
							<label class="custom-control-label font-18 font-pt" for="offer-edit">Edit</label>
						</div>
					</div>

					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.offer.active',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input offer-permission" id="offer-active" value="admin.offer.active">
							<label class="custom-control-label font-18 font-pt" for="offer-active">Active / Deactivate</label>
						</div>
					</div>


					<div class="col-6 mb-2">
						<div class="custom-control custom-checkbox mr-sm-2">
							<input @if(in_array('admin.offer.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input offer-permission" id="offer-delete" value="admin.offer.delete">
							<label class="custom-control-label font-18 font-pt" for="offer-delete">Delete</label>
						</div>
					</div>

				</div>
			</div>
		</div> {{-- end offers --}}
	

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.coupons',$permissions)) checked @endif type="checkbox" name="permission[]" id="coupons"  value="admin.coupons">
		   			  <label for="coupons">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Coupons</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-show" value="admin.coupon.show">
				        <label class="custom-control-label font-18 font-pt" for="coupon-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-store" value="admin.coupon.store">
				        <label class="custom-control-label font-18 font-pt" for="coupon-store">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-edit" value="admin.coupon.edit,admin.coupon.update">
				        <label class="custom-control-label font-18 font-pt" for="coupon-edit">Edit</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-delete" value="admin.coupon.delete">
				        <label class="custom-control-label font-18 font-pt" for="coupon-delete">Delete</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.coupon.active',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-active" value="admin.coupon.active">
						<label class="custom-control-label font-18 font-pt" for="coupon-active">Active / Deactivate</label>
					</div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.orders',$permissions)) checked @endif type="checkbox" name="permission[]" id="orders" name="permission[]" value="admin.orders">
		   			  <label for="orders">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Order</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-show" value="admin.order.show">
				        <label class="custom-control-label font-18 font-pt" for="order-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-edit" value="admin.order.show,admin.order.update,admin.order.accept_product">
				        <label class="custom-control-label font-18 font-pt" for="order-edit">Update</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-delete" value="admin.order.delete">
				        <label class="custom-control-label font-18 font-pt" for="order-delete">Delete</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.invoice',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-invoice" value="admin.order.invoice
				        ">
				        <label class="custom-control-label font-18 font-pt" for="order-invoice">Invoice</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.order.download',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-download" value="admin.order.download">
						<label class="custom-control-label font-18 font-pt" for="order-download">Download</label>
					</div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.customers',$permissions)) checked @endif type="checkbox" name="permission[]" id="customers"  value="admin.customers">
		   			  <label for="customers">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Customer</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.customer.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input customer-permission" id="user-show" value="admin.customer.show">
				        <label class="custom-control-label font-18 font-pt" for="user-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.customer.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input customer-permission" id="user-delete" value="admin.customer.delete">
				        <label class="custom-control-label font-18 font-pt" for="user-delete">Delete</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input  @if(in_array('admin.customer.block',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input customer-permission" id="user-block" value="admin.customer.block">
						<label class="custom-control-label font-18 font-pt" for="user-block">Block</label>
					</div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.customer.download',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input customer-permission" id="user-download" value="admin.customer.download">
				        <label class="custom-control-label font-18 font-pt" for="user-download">Download</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>



		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.reports',$permissions)) checked @endif type="checkbox" name="permission[]" id="reports"  value="admin.reports">
		   			  <label for="reports">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Report</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.reports.orders',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="order-report" value="admin.reports.orders">
				        <label class="custom-control-label font-18 font-pt" for="order-report">Order</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.reports.product',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="product-report" value="admin.reports.product">
				        <label class="custom-control-label font-18 font-pt" for="product-report">Product</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.reports.category',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="category-report" value="admin.reports.category">
				        <label class="custom-control-label font-18 font-pt" for="category-report">Category</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.reports.customer',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="customer-report" value="admin.reports.customer">
				        <label class="custom-control-label font-18 font-pt" for="customer-report">Customer</label>
				     </div>
				</div>
			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.notification',$permissions)) checked @endif type="checkbox" name="permission[]" id="notification"  value="admin.notification">
		   			  <label for="notification">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Notification</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.notification.order',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input notification-permission" id="order-notification" value="admin.notification.order,admin.order.show">
				        <label class="custom-control-label font-18 font-pt" for="order-notification">Order</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.notification.review',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input notification-permission" id="review-notification" value="admin.notification.review,admin.review.show">
				        <label class="custom-control-label font-18 font-pt" for="review-notification">Review</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.notification.email',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input notification-permission" id="notification-email" value="admin.notification.email,admin.email.show">
				        <label class="custom-control-label font-18 font-pt" for="notification-email">Email</label>
				     </div>
				</div>

			</div>

		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.pages',$permissions)) checked @endif type="checkbox" name="permission[]" id="pages"  value="admin.pages">
		   			  <label for="pages">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Pages</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.about.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="about" value="admin.about.update">
				        <label class="custom-control-label font-18 font-pt" for="about">About</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.privacy.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="privacy" value="admin.privacy.update">
				        <label class="custom-control-label font-18 font-pt" for="privacy">Privacy</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.condition.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="condition" value="admin.condition.update">
				        <label class="custom-control-label font-18 font-pt" for="condition">Terms And Condition</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.contact.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="contact" value="admin.contact.update">
				        <label class="custom-control-label font-18 font-pt" for="contact">Contact</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.emails',$permissions)) checked @endif type="checkbox" name="permission[]" id="emails"  value="admin.emails">
		   			  <label for="emails">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Email</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.email.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input email-permission" id="email-show" value="admin.email.show">
				        <label class="custom-control-label font-18 font-pt" for="email-show">Show</label>
				     </div>
				</div>



				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.email.send',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input email-permission" id="email-send" value="admin.email.send">
				        <label class="custom-control-label font-18 font-pt" for="email-send">Send</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.email.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input email-permission" id="email-delete" value="admin.email.delete">
				        <label class="custom-control-label font-18 font-pt" for="email-delete">Delete</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
						<input @if(in_array('admin.email.download',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input email-permission" id="email-download" value="admin.email.download">
						<label class="custom-control-label font-18 font-pt" for="email-download">Download</label>
					</div>
				</div>
			</div>
		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.settings',$permissions)) checked @endif type="checkbox" name="permission[]" id="settings"  value="admin.settings">
		   			  <label for="settings">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Settings</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="website-sttings" value="admin.settings.update">
				        <label class="custom-control-label font-18 font-pt" for="website-sttings">Website Settings</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.ecommerce.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="ecommerce-settings" value="admin.ecommerce.update" >
				        <label class="custom-control-label font-18 font-pt" for="ecommerce-settings">E-Commerce Settings</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.social_media.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="social-media" value="admin.settings.social_media.update">
				        <label class="custom-control-label font-18 font-pt" for="social-media">Social Media</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.seo.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="home-page-settings" value="admin.settings.seo.update">
				        <label class="custom-control-label font-18 font-pt" for="home-page-settings">Home Page SEO</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.notification.email',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="email-settings" value="admin.settings.notification.email">
				        <label class="custom-control-label font-18 font-pt" for="email-settings">Notification Email Settings</label>
				     </div>
				</div>


			</div>
		  </div>
		</div>
	</div>
  </form>
@endsection




@section('footer-section')
<script>
	$(document).ready(function(){


		$("#products").click(function(){
			all_seletce_unselect("product-permission",'products');
		})
		$("#reviews").click(function(){
			all_seletce_unselect("review-permission",'reviews');
		})
		
		
		$("#categories").click(function(){
			all_seletce_unselect("category-permission",'categories');
		})
		$("#features").click(function(){
			all_seletce_unselect("features-permission",'features');
		})
		

		$("#coupons").click(function(){
			all_seletce_unselect("coupon-permission",'coupons');
		})

		$("#offers").click(function(){
			all_seletce_unselect("offer-permission",'offers');
		})

		$("#orders").click(function(){
			all_seletce_unselect("order-permission",'orders');
		})
		$("#customers").click(function(){
			all_seletce_unselect("customer-permission",'customers');
		})
		$("#reports").click(function(){
			all_seletce_unselect("report-permission",'reports');
		})
		$("#notification").click(function(){
			all_seletce_unselect("notification-permission",'notification');
		})
		$("#pages").click(function(){
			all_seletce_unselect("page-permission",'pages');
		})
		$("#emails").click(function(){
			all_seletce_unselect("email-permission",'emails');
		})
		$("#banners").click(function(){
			all_seletce_unselect("banner-permission",'banners');
		})
		$("#datas").click(function(){
			all_seletce_unselect("data-permission",'datas');
		})
		$("#settings").click(function(){
			all_seletce_unselect("setting-permission",'settings');
		})







		$(".product-permission").click(function(){
			premissionCheckedUnchecked("product-permission","products");
		})
		$(".review-permission").click(function(){
			premissionCheckedUnchecked("review-permission","reviews");
		})

			

		$(".category-permission").click(function(){
			premissionCheckedUnchecked("category-permission","categories");
		})

		$(".features-permission").click(function(){
			premissionCheckedUnchecked("features-permission","features");
		})

	

		$(".coupon-permission").click(function(){
			premissionCheckedUnchecked("coupon-permission","coupons");
		})

		$(".offer-permission").click(function(){
			premissionCheckedUnchecked("offer-permission","offers");
		})


		$(".order-permission").click(function(){
			premissionCheckedUnchecked("order-permission","orders");
		})

		$(".customer-permission").click(function(){
			premissionCheckedUnchecked("customer-permission","customers");
		})

		$(".report-permission").click(function(){
			premissionCheckedUnchecked("report-permission","reports");
		})

		$(".notification-permission").click(function(){
			premissionCheckedUnchecked("notification-permission","notification");
		})

		$(".page-permission").click(function(){
			premissionCheckedUnchecked("page-permission","pages");
		})

		$(".email-permission").click(function(){
			premissionCheckedUnchecked("email-permission","emails");
		})

		$(".banner-permission").click(function(){
			premissionCheckedUnchecked("banner-permission","banners");
		})


		$(".data-permission").click(function(){
			premissionCheckedUnchecked("data-permission","datas");
		})

		$(".setting-permission").click(function(){
			premissionCheckedUnchecked("setting-permission","settings");
		})

	})



		// doc 

		function premissionCheckedUnchecked(all_premission,main_premission){
			
			var all = $("."+all_premission);
			for(var i=0; i< all.length; i++){
				if($(all[i]).prop('checked') == true){
					$("#"+main_premission).prop('checked',true);
					break;
				}else{
					$("#"+main_premission).prop('checked',false);
				}
			}
			
		} // end


		function all_seletce_unselect(all_premission,main_premission){

			if($("#"+main_premission).prop('checked') == true){
				$("."+all_premission).prop('checked',true);
			}else{
				$("."+all_premission).prop('checked',false);
			}
		} // end


		
	</script>
	@endsection