@extends('admin.layouts.master')



@section('title')
<title>{{$product->name}}</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right py-2">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

      <a data-toggle="tooltip" data-placement="top" title="Add New Products" class="btn btn-dark" href="{{route("admin.product.add")}}"> <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i></a>



      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
</div>

<form action="{{route('admin.product.update')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="col-xl-8 offset-xl-2">
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="card p-3 rounded-0">

					<input type="hidden" name="product_id" value="{{$product->id}}">
					<label for="" class="font-pt font-18"><b>Name*</b></label>
					<input type="text" name="name" class="form-control rounded-0 font-pt font-18 mb-2" value="{{$product->name}}">

					<div class="row">
						<div class="col-12 col-lg-6">
							<label for="" class="font-pt font-18"><b>Price*</b></label>
							<input step="any" value="{{$product->price}}" type="number" name="price" class="form-control rounded-0 font-pt font-18 mb-2">
						</div>
						<div class="col-12 col-lg-6">
							<label for="old_price" class="font-pt font-16"><b>Old Price(Tk)</b></label>
							<input value="{{$product->old_price}}"  step="any" type="number" name="old_price" class="form-control rounded-0 font-pt font-18">
						</div>

						<div class="col-12 col-lg-6">
							<label for="" class="font-pt font-18"><b>Stock*</b></label>
							<input value="{{$product->stock}}"  type="number" name="stock" class="form-control rounded-0 font-pt font-18 mb-2">
						</div>
					
						<div class="col-12 col-lg-6">
							<label for="shipping_cost" class="font-pt font-16"><b>Shipping Cost*</b></label>
							<input value="{{$product->shipping_cost}}" required step="any" type="number" name="shipping_cost" class="form-control rounded-0 font-pt font-18">
						</div>
					</div>




					<label for="attributes" class="font-pt font-18"><b>Attributes*</b></label>
					<textarea    name="attr_p" id="product_arrt" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2">{{$product->attributes}}</textarea>


					<label for="description" class="font-pt font-18"><b>Description*</b></label>
					<textarea   name="description" id="description" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2">{{$product->description}}</textarea>



					<div class="row">
						<div class="col-12 ">
							<div class="p-3" id="seo-area">
								
								<label for="meta_description"><b>Meta Descripton</b></label>
								<textarea name="meta_description" id="meta_description" cols="30" rows="3" class="form-control rounded-0 mb-2">{{$product->meta_description}}</textarea>
								<label for="meta_keyword"><b>Meta Keyword</b></label>
								<textarea name="meta_keyword" id="meta_keyword" cols="30" rows="3" class="form-control rounded-0">{{$product->meta_keyword}}</textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 px-5">
							<label for="releted_product"><b>Releted Products</b></label>
							<table class="table table-borderd">
								<tr align="center">
									<th style="width: 5%;">No</th>
									<th style="width: 45%;">Name</th>
									<th style="width: 20%;">Image</th>
									<th style="width: 15%;">Stock</th>
									<th style="width: 10%;">Action</th>
								</tr>
							</table>
						</div>
						<div class="col-12 px-5" style="max-height: 400px; overflow-y: scroll;">
						    <table class="table table-borderd" id="dataTable">
								@foreach($products as $index => $this_product)
								<?php 
									if($this_product->id == $product->id){
										continue;
									}
								?>
								
								<tr align="center">
									<td style="width: 5%;">{{$index+1}}</td>
									<td style="width: 50%;">
										
										 <a target="_blank" href="{{route('admin.product.show', ['slug' => $this_product->slug])}}">{{$this_product->name}}</a>
									</td>
									</td>
									<td style="width: 20%;">
										<img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$this_product->image}}" alt="{{$this_product->name}}">
									</td>
									<td style="width: 15%;">{{$this_product->stock}}</td>
									<td style="width: 10%;">
										<div class="custom-control custom-checkbox">
										  <input @if(in_array($this_product->id,$products_id_arra)) checked @endif value="{{$this_product->id}}" name="releted_product[]" type="checkbox" class="custom-control-input" id="releted-product-{{$this_product->id}}">
										  <label class="custom-control-label" for="releted-product-{{$this_product->id}}"></label>
										</div>
									</td>
								</tr>
								@endforeach
							</table>
						</div>
					</div>
					

					<input type="submit" value="submit" class="form-control my-2 btn_1">

				</div>
			</div>
			<div class="col-12 col-lg-4"> 
				<div class="card p-3 rounded-0">
{{-- 
					<div class="row mb-2">
						<div class="col-12 col-lg-12">
							<label for="product_colors" class="font-pt font-16"><b>Color</b></label>
							<textarea  name="product_colors" id="product_colors" cols="30" rows="2" class="form-control rounded-0 font-pt font-18 mb-2" placeholder="333, f1f1f1, d1d1d1">{{$product->color}}</textarea>
						</div>
						<div class="col-12 col-lg-12">
							<label for="product_size" class="font-pt font-16"><b>Size</b></label>
							<textarea  name="product_size" id="product_size" cols="30" rows="2" class="form-control rounded-0 font-pt font-18 mb-2" placeholder="L, Xl, XXl, M, S">{{$product->size}}</textarea>
						</div>
					</div> --}}

					<label for="unit" class="font-pt font-16"><b>Product Unit*</b></label>
					<select required name="unit" id="unit" class="form-control rounded-0 font-pt font-18 mb-2" >
						
						<option class="font-pt font-18 py-2" value="{{$product->unit}}">{{$product->unit}}</option>
						<option class="font-pt font-18 py-2" value="Piece">Piece</option>
						<option class="font-pt font-18 py-2" value="Set(2)">Set(2)</option>
						<option class="font-pt font-18 py-2" value="Set(3)">Set(3)</option>
						<option class="font-pt font-18 py-2" value="Set(4)">Set(4)</option>
						<option class="font-pt font-18 py-2" value="Set(5)">Set(5)</option>
						<option class="font-pt font-18 py-2" value="Half a Dozen">Half a Dozen</option>
						<option class="font-pt font-18 py-2" value="Dozen">Dozen</option>
						<option class="font-pt font-18 py-2" value="kg">Kilogram</option>
						<option class="font-pt font-18 py-2" value="g">Gram</option>
						<option class="font-pt font-18 py-2" value="Liter">Liter</option>
						<option class="font-pt font-18 py-2" value="Gallon">Gallon</option>
						<option class="font-pt font-18 py-2" value="Square foot">Square foot</option>
						<option class="font-pt font-18 py-2" value="meter">meter</option>
						<option class="font-pt font-18 py-2" value="Tola">Tola</option>
						<option class="font-pt font-18 py-2" value="Ounce">Ounce</option>
						<option class="font-pt font-18 py-2" value="Gram 24K">Gram 24K</option>
						<option class="font-pt font-18 py-2" value="Gram 22K">Gram 22K</option>
						<option class="font-pt font-18 py-2" value="Gram 21K">Gram 21K</option>
						<option class="font-pt font-18 py-2" value="Gram 18K">Gram 18K</option>
						
					</select>


					<label for="" class="font-pt font-18"><b>Category*</b></label>
					<select name="category[]" id="category" class="form-control rounded-0 font-pt font-18 mb-2" multiple>
						
						@foreach($categories as $category)
						@if(in_array($category->name,$cat_array))
						<option selected class="font-pt font-18 py-2" value="{{$category->id}}">{{$category->name}}</option>
						@else
						<option class="font-pt font-18 py-2" value="{{$category->id}}">{{$category->name}}</option>
						@endif
						
						@endforeach
					</select>

					<label for="offer" class="font-pt font-16"><b>Offer*</b></label>
					<select required name="offer" id="offer" class="form-control rounded-0 font-pt font-18 mb-2" >
						<option class="font-pt font-18 py-2" value="0">Regular Price</option>
						@foreach($offers as $offer)
						@if($offer->active == 1)
						<option class="font-pt font-18 py-2" @if($product->offer_id == $offer->id) selected @endif value="{{$offer->id}}">{{$offer->name}}</option>
						@endif
						@endforeach
					</select>






					<label for="" class="font-pt font-18"><b>Image*(Base)</b></label>
					
					<input class="form-control input-file" type="file" name="base_image" id="base-image">
					<p id="image-validate-base" class=" text-danger  text-center"></p>
					

					<div class="card m-2 product-image-preview-area" id="base-image-show">
						<div class="preview" id="base-image-preview" style="background:url('{{URL::asset('/assets/img/products/')}}/{{$product->image}}');background-size:cover;" ></div>
					</div>


					<div class="old-image">
						@php $i = 0; @endphp            
						@foreach ($product->images as $p_img )
						@php $i++; @endphp
						<div class="product-new-image mt-2">
							<span data-id="{{$p_img->id}}" class="delete-this-image">X</span>
							<label class="font-pt font-18"  for=""><b>Slider - {{$i}}</b></label>

							<input data-total="{{$i}}" class="form-control new-image input-file" type="file" name="slider_{{$i}}">
							<p id="image-validate-{{$i}}" class=" text-danger  text-center"></p>
							<div class="card m-2 product-image-preview-area" >
								<div id="preview-{{$i}}" class="preview"  style="background:url({{URL::asset('/assets/img/products')}}/{{$p_img->image}});background-size:cover;"></div>
							</div>

							<input type="hidden" name="old_img_name_array[]" value="{{$p_img->image}}">
							<input type="hidden" name="old_img_id_array[]" value="{{$p_img->id}}">
						</div>
						@endforeach
					</div>

					<div id="old-slider-delete-array">
						
					</div>



					<input type="hidden" value="{{count($product->images)}}" name="total_old_img">

					<div id="more-image-area"></div>

					<button id="add-more-image-btn" class="btn_1 my-2 font-18 font-pt">Add More Image</button>



					<label for="available" class="font-pt font-18"><b>Availability</b></label>
					<select name="available" id="available" class="form-control rounded-0 font-pt font-18 mb-2">
						<option class="py-2" @if($product->available == 1) selected @endif value="1">Available</option>
						<option class="py-2" @if($product->available == 0) selected @endif value="0">Not Available</option>
					</select>


					<label for="active" class="font-pt font-18"><b>Active</b></label>
					<select name="active" id="active" class="form-control rounded-0 font-pt font-18 mb-2">
						<option class="py-2" @if($product->active == 0) selected @endif value="0">Not Active</option>
						<option class="py-2" @if($product->active == 1) selected @endif value="1">Active</option>
					</select>


				</div>
			</div>
		</div>
	</div>
	
</form>


@endsection


@section('footer-section')


<script>
	{{-- $('#base-image-show').hide(); --}}
	var preview_id;
	$(document).ready(function(){

				//add more image code start / create area  
				$("#add-more-image-btn").click(function(e){
					var total = $(".product-new-image").length;
					var new_img = `
					<div class="product-new-image mt-2">
					<span class="delete-this-image">X</span>
					<label class="font-pt font-18"  for=""><b>Slider - `+(total+1)+`</b></label>

					<input data-total="`+(total+1)+`" class="form-control new-image input-file" type="file" name="more_image[]">
					<p id="image-validate-`+(total+1)+`" class=" text-danger  text-center"></p>
					<div class="card m-2 product-image-preview-area" >
					<div id="preview-`+(total+1)+`" class="preview"  ></div>

					</div>
					</div>
					`;
					$("#more-image-area").append(new_img);
					e.preventDefault();
					return false;
				}) // end add more image code

				// start base image code
				$("#base-image").change(function(){
					var img_size=(this.files[0].size);
					if(img_size > 2000000) {
						$(this).val('');
						$("#image-validate-base").html("Image size is too large(size > 2MB)! use < 2MB ");
					}else{
						
						//file type validation 
						var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
						if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
							$("#image-validate-base").html("Only formats are allowed :"+fileExtension.join(', '));
							$(this).val('');
						}else{
							$("#image-validate-base").html("");
							if (this.files && this.files[0]) {
								var reader = new FileReader();
								reader.onload = function(e,input) {

									$('#base-image-show').show();
									$('#base-image-preview').css('background-image', 'url('+e.target.result +')');
									$('#base-image-preview').hide();
									$('#base-image-preview').fadeIn(650);
								}
								reader.readAsDataURL(this.files[0],this);
							}
						}
					}
				}) // end base image validation and show
			}) // end jquery

			//slider image and new image code start 
			$(document).on('change', '.new-image', function(){  
				
			   preview_id = $(this).data('total'); // get preview id for show
			   
				var img_size=(this.files[0].size); // this image size

				if(img_size > 2000000) {
				  //size validation 
				  $(this).val('');
				  showValidationText(preview_id,"Image size is too large(size > 2MB)! use < 2MB ");

				}else{
					
					//file type validation 
					var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
					if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {

						showValidationText(preview_id,"Only formats are allowed :"+fileExtension.join(', '));
						$(this).val('');

					}else{
						showValidationText(preview_id,"");
						if (this.files && this.files[0]) {
							var reader = new FileReader();
							reader.onload = function(e,input) {
								$('#preview-'+preview_id).css('background-image', 'url('+e.target.result +')');
								$('#preview-'+preview_id).hide();
								$('#preview-'+preview_id).fadeIn(650);
							}
							reader.readAsDataURL(this.files[0],this);
						}
					} // end type validation

				} // end size validation

			}) // slider image and new image code end


			function showValidationText(divId,text){
				$("#image-validate-"+divId).html(text);
			}

			$(document).on('click','.delete-this-image',function(){

				var id = $(this).attr('data-id');
				// make a input filed array to delete the image form db 

				if(id != undefined){
					$("#old-slider-delete-array").append('<input type="hidden" name="slider_image_delete_id_array[]" value="'+id+'" />')

				}
				

				$(this).parent().remove();               
			})


		</script>

		<script>


			$(document).ready(function() {
				$('#product_arrt').summernote({

					placeholder: 'Products Attributes',
					tabsize: 4,
					height: 200,
					toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['font', ['strikethrough', 'superscript', 'subscript']],
					['fontsize', ['fontsize']],
					['view', ['fullscreen', 'codeview', 'help']]
					]
				});
			});

		</script>


		@endsection