@extends('admin.layouts.master')

@section('title')
<title>All Emails</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right py-3">
    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

    <form class="d-inline" action="{{route('admin.email.download')}}" method="POST">
     @csrf
     <button data-toggle="tooltip" data-placement="top" title="Donwload Email Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
   </form>

   <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
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
           <th scope="col">Email</th>
           
           <th scope="col">Date</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
        @php 
        $i= 0;
        @endphp
        @foreach($emails as $e)
        @php 
        $i++;
        @endphp
        <tr align="center">
         <th class="font-pt font-18" >{{$i}}</th>
         <td class="font-pt font-18">{{$e->name}}</td>
         <td class="font-pt font-18">{{$e->email}}</td>
         
         
         <td class="font-pt font-18">{{$e->created_at->format('d-m-Y')}}</td>
         

         
         <td class="font-pt font-18">

           

          <a data-toggle="tooltip" data-placement="top" title="Full Info." class="btn btn-info" href="{{route('admin.email.show', ['id' => $e->id])}}"><i class="fa fa-eye" aria-hidden="true"></i>
          </a>

          <button data-toggle="tooltip" data-placement="top" title="Delete" data-id="{{$e->id}}" class="btn btn-danger delete-email" ><i class="fa fa-trash" aria-hidden="true"></i>
          </button>

          

        </td>
      </tr>
      @endforeach
    </tbody> 

  
  </table>
</div>
</div>
</div>
<!-- website info area end -->






@endsection

@section('footer-section')
<script>
  
  
 $(".delete-email").click(function(){
    var id = $(this).data('id');
    var is_delete = delete_data(this,id,'/admin/email/delete');
  }) // edn delete


 
</script>
@endsection