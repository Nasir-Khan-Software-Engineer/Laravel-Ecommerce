@extends('admin.layouts.master')



@section('title')
<title>Offers</title>
@endsection


@section('content')


<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right">
    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

    
    <a class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="About This Option" href="{{route('admin.offer.add')}}">

      <i class="fa fa-plus-circle" aria-hidden="true"></i>      

    </a>

    <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href="{{route('admin.settings.documentaion')}}#b-offer-doc"><i class="fa fa-info-circle" aria-hidden="true"></i></a>

  </div>
</div>




<div class="row mt-2">
 <div class="col-12">
   <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr align="center">
           <th scope="col">No</th>
           <th scope="col">Name</th>
           <th scope="col">Total Products</th>
           <th scope="col">Date</th>
           <th scope="col">Active</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
        @php 
        $i= 0;
        @endphp
        @foreach($offers as $offer)
        @php 
        $i++;
        @endphp
        <tr align="center">
         <th class="font-pt font-18" >{{$i}}</th>
         <td class="font-pt font-18">{{$offer->name}}</td>
         
         <td>{{$offer->products->count()}}</td>
         <td class="font-pt font-18">{{$offer->created_at->format('Y-m-d')}}</td>

         <td class="font-pt font-18">
           <div class="custom-control custom-switch">
             <input    @if($offer->active) checked @endif     data-id="{{$offer->id}}"  type="checkbox" class="custom-control-input active_btn" id="show_home_{{$offer->id}}">
             <label class="custom-control-label" for="show_home_{{$offer->id}}">Active</label>
           </div>
         </td>


         <td class="font-pt font-18">
           <a data-toggle="tooltip" data-placement="top" title="Details" href="{{route('admin.offer.show', ['slug' => $offer->slug])}}" class="btn btn-info">
             <i class="fa fa-eye" aria-hidden="true"></i> 
           </a>

           <a data-toggle="tooltip" data-placement="top" title="Details" href="{{route('admin.offer.edit', ['slug' => $offer->slug])}}" class="btn btn-primary">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </a>



          <a data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger delete-offer" data-id="{{$offer->id}}" href="#"><i class="fa fa-trash" aria-hidden="true"></i>
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


@endsection

@section('footer-section')

<script>

  $(".delete-offer").click(function(){
    var id = $(this).data('id');
    var is_delete = delete_data(this,id,'/admin/offer/delete');
  })



  $(".active_btn").click(function(){
    var id = $(this).data('id');

    $.ajax({
      type:'POST',
      url:'/admin/offer/active',
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