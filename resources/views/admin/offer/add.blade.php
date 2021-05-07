@extends('admin.layouts.master')



@section('title')
<title>Add New Order</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right">
    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

    
  

    <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href="{{route('admin.settings.documentaion')}}#b-offer-doc"><i class="fa fa-info-circle" aria-hidden="true"></i></a>

  </div>
</div>


<div class="row">
    <div class="col-12 offset-lg-3 col-lg-6">
        <div class="card">
            <form action="{{route('admin.offer.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label for=""><b>Name*</b></label>
                    <input required type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name">

                    <label for=""><b>Title*</b></label>
                    <input required type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="title">

                    <label for=""><b>Slug*</b></label>
                    <input required type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="slug">

 

                    <div class="row">
                 

                        <div class="col-12 col-lg-6 mb-2">
                            <label for="start_time"><b>Start Time*</b></label>
                            <input required type="date" id="start_time" name="start_time" class="form-control rounded-0" style="height: 47px;">
                        </div>

                        <div class="col-12 col-lg-6 mb-2">
                            <label for="end_time"><b>End Time*</b></label>
                            <input required type="date" id="end_time" name="end_time" class="form-control rounded-0" style="height: 47px;">
                        </div>

 

                    </div>



                    <label for="details"><b>Details*</b></label>
                    <textarea name="details" id="details" cols="30" rows="4" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>  


                    <label for="description"><b>Short Description(SEO)*</b></label>
                    <textarea name="description" id="description" cols="30" rows="2" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>

                    <label for=""><b>Tag(SEO)*</b></label>
                    <textarea name="tag" id="" cols="30" rows="3" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>
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