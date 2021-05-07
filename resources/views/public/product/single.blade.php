@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$product->description}}">
<meta name="keywords" content="{{$product->tag}}">
@endsection

@section('title')
<title>{{$product->name}}</title>
@endsection



@section('custom-css')

<link href="{{URL::asset('assets/front-end/js/image-zoom/jquery.exzoom.css')}}" rel="stylesheet">

<style>
    #large-image:hover,.single-image:hover{
        transform: scale(1.4);
        cursor: pointer;
    }

    #product-image-area div{
        overflow: hidden;
    }
    
    .active-color{
        position: relative;
    }

    .active-color::after{
     position: absolute;
     content: "";
     top: 8px;
     left: 2px;
     width: 8px;
     height: 2px;
     background: #fff;
     transform: rotate(20deg);
 }

 .active-color::before{
    position: absolute;
    content: "";
    top: 5px;
    left: 7px;
    width: 10px;
    height: 2px;
    background: #fff;
    transform: rotate(119deg);
}



</style>


@endsection


@section('content')





<!-- Start Product Details -->
<section class="htc__product__details  pb--100 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-sm-12">
                <div class="product__details__container">

                    <div class="exzoom" id="exzoom">
                        <!-- Images -->
                        <div class="exzoom_img_box">
                            <ul class='exzoom_img_ul'>
                                
                                @foreach($sliders as $slider)
                                    <li><img src="{{URL::asset('assets/img/products/')}}/{{$slider->image}}"/></li>
                                @endforeach
                               
                            </ul>
                            <span class="d-none" id="hidden_total_sliders">{{$sliders->count()}}</span>
                        </div>
                        <div class="exzoom_nav"></div>
                        <!-- Nav Buttons -->
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                        </p>
                    </div>





                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-sm-12 smt-30 xmt-30">
                <div class="htc__product__details__inner">
                    <div class="pro__detl__title">
                        <h2>{{$product->name}}</h2>
                    </div>
                    <div class="pro__dtl__rating">
                        <ul class="pro__rating">
                            @for($i=1;$i<=$product->rating;$i++)
                            <li><span class="ti-star"></span></li>
                            @endfor
                            

                        </ul>
                        <span class="rat__qun">(Based on {{$product->reviews()->where('active','=',1)->count()}} Reviews)</span>
                    </div>
                    <div class="pro__details">
                        {{$product->description}}
                        
                    </div>
                    <ul class="pro__dtl__prize">




                            <li class="old__prize">৳ {{$product->old_price}}  </li>
                            <li>৳ {{$product->price}}  <sub><small>{{$product->unit}}</small></sub></li>

                        </ul>
           




                    <div class="product-action-wrap">
                        <div class="prodict-statas"><span>Quantity :</span></div>
                        <div class="product-quantity">
                            <form id='myform' method='POST' action='#'>
                                <div class="product-quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" id="quantity_1" name="qtybutton" value="1">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul class="pro__dtl__btn">
                        <li class="buy__now__btn"><a href="#" class="add-to-cart-single-btn"

                            data-id="{{$product->id}}" 
                            data-price="{{$product->price}}"
                            data-unit="{{$product->unit}}"
                            data-name="{{$product->name}}"
                            data-image="{{$product->image}}"
                            data-code="{{$product->code}}"
                            data-slug="{{$product->slug}}"

                            >Add to Cart</a></li>

                        </ul>
                        <div class="pro__social__share">
                            <h2>Share :</h2>
                            <ul class="pro__soaial__link">
                                <li><a href="https://twitter.com/71solutionllc" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/71solution/" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="https://www.facebook.com/71solution/?ref=bookmarks" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/" target="_blank"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details -->


    <!-- Start Product tab -->
    <section class="htc__product__details__tab  ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 py-3">
                    <ul class="nav product__deatils__tab mb--60" role="tablist">
                        <li role="presentation" class="active">
                            <a class="active" href="#description" role="tab" data-toggle="tab">Description</a>
                        </li>
                        <li role="presentation">
                            <a href="#sheet" role="tab" data-toggle="tab">Data sheet</a>
                        </li>
                        <li role="presentation">
                            <a href="#reviews" role="tab" data-toggle="tab">Reviews ({{$product->reviews()->where('active','=',1)->count()}})</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product__details__tab__content">
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="description" class="product__tab__content active">
                            <div class="product__description__wrap">
                                <div class="product__desc">
                                    <h2 class="title__6">Details</h2>
                                    <p>{{$product->description}}</p>
                                </div>

                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="sheet" class="product__tab__content">
                            <div class="pro__feature">
                                <h2 class="title__6">Data sheet</h2>
                                {!!$product->attributes!!}
                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="reviews" class="product__tab__content">
                            <div class="review__address__inner">

                                @foreach($product->reviews as $review)
                                @if($review->active == 1)
                                <!-- Start Single Review -->
                                <div class="pro__review mb-5">

                                    <div class="review__details">
                                        <div class="review__info">
                                            <h4>{{$review->name}}</h4>
                                            <ul class="rating">

                                                @for($i=1;$i<=$review->star;$i++)
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                @endfor



                                            </ul>

                                        </div>
                                        <div class="review__date">
                                            <span>{{$review->created_at}}</span>
                                        </div>
                                        <p><b>{{$review->comment}}</b></p>
                                        <p>{{$review->details}}</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                                @endif
                                @endforeach




                            </div>
                            <!-- Start RAting Area -->
                            <div class="rating__wrap">
                                <h2 class="rating-title">Write  A review</h2>

                            </div>
                            <!-- End RAting Area -->
                            <div class="review__box mb-5">
                                <form id="review-form">
                                    <div class="single-review-form">
                                        <div class="review-box name">
                                            @auth
                                            <input type="text" value="{{Auth::user()->name}}" readonly>
                                            @else
                                            <input type="text" value="" placeholder="Your Name">
                                            @endauth
                                            <select style=""  name="" id="comment">
                                                <option value=""></option>
                                                <option value="Commpletely satisfied">Commpletely satisfied</option>
                                                <option value="Outstanding">Outstanding</option>
                                                <option value="Excellent">Excellent</option>
                                                <option value="Always the best">Always the best</option>
                                                <option value="Average">Average</option>
                                            </select>
                                            <input type="text" placeholder="your order ID" id="order_id">
                                            <select style="margin-right: 20px;"  name="" id="rating">
                                                <option value=""></option>
                                                <option value="5">5 Stars</option>
                                                <option value="4">4 Stars</option>
                                                <option value="3">3 Stars</option>
                                                <option value="2">2 Stars</option>
                                                <option value="1">1 Star</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="single-review-form">
                                        <div class="review-box message">
                                            <textarea id="details" placeholder="Write your review"></textarea>
                                        </div>
                                        <div id="review-message" class="my-2"><b>Note: </b> Only valid customer & register user is allowed to review this product.</div>
                                    </div>
                                    <div class="review-btn">
                                        <a class="fv-btn" data-id="{{$product->id}}" href="#" id="review-submit">submit review</a>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product tab -->



    <section class="pb--120">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2>Releted Products</h2>
                </div>
            </div>

            <div class="row">
                @php
                $i = 0;

                @endphp
                @foreach($releted_products as $this_product)
                @php
                $i++;
                if($this_product->id == $product->id){
                    continue;
                }
                @endphp

                <div class="col-6 col-xl-2 col-lg-3 col-md-4 mb-4 single__pro ">
                    <div class="card p-2 rounded-0">

                        <a href="{{route('website.single_product',['slug' => $this_product->slug])}}">
                            <div class="product-img">
                                <img width="100%;"  src="{{URL::asset('assets/img/products/')}}/{{$this_product->image}}" alt="product images">
                            </div>

                            <div class="product__details">
                                <h3>{{$this_product->name}}</h3>
                                @if($this_product->price != $this_product->old_price)
                                <p class="old__prize text-secondary d-block mt-2"><del>৳ {{$this_product->old_price}}</del></p>
                                <span class="popular__pro__prize text-dark mt-0">৳ {{$this_product->price}}</span>
                                @else
                                <span class="popular__pro__prize text-dark mt-2">৳ {{$this_product->price}}</span>
                                @endif
                            </div>
                        </a>

                    </div>
                </div>


                @endforeach
            </div>
        </div>
    </section>



    @endsection



    @section('custom-js')
    

   </script>

   <script>
    $(document).ready(function(){
       $("#review-submit").click(function(e){



        var product_id  = $(this).data('id');

        var order_id    = $("#order_id").val();
        var comment     = $("#comment").val();
        var rating      = $("#rating").val();
        var details     = $("#details").val();


        if(comment == ''){
            $("#comment").focus();
            return false;
        }else if(order_id == ''){
            $("#order_id").focus();
            return false;
        }else if(rating == ''){
            $("#rating").focus();
            return false;
        }else if(details == ''){
            $("#details").focus();
            return false;
        }


        var review = {
            product_id:product_id,
            order_id:order_id,

            comment:comment,
            rating:rating,
            details:details
        };

        console.log(review);


        $.ajax({

            type:'POST',
            url:'/review-submit',
            data:review,
            success:function(data){

                if(data.valid_order_customer == '1' && data.review_store == '1'){
                    $("#review-message").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Your review will show after admin approval.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        `);

                    $("#order_id").val("");
                    $("#name").val("");
                    $("#comment").val("");
                    $("#rating").val("");
                    $("#details").val("");


                }else{
                    $("#review-message").html(`
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Only valid customers can review.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        `);
                }

              }, // end success

              statusCode:{
                401: function() {
                    window.location.href = "/customer/login";
                },

            }
        }); // end ajax
        e.preventDefault();
        }) // end click
    }) // end jquery
</script>

<script src="{{URL::asset('assets/front-end/js/image-zoom/jquery.exzoom.js')}}"></script>

<script>
    $(document).ready(function(){




 



        var checkDiv = setInterval(function(){
           
            var exzoom_img_box_width = $(".exzoom_img_box").width();

            if( exzoom_img_box_width > 0) {   
                clearInterval(checkDiv);
               

                 $("#exzoom").exzoom({
                    "autoPlay":true,
                    "autoPlayTimeout": 4000
                });

            }

        }, 10); // check after 100ms every time






    })
</script>



@endsection



