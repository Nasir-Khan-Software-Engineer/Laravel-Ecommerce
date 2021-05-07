@extends('admin.layouts.master')



@section('title')
<title>Categories</title>
@endsection



@section("custom-css")

<style>

  .this_nav ul{
    margin: 0px;
    padding: 0px;
    list-style: none;
    width: 100%;
  }
  .this_nav{
    width: 200px;
    margin: 0px auto;
  }

  .this_nav  li {
    font-size: 18px;
    cursor: pointer;
    display: block;
    padding: 4px 10px;
    /*background: #dad9d9;*/
    position: relative;
    border-bottom: 1px solid #fff;
    text-transform: capitalize;
  }
  .this_nav  li:last-child{
    border:0px;
  }

  .this_nav  li span{
    float: right;
    transition: 0.4s;
  }
  .this_nav  li:hover >span{
    transform: rotate(90deg);
  }


  .this_nav ul li ul{
    margin-left: 20px;
    display: none;
  }
  
  .this_nav ul li:hover >ul{
    display: block;
  }

  .this_nav > ul > li{
    background: #dad9d9;
  }

  .this_nav > ul > li > ul > li{
    background: #b7b7b7;
  }

  .this_nav > ul > li > ul > li > ul > li{
    background: #dad9d9;
  }
  .this_nav > ul > li > ul > li > ul > li > ul > li{
    background: #b7b7b7;
  }
  .this_nav > ul > li > ul > li > ul > li > ul > li > ul > li{
    background: #dad9d9;
  }



</style>

@endsection


@section('content')


<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right">
    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

    <button  data-placement="top" title="Add New Category" class="btn btn-dark" type="button" data-toggle="tooltip" id="category_add_btn">
      <i class="fa fa-plus-circle" aria-hidden="true"></i>
    </button>

    <button  data-placement="top" title="View Categories" class="btn btn-dark" type="button" data-toggle="tooltip" id="category_show_all">
      <i class="fa fa-eye" aria-hidden="true"></i> 
    </button>


    <form class="d-inline" action="{{route('admin.category.download')}}" method="POST">
      @csrf
      <button data-toggle="tooltip" data-placement="top" title="Donwload Category Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
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
             <th scope="col">Relation</th>
             <th scope="col">Total Products</th>
             <th scope="col">Date</th>
             <th scope="col">Show Home</th>
             <th scope="col">Action</th>
           </tr>
         </thead>
         <tbody>
          @php 
          $i= 0;
          @endphp
          @foreach($categories as $category)
          @php 
          $i++;
        // if($category->id == 1){

        // }
          @endphp
          <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$category->name}}</td>
           <td class="font-pt font-18">
             @if($category->parent_id == 0)
             Parent
             @else
             Child
             @endif
           </td>
           <td>{{$category->products->count()}}</td>
           <td class="font-pt font-18">{{$category->created_at->format('Y-m-d')}}</td>

           <td class="font-pt font-18" >

            @if($category->id == 1)
            Defalult Category
            @else

             <div class="custom-control custom-switch">
              <input    @if($category->left_nav) checked @endif     data-id="{{$category->id}}"  type="checkbox" class="custom-control-input left_nav" id="left_nav_{{$category->id}}">
              <label class="custom-control-label" for="left_nav_{{$category->id}}">Left Nav</label>
            </div>

            <div class="custom-control custom-switch">
             <input    @if($category->show_home) checked @endif     data-id="{{$category->id}}"  type="checkbox" class="custom-control-input show_home" id="show_home_{{$category->id}}">
             <label class="custom-control-label" for="show_home_{{$category->id}}">Home Page</label>
           </div>


           @endif
         </td>


         <td class="font-pt font-18">
           <a data-toggle="tooltip" data-placement="top" title="Details" href="{{route('admin.category.show', ['slug' => $category->slug])}}" class="btn btn-info">
             <i class="fa fa-eye" aria-hidden="true"></i> 
           </a>

           @if($category->id != 1)


           <button  
           data-catid="{{$category->id}}" 
           data-catname="{{$category->name}}" 
           data-catdes="{{$category->description}}" 
           data-cattag="{{$category->tag}}"  
           data-relation="{{$category->parent_id}}"  


           class="btn btn-primary cat-edit-btn" type="button"  data-toggle="tooltip" data-placement="top" title="Edit">
           <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
         </button>

         <a data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger delete-category" data-id="{{$category->id}}" href="#"><i class="fa fa-trash" aria-hidden="true"></i>
         </a>
         @endif

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










        <!-- category add modal -->

      <!-- Modal add -->
      <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                <label for=""><b>Image*</b></label>
                <input style="height: 50px;" required type="file" class="form-control rounded-0 mb-2 font-pt font-18" name="image">

                <label for=""><b>Name*</b></label>
                <input required type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name">

                <div class="row">
                  <div class="col-12  mb-2">
                    <label for="relation"><b>Relation*</b></label>
                    <select required name="relation" id="relation" class="form-control">
                      <option value=""></option>
                      <option value="parent">Parent</option>
                      <option value="child">Child</option>
                    </select>
                  </div>
                </div>

                <div id="parent_select_area">
                  <label for="relation"><b>Parent*</b></label>
                  <select name="parent" id="parent_select" class="form-control">
                    <option value=""></option>
                    @foreach($categories as $category)
                    @if( $category->id > 1)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>

                <label for="description"><b>Description*</b></label>
                <textarea name="description" id="description" cols="30" rows="3" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>

                <label for=""><b>Tag*</b></label>
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





      <!-- Modal  edit-->
      <div class="modal fade bd-example-modal-lg" id="exampleModalFodad9d9it" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelFo#dad9d9it" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-20 font-pt" id="exampleModalLabelFo#dad9d9it">Edit Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('admin.category.update')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">

                <input type="hidden" name="id" value="" id="edit-cat-id">


                <label for=""><b>Image*</b></label>
                <input style="height: 50px;"  type="file" class="form-control rounded-0 mb-2 font-pt font-18" name="image">

                <label for=""><b>Name*</b></label>
                <input type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name" id="edit-cat-name">

                <div class="row">  
                  <div class="col-12  mb-2">
                    <label for="relation_edit"><b>Relation*</b></label>
                    <select required name="relation" id="relation_edit" class="form-control">
                      <option id="relation_edit_parent" value="parent">Parent</option>
                      <option id="relation_edit_child" value="child">Child</option>
                    </select>
                  </div>
                </div>
                <div id="parent_select_area_edit">
                  <label for="relation"><b>Parent*</b></label>
                  <select name="parent" id="parent_select_edit" class="form-control">
                    <option value=""></option>
                    @foreach($categories as $category)
                    @if($category->id > 1)
                    <option id="edit_parent_option_{{$category->id}}" value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>

                <label for=""><b>Description*</b></label>
                <textarea name="description" id="edit-cat-des" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18" ></textarea>

                <label for=""><b>Tag*</b></label>
                <textarea name="tag" id="edit-cat-tag" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>
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

      <!-- Modal -->
      <div class="modal fade" id="category_show_all_modal" tabindex="-1" role="dialog" aria-labelledby="category_show_allLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="category_show_allLabel">All Categories</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                <div class="this_nav">

                 <?php 

                 GLOBAL $nav;
                 GLOBAL $allready_print;
                 GLOBAL $total_prints;
                 GLOBAL $total_category;


                 $nav = "<ul>";
                 $allready_print = array(1);
                 $total_prints = 1;
                 $total_category = $categories->count();

                 function parent_child($categories){

                   GLOBAL $nav;
                   GLOBAL $allready_print;
                   GLOBAL $total_prints;
                   GLOBAL $total_category;
                   foreach ($categories as  $category) {
                       if(!in_array($category->id,$allready_print)){ // not print yeat
                          if($category->childs->count() > 0){ // yes parent
                            $nav .= '<li>'.$category->name.'<span>></span><ul>';
                            parent_child($category->childs);
                            $nav .='</ul></li>';
                          }else{
                            $nav .= '<li><a href="/category/'.$category->slug.'">'.$category->name.'</a></li>';
                            
                          }
                          $total_prints++;
                          array_push($allready_print,$category->id);
                        }
                      }

                      if($total_prints == $total_category){
                        return $nav;
                      }
                    }
                    parent_child($categories);
                    $nav .= '</ul>';
                    echo $nav;
                    ?>
                  </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>





      @endsection

      @section('footer-section')

      <script>
        $("#parent_select_area").hide();
        $("#parent_select_area_edit").hide();




        $(".cat-edit-btn").click(function(){


          var cat_id= $(this).data('catid');
          var cat_name= $(this).data('catname');
          var cat_des= $(this).data('catdes');
          var cat_tag= $(this).data('cattag');
          var cat_relation = $(this).data('relation');



          if(cat_relation == 0){
            $("#relation_edit_parent").attr('selected',true);

          }else{
            $("#relation_edit_child").attr('selected',true);
            $("#parent_select_area_edit").show();
            $("#edit_parent_option_"+cat_relation).attr('selected',true);
          }




          $("#edit-cat-name").val(cat_name);
          $("#edit-cat-des").val(cat_des);
          $("#edit-cat-tag").val(cat_tag);
          $("#edit-cat-id").val(cat_id);




          $("#exampleModalFodad9d9it").modal('show');

        })


        $(".delete-category").click(function(){
          var id = $(this).data('id');
          var is_delete = delete_data(this,id,'/admin/category/delete');
        })


        $("#category_add_btn").click(function(){
          $("#exampleModal").modal('show');
        })

        $("#category_show_all").click(function(){
          $("#category_show_all_modal").modal('show');
        })



      // category parent child 

      $("#relation").change(function(){
        var val = $(this).val();

        if(val == "child"){
          $("#parent_select_area").show();
          $("#parent_select").attr('required',true);
        }else{
          $("#parent_select_area").hide();
          $("#parent_select").removeAttr('required');
        }
      })



      $("#relation_edit").change(function(){
        var val = $(this).val();

        if(val == "child"){
          $("#parent_select_area_edit").show();
          $("#parent_select_edit").attr('required',true);
        }else{
          $("#parent_select_area_edit").hide();
          $("#parent_select_edit").removeAttr('required');
        }
      })


      $(".show_home").click(function(){
        var id = $(this).data('id');

        $.ajax({
          type:'POST',
          url:'/admin/category/show_home',
          data:{id:id},
          success:function(data){
            var message  = JSON.stringify(data.message).replace(/"/g, "");
            Toast.fire({
              icon: 'success',
              title: message
            })

            $("#success_sound").trigger('play');
          }
        });
      })


      $(".left_nav").click(function(){
        var id = $(this).data('id');

        $.ajax({
          type:'POST',
          url:'/admin/category/left-nav',
          data:{id:id},
          success:function(data){
            var message  = JSON.stringify(data.message).replace(/"/g, "");
            Toast.fire({
              icon: 'success',
              title: message
            })

            $("#success_sound").trigger('play');
          }
        });
      })




    </script>

    @endsection