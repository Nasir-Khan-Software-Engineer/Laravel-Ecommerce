@extends('admin.layouts.master')



@section('title')
<title>Add new coupon</title>
@endsection


@section('content')

<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

      <button  data-placement="top" title="Add New Coupon" class="btn btn-dark" type="button" data-toggle="tooltip" id="category_add_btn">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
      </button>
  
  </div>
</div>



 <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr>
           <th scope="col">No</th>
           <th scope="col">Code</th>
           <th scope="col">Start Date</th>
           <th scope="col">End Sate</th>
           <th scope="col">Active</th>
          
           <th scope="col">Discount</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
    @php 
      $i= 0;
    @endphp
    @foreach($coupons as $coupon)
      @php 
        $i++;
      @endphp
         <tr>
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$coupon->code}}</td>
           <td class="font-pt font-18">{{$coupon->start_time}}</td>
           <td class="font-pt font-18">{{$coupon->end_time}}</td>
           
           <td class="font-pt font-18">{{$coupon->discount}} {{$coupon->discount_type}}</td>

           
           <td class="font-pt font-18">
             <div class="custom-control custom-switch">
               <input    @if($coupon->active) checked @endif     data-id="{{$coupon->id}}"  type="checkbox" class="custom-control-input active" id="show_home_{{$coupon->id}}">
               <label class="custom-control-label" for="show_home_{{$coupon->id}}">Active</label>
             </div>
           </td>
           

           <td class="font-pt font-18">


            <a data-toggle="tooltip" data-placement="top" title="Full Info." class="btn btn-info" href="{{route('admin.coupon.show', ['id' => $coupon->id])}}"><i class="fa fa-eye" aria-hidden="true"></i>
            </a>


           <button     
           data-id="{{$coupon->id}}" 
           data-code="{{$coupon->code}}" 
           data-start_time="{{$coupon->start_time}}" 
           data-end_time="{{$coupon->end_time}}" 
           data-type="{{$coupon->type}}"
           data-discount="{{$coupon->discount}}"   
           data-description="{{$coupon->description}}"   
           data-min_cost="{{$coupon->min_cost}}"   
           
           class="btn btn-primary coupon-edit-btn" type="button"  data-toggle="tooltip" data-placement="top" title="Edit">
             <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
           </button>


            <a data-toggle="tooltip" data-placement="top"  title="Delete" class="btn btn-danger delete-btn" data-id="{{$coupon->id}}" href="#"><i class="fa fa-trash" aria-hidden="true"></i>
            </a>


           </td>
         </tr>
       @endforeach
       </tbody> 

       <tr>
        
       </tr>
     </table>
     </div>
   </div>
 </div>
 <!-- website info area end -->


<!-- category add modal -->

<!-- Modal add -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabel">Add New Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form action="{{route('admin.coupon.store')}}" method="POST" >
      @csrf
      <div class="modal-body">


        <label for="code"><b>Code*</b></label>
        <input required type="text" name="code" id="code" class="form-control mb-2">

        <div class="row mb-2">
          <div class="col-12 col-lg-6">
            <label for="start_time"><b>Start Time *</b></label>
            <input required type="date" class="form-control" name="start_time" id="start_time">
          </div>
          <div class="col-12 col-lg-6">
            <label for="end_time"><b>End Time *</b></label>
            <input required type="date" class="form-control" name="end_time" id="end_time">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-12 col-lg-4">
            <label for="discount"><b>Discount*</b></label>
            <input required style="height: 40px;" type="number" step="any" class="form-control" name="discount" id="discount">
          </div>

          

          <div class="col-12 col-lg-4">
            <label for="discount_type"><b>Discount Type*</b></label>
            <select style="height: 40px;" required name="discount_type" id="discount_type" class="form-control">
              <option value=""></option>
              <option value="Tk">Tk</option>
              {{-- <option value="Percentage">Percentage</option> --}}
            </select>
          </div>

          <div class="col-12 col-lg-4">
            <label for="min_cost"><b>Minimum Cost*</b></label>
            <input required style="height: 40px;" type="number" step="any" class="form-control" name="min_cost" id="min_cost">
          </div>

        </div>
        <label for="description"><b>Description</b></label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>


      </div>

      
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
           <button  data-toggle="tooltip" data-placement="top" title="Add" type="submit" class="btn btn-success">
            <i class="fa fa-check" aria-hidden="true"></i>
          </button>
        </div>

    </form>




    </div>
  </div>
</div>





<!-- Modal  edit-->
<div class="modal fade bd-example-modal-lg" id="exampleModalForEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelForEdit" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabelForEdit">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{route('admin.coupon.update')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">

        <input type="hidden" name="id" id="edit-coupon-id">

        <label for="code"><b>Code*</b></label>
        <input required type="text" name="code" id="edit-coupon-code" class="form-control mb-2">

        <div class="row mb-2">
          <div class="col-12 col-lg-6">
            <label for="start_time"><b>Start Time *</b></label>
            <input required type="date" class="form-control" name="start_time" id="edit-coupon-start_time">
          </div>
          <div class="col-12 col-lg-6">
            <label for="end_time"><b>End Time *</b></label>
            <input required type="date" class="form-control" name="end_time" id="edit-coupon-end_time">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-12 col-lg-4">
            <label for="discount"><b>Discount*</b></label>
            <input required style="height: 40px;" type="number" step="any" class="form-control" name="discount" id="edit-coupon-discount">
          </div>

          <div class="col-12 col-lg-4">
            <label for="discount_type"><b>Discount Type*</b></label>
            <select style="height: 40px;" required name="discount_type" id="edit-coupon-type" class="form-control">
              <option value=""></option>
              <option value="Tk">Tk</option>
              {{-- <option value="Percentage">Percentage</option> --}}
            </select>
          </div>

          <div class="col-12 col-lg-4">
            <label for="min_cost"><b>Minimum Cost*</b></label>
            <input required style="height: 40px;" type="number" step="any" class="form-control" name="min_cost" id="edit_min_cost">
          </div>


        </div>
        <label for="description"><b>Description</b></label>
        <textarea class="form-control" name="description" id="edit-coupon-description" cols="30" rows="3"></textarea>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
         <button  data-toggle="tooltip" data-placement="top" title="Add" type="submit" class="btn btn-success">
          <i class="fa fa-check" aria-hidden="true"></i>
        </button>
      </div>

    </form>

    </div>
  </div>
</div>




@endsection

@section('footer-section')
  
  <script>
    




      $(".delete-btn").click(function(e){
        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/coupon/delete');

        e.preventDefault();
      })

     
      $("#category_add_btn").click(function(){
        $("#exampleModal").modal('show');
      })


      $(".coupon-edit-btn").click(function(){
        

        var id= $(this).data('id');
        var code= $(this).data('code');
        var start_time= $(this).data('start_time');
        var end_time= $(this).data('end_time');
        var type = $(this).data('type');
        var discount = $(this).data('discount');
        var description = $(this).data('description');
        var min_cost = $(this).data('min_cost');
        


        $("#edit-coupon-code").val(code);
        $("#edit-coupon-start_time").val(start_time);
        $("#edit-coupon-end_time").val(end_time);
        
        $("#edit-coupon-discount").val(discount);
        $("#edit_min_cost").val(min_cost);
        $("#edit-coupon-description").val(description);
        $("#edit-coupon-id").val(id);

        if(type == 'Percentage'){
          $("#edit-coupon-type").html(`
            
            <option value="Tk">Tk</option>
          `);
        }else{
          $("#edit-coupon-type").html(`
            
            <option selected value="Tk">Tk</option>
            `);
        }
        
        

        

        $("#exampleModalForEdit").modal('show');
        
      })



      $(".active").click(function(){
        var id = $(this).data('id');

        $.ajax({
          type:'POST',
          url:'/admin/coupon/active',
          data:{id:id},
          success:function(data){
            var message  = JSON.stringify(data.message).replace(/"/g, "");
            Toast.fire({
              icon: 'success',
              title: message
            })
          }
        });
      })



   
  </script>

@endsection