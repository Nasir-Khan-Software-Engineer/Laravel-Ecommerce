@extends('admin.layouts.master')



@section('title')
<title>Add New Products</title>
@endsection


@section('content')
<!-- page title area  -->



<div class="row mb-2">
  <div class="col-12">
  	<div class="text-right">
  		<a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
  		<button class="btn btn-dark" type="button" id="category-modal-btn" data-toggle="tooltip" data-placement="top" title="Add Category"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i></button>

  		
  	</div>
  </div>
</div>




<form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="col-xl-8 offset-xl-2 col-12">
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="card p-3 rounded-0">

					<div class="row">
						<div class="col-12">
							<label for="" class="font-pt font-16"><b>Name*</b></label>
							<input required type="text" name="name" class="form-control rounded-0 font-pt font-18 mb-2">
						</div>
					</div>

					<div class="row my-2">
						<div class="col-12 col-lg-6 mb-2">
							<label for="" class="font-pt font-16"><b>Price*</b></label>
							<input required step="any" type="number" name="price" class="form-control rounded-0 font-pt font-18">
						</div>

						<div class="col-12 col-lg-6">
							<label for="old_price" class="font-pt font-16"><b>Old Price(Tk)</b></label>
							<input  step="any" type="number" name="old_price" class="form-control rounded-0 font-pt font-18">
						</div>

						<div class="col-12 col-lg-6 mb-2">
							<label for="" class="font-pt font-16"><b>Stock*</b></label>
							<input required type="number" name="stock" class="form-control rounded-0 font-pt font-18">
						</div>

						

						<div class="col-12 col-lg-6">
							<label for="shipping_cost" class="font-pt font-16"><b>Shipping Cost*</b></label>
							<input required step="any" type="number" name="shipping_cost" class="form-control rounded-0 font-pt font-18">
						</div>

					</div>

					

					<label for="product_arrt" class="font-pt font-16"><b>Attributes*</b></label>
					<textarea required name="attr_p" id="product_arrt" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2"></textarea>


					<label for="description" class="font-pt font-16 mt-2"><b>Description*</b></label>
					<textarea required name="description" id="description" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2"></textarea>


					<div class="row">
						<div class="col-12 ">
							<div class="p-3" id="seo-area">
								<label for="meta_description"><b>Meta Descripton</b></label>
								<textarea name="meta_description" id="meta_description" cols="30" rows="3" class="form-control rounded-0 mb-2"></textarea>
								<label for="meta_keyword"><b>Meta Keyword</b></label>
								<textarea name="meta_keyword" id="meta_keyword" cols="30" rows="3" class="form-control rounded-0"></textarea>
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
								@foreach($products as $index => $product)
								<tr align="center">
									<td style="width: 5%;">{{$index+1}}</td>
									<td style="width: 50%;">
										
										 <a target="_blank" href="{{route('admin.product.show', ['slug' => $product->slug])}}">{{$product->name}}</a>
									</td>
									<td style="width: 20%;">
										<img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product->image}}" alt="{{$product->name}}">
									</td>
									<td style="width: 15%;">{{$product->stock}}</td>
									<td style="width: 10%;">
										<div class="custom-control custom-checkbox">
										  <input value="{{$product->id}}" name="releted_product[]" type="checkbox" class="custom-control-input" id="releted-product-{{$product->id}}">
										  <label class="custom-control-label" for="releted-product-{{$product->id}}"></label>
										</div>
									</td>
								</tr>
								@endforeach
							</table>
						</div>
					</div>

					<input type="submit" value="Add" class="form-control my-2 btn_1">

				</div>
			</div>
			<div class="col-12 col-lg-4"> 
				<div class="card p-3 rounded-0">

{{-- 					<div class="row mb-2">
						<div class="col-12 col-lg-12">
							<label for="product_colors" class="font-pt font-16"><b>Color</b></label>
							<textarea  name="product_colors" id="product_colors" cols="30" rows="2" class="form-control rounded-0 font-pt font-18 mb-2" placeholder="333, f1f1f1, d1d1d1"></textarea>
						</div>

						<div class="col-12 col-lg-12">
							<label for="product_size" class="font-pt font-16"><b>Size</b></label>
							<textarea  name="product_size" id="product_size" cols="30" rows="2" class="form-control rounded-0 font-pt font-18 mb-2" placeholder="L, Xl, XXl, M, S"></textarea>
						</div>

					</div> --}}

					<label for="unit" class="font-pt font-16"><b>Product Unit*</b></label>
					<select required name="unit" id="unit" class="form-control rounded-0 font-pt font-18 mb-2" >
						
						<option class="font-pt font-18 py-2" value="">Select Unit</option>
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


					<label for="category" class="font-pt font-16"><b>Category*</b></label>
					<select required name="category[]" id="category" class="form-control rounded-0 font-pt font-18 mb-2" multiple>
						@foreach($categories as $category)
						<?php 
							if($category->id == 1){
								continue;
							}
						?>
						<option class="font-pt font-18 py-2" value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					</select>

					<label for="offer" class="font-pt font-16"><b>Offer</b></label>
					<select required name="offer" id="offer" class="form-control rounded-0 font-pt font-18 mb-2" >
						<option class="font-pt font-18 py-2" value="0"></option>
						@foreach($offers as $offer)
						@if($offer->active == 1)
						<option class="font-pt font-18 py-2" value="{{$offer->id}}">{{$offer->name}}</option>
						@endif
						@endforeach
					</select>


				
					<label for="" class="font-pt font-16"><b>Image*(Base)</b></label>
					
					<input required class="form-control input-file " type="file" name="base_image" id="base-image">
					<p id="image-validate-base" class=" text-danger  text-center"></p>
					

					<div class="card m-2 product-image-preview-area" id="base-image-show">
						<div class="preview" id="base-image-preview"  ></div>
					</div>

					<div id="more-image-area"></div>

					<button id="add-more-image-btn" class="btn_1 my-2 font-18 font-pt">Add More Image</button>




			    	<div class="custom-control custom-checkbox mr-sm-2">
			            <input type="checkbox" name="seo" class="custom-control-input " id="seo-checkbox" value="1">
			            <label class="custom-control-label font-18 font-pt text-info" for="seo-checkbox">Show SEO Option</label>
			        </div>

				</div>
			</div>
		</div>
	</div>
	
</form>






{{-- category add modal  --}}


<!-- Modal add -->
<div class="modal fade bd-example-modal-lg" id="category-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabel">Add new category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="modal-body">
				<label for=""><b>Name*</b></label>
				<input type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name">

        <div class="row">
          <div class="col-12 col-lg-6">
            <label for="parent_cat">Parent Category</label>
            <select name="parent_cat" id="parent_cat" class="form-control">
              <option value="0">Parent</option>
              @foreach($categories as $caregoty)
                <option value="{{$caregoty->id}}">{{$caregoty->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-6">
            <label for=""><b>Image*</b></label>
            <input type="file" name="image" class="form-control rounded-0" style="height: 47px;">
          </div>
        </div>

				<label for=""><b>Description*</b></label>
				<textarea name="description" id="" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>

				<label for=""><b>Tag*</b></label>
				<textarea name="tag" id="" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn-admin btn-delete" data-dismiss="modal">Close</button>
				<input type="submit" class="btn-admin btn-edit" value="Add" name="submit">
			</div>

		</form>

    </div>
  </div>
</div>




@endsection


@section('footer-section')
		
		
		<script>
			$('#base-image-show').hide();
			var preview_id;
			$(document).ready(function(){
				$("#add-more-image-btn").click(function(e){

					var total = $(".product-new-image").length;

					var new_img = `
						<div class="product-new-image mt-2">
							<span class="delete-this-image">X</span>
							<label class="font-pt font-18"  for=""><b>Slider - `+(total+1)+`</b></label>

							<input data-total="`+total+`" class="form-control new-image input-file" type="file" name="more_image[]">
							<p id="image-validate-`+total+`" class=" text-danger  text-center"></p>
							<div class="card m-2 product-image-preview-area" >
								<div id="preview-`+total+`" class="preview"  ></div>

							</div>
						</div>
					`;
					$("#more-image-area").append(new_img);

					e.preventDefault();
					return false;
				})


				$("#base-image").change(function(){

					// image-validate-base

				    var img_size=(this.files[0].size);
		            
		            if(img_size > 2000000) {
		            	$(this).val('');
	            		$("#image-validate-base").html("Image size is too large(size > 2MB)! use < 2MB ");
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




					
				})
			})


			$(document).on('change', '.new-image', function(){  
			  
			  
			   preview_id = $(this).data('total');

			   



			    var img_size=(this.files[0].size);
	            
	            if(img_size > 2000000) {
	              
	               	
	               $(this).val('');
	               $("#image-validate-"+preview_id).html("Image size is too large(size > 2MB)! use < 2MB ");



	            }else{
	            	$("#image-validate-"+preview_id).html("");
            	   if (this.files && this.files[0]) {
            			var reader = new FileReader();
            			reader.onload = function(e,input) {
            			    $('#preview-'+preview_id).css('background-image', 'url('+e.target.result +')');
            			    $('#preview-'+preview_id).hide();
            			    $('#preview-'+preview_id).fadeIn(650);
            	
            			}
            			reader.readAsDataURL(this.files[0],this);
            	    }
	            }






			})


			$(document).on('click','.delete-this-image',function(){
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
		        
		        ['font', ['bold', 'underline', 'clear']],
		       
		        ['para', ['ul', 'ol', 'paragraph']],
		        
		        ['fontsize', ['fontsize']],
		       
		      ]
		    });

		    
		  });

		</script>


		
		<script>
			$(document).ready(function() {

				$("#category-modal-btn").click(function(){
					$("#category-add-modal").modal('show');
				});

				$("#brand-modal-btn").click(function(){
					$("#brand-add-model").modal('show');
				});

			 });
		</script>


		<script>
			$(document).ready(function() {

				$("#seo-area").hide();

				$("#seo-checkbox").click(function(){
					if($(this).prop('checked') == true){
						$("#seo-area").show();
					}else{
						$("#seo-area").hide();
					}
				});

				

			 });


		</script>





@endsection