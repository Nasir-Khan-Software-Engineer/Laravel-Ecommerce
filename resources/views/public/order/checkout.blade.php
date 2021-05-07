@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="checkout,{{$settings->tag}}">
@endsection

@section('title')
<title>Checkout | {{$settings->title}}</title>


<style>
    #order_phone, #order_name, #order_email{
        background: transparent none repeat scroll 0 0;
        border: 1px solid #c1c1c1;
        border-radius: 0;
        color: #767676;
        font-size: 12px;
        height: 40px;
        line-height: 40px;
        padding-left: 20px;
       
        margin-bottom: 20px;
        float: left;
    }
    .puick-contact-area ul li{
        text-align: left;
        font-size: 16px;
        padding: 5px 0px;
    }
    .puick-contact-area ul li b{
       display: inline-block;
       width: 60%;
    }
    .puick-contact-area ul li a{
        color: #001b7f;
        font-size: 14px;
        margin-top: 0px;
    }
    .blink{
        font-size: 20px !important;
        color: #dc3545 !important;
        

    }
</style>
@endsection


@section('content')
<!-- Start Checkout Area -->
<section class="our-checkout-area  mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                <div class="ckeckout-left-sidebar">
                    <!-- Start Checkbox Area -->
                    <div class="checkout-form">
                        <h2 class="section-title-3">Your details</h2>
                        <div class="checkout-form-inner">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <label for="order_name">Your Name*</label>
                                    <input id="order_name" readonly value="{{Auth::user()->name}}" type="text" >
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="order_email">Your Email</label>
                                    <input id="order_email" readonly value="{{Auth::user()->email}}" type="email" >
                                </div>
                            </div>

                            <div class="single-checkout-box">
                                <label for="order_address">Shipping Address*</label>
                                <input style="width: 100%;" id="order_address" value="{{Auth::user()->address}}" type="text" placeholder="Address*">
                                
                            </div>

                            

                            <div class="row mb-3 mb-lg-0">
                                <div class="col-12 col-lg-6">
                                     <label for="order_phone">Phone*</label>
                                    <input id="order_phone" value="{{Auth::user()->phone}}" type="text" placeholder="phone*">
                                </div>
                                <div class="col-12 col-lg-6">
                                     <label for="order_area">Area*</label>
                                    <select id="order_area" name="order_area" class="form-control" style="">
                                        <option value="">Area</option>
                                        <option value="inside dhaka">Inside Dhaka</option>
                                        <option value="outside dhaka">Outside Dhaka</option>
                                    </select>
                                </div>
                            </div>
                                


                            <div class="single-checkout-box">
                                <label for="order_note">Note</label>
                                <textarea id="order_note" name="message" placeholder="Write Something About Your Order*"></textarea>
                            </div>


                            
                        </div>
                    </div>
                    <!-- End Checkbox Area -->
                    <!-- Start Payment Box -->
{{--                     <div class="payment-form">
                        <h2 class="section-title-3">payment details</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur kgjhyt</p>
                        <div class="payment-form-inner">
                            <div class="single-checkout-box">
                                <input type="text" placeholder="Name on Card*">
                                <input type="text" placeholder="Card Number*">
                            </div>
                            <div class="single-checkout-box select-option">
                                <select>
                                    <option>Date*</option>
                                    <option>Date</option>
                                    <option>Date</option>
                                    <option>Date</option>
                                    <option>Date</option>
                                </select>
                                <input type="text" placeholder="Security Code*">
                            </div>
                        </div>
                    </div> --}}
                    <!-- End Payment Box -->

                    <!-- Start Payment Way -->
                    <div class="our-payment-sestem">
                        <div class="buttons-cart" style="float: right !important;">
                        	
                        	<a id="submit_order"  href="#">Proceed to Payment</a>
                        </div>
                          
                    </div>
                    <!-- End Payment Way -->


                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="checkout-right-sidebar">
                    
                    @php
                    $total      = 0;
                    $total_qty  = 0;
                    $total_item = 0;
                    @endphp
                    @foreach(Session('cart-products') as $product)
                    @php
                    $total_item++;
                    $sub_total      = $product['quantity'] * $product['price'];
                    $total          += $sub_total;
                    $total_qty      += $product['quantity'];
                    @endphp


                    @endforeach
                    

                    @php
                    $discount = 0;


                    $SHIPPING_COST_IN_DHAKA     =   $ecommerce->shipping_cost_in_dhaka;
                    $SHIPPING_COST_OUT_DHAKA    =   $ecommerce->shipping_cost_out_dhaka;


                    $shipping_cost  = $SHIPPING_COST_IN_DHAKA;
                    $sub_total      = $shipping_cost + $total;
                    $grand_total    = $sub_total ;
                    @endphp

                    @if(Session::has("order-coupon"))
                    <?php 

                    $coupon      = Session::get("order-coupon");
                    $discount    = $coupon->discount;
                    $grand_total = $sub_total - $discount;
                    ?>
                    @endif
                    
                    
                        

                    <div class="puick-contact-area mt-3 p-3">
                        <h2 class="section-title-3">Order Info</h2>
                        <br>
                        <ul>
                            <li id="order_total_item" ><small><b>Total Product:</b>{{$total_item}}</small></li>
                            <li id="order_total_qty" ><small><b>Total Quantity:</b>{{$total_qty}}</small></li>
                            <li id="order_total_cost" ><small><b>Total Cost:</b>৳ {{bcdiv($total, 1, 2)}}</small></li>
                            <li id="order_shipping_cost" ><small><b>Delivery Cost:</b>৳ {{bcdiv($shipping_cost, 1, 2)}}</small></li>
                            <li id="order_sub_total" ><small><b>Sub-total Cost:</b>৳ {{bcdiv($sub_total, 1, 2)}}</small></li>
                            <li id="order_coupon_discount" ><small><b>Coupon Discount:</b>৳ {{ bcdiv($discount, 1, 2) }}</small></li>
                            <li id="order_grand_total" ><small><b>Grand Total:</b>৳ {{ bcdiv($grand_total, 1, 2)}} </small></li> 
                        </ul>
                    </div>

                    <input type="hidden" id="hidden_total_item"        value="{{$total_item}}">
                    <input type="hidden" id="hidden_total_qty"         value="{{$total_qty}}">
                    <input type="hidden" id="hidden_total_cost"        value="{{$total}}">
                    <input type="hidden" id="hidden_shipping_cost"     value="{{$shipping_cost}}">
                    <input type="hidden" id="hidden_sub_total_cost"    value="{{$sub_total}}">
                    <input type="hidden" id="hidden_coupon_discount"   value="{{$discount}}">
                    <input type="hidden" id="hidden_grand_total"       value="{{$grand_total}}">

                    <input type="hidden" id="hidden_shipping_in_dhaka"       value="{{$SHIPPING_COST_IN_DHAKA}}">
                    <input type="hidden" id="hidden_shipping_out_dhaka"      value="{{$SHIPPING_COST_OUT_DHAKA}}">




                    <div class="puick-contact-area mt--20">
                        <h2 class="section-title-3">Quick Contact</h2>
                        <a href="tel:+8801722889963">+88 01900 XXXXXXX</a>
                    </div>

                    <div class="puick-contact-area mt-3 p-3">
                        <h2 class="section-title-3">Quick Link</h2>
                        <br>
                        <ul>
                            <li><a href="">How to payment?</a></li>
                            <li><a href="">Delivery Cost Details</a></li>
                            <li><a href="">Delivery Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Checkout Area -->
@endsection


	@section('custom-js')




    <script>

		
		$(document).ready(function(){
			

			$("#submit_order").click(function(e){


                // customer info
				var name 		= $("#order_name").val();
				var email 		= $("#order_email").val();
				var phone 		= $("#order_phone").val();
				var address 	= $("#order_address").val();
				var note 		= $("#order_note").val();
				var area 		= $("#order_area").val();

                // validation
				if(address == ""){
					$("#order_address").addClass('requerd-input');
					$("#order_address").focus();
					return false;
				}
				if(area == ""){
					$("#order_area").addClass('requerd-input');
					$("#order_area").focus();
					return false;
				}
				if(phone == "" || phone.length < 11){
					$("#order_phone").addClass('requerd-input');
					$("#order_phone").focus();
					return false;
				}

                // order info

                var hidden_total_item       = Number($("#hidden_total_item").val());
                var hidden_total_qty        = Number($("#hidden_total_qty").val());


                var hidden_total_cost       = Number($("#hidden_total_cost").val());

                var hidden_shipping_cost    = Number($("#hidden_shipping_cost").val());

                var hidden_sub_total_cost   = Number($("#hidden_sub_total_cost").val());

                var hidden_coupon_discount  = Number($("#hidden_coupon_discount").val());

                var hidden_grand_total      = Number($("#hidden_grand_total").val());







				var order_data = {
					name:name,
					email:email,
					phone:phone,
					area:area,
					address:address,
					note:note,

                    // order info

                    total_cost:hidden_total_cost,
                    total_product:hidden_total_item,
                    total_quantity:hidden_total_qty
				};



				$.ajax({

					type:'POST',
					url:'/order-submit',
					data:order_data,
					success:function(data){

				   	var order = data.order;
                    var order_id = order.id;
                    
				   	window.location.href = "/customer/order/"+order_id;

				  } //end success

				}); // end ajax request

				e.preventDefault();
				
			})




			$('textArea').keyup(function(){
				$(this).removeClass('requerd-input');
			});
			$('input').keyup(function(){
				$(this).removeClass('requerd-input');
			});


            $("#order_area").change(function(){
                var hidden_total_item       = Number($("#hidden_total_item").val());
                var hidden_total_qty        = Number($("#hidden_total_qty").val());
                var hidden_total_cost       = Number($("#hidden_total_cost").val());
                var hidden_shipping_cost    = Number($("#hidden_shipping_cost").val());
                var hidden_sub_total_cost   = Number($("#hidden_sub_total_cost").val());
                var hidden_coupon_discount  = Number($("#hidden_coupon_discount").val());
                var hidden_grand_total      = Number($("#hidden_grand_total").val());

                var hidden_shipping_in_dhaka      = Number($("#hidden_shipping_in_dhaka").val());
                var hidden_shipping_out_dhaka     = Number($("#hidden_shipping_out_dhaka").val());



                if($(this).val() == "inside dhaka"){
                    hidden_shipping_cost = hidden_shipping_in_dhaka;
                }else{
                    hidden_shipping_cost = hidden_shipping_out_dhaka;
                }

                hidden_sub_total_cost = Number(hidden_total_cost + hidden_shipping_cost);

                hidden_grand_total = Number(hidden_sub_total_cost - hidden_coupon_discount);


                $("#order_shipping_cost").html(`
                    <small><b>Delivery Cost:</b>৳ `+hidden_shipping_cost.toFixed(2)+` </small>
                `);

                $("#order_sub_total").html(`
                    <small><b>Sub-total Cost:</b>৳ `+hidden_sub_total_cost.toFixed(2)+`</small>
                `);

                $("#order_grand_total").html(`
                   <small><b>Grand Total:</b>৳ `+hidden_grand_total.toFixed(2)+` </small>
                `);

                $("#order_shipping_cost").addClass("blink");
                $("#order_sub_total").addClass("blink");
                $("#order_grand_total").addClass("blink");

                setTimeout(function(){

                    $("#order_shipping_cost").removeClass("blink");
                    $("#order_sub_total").removeClass("blink");
                    $("#order_grand_total").removeClass("blink");

                }, 2000);
            })
		})
	</script>

	@endsection


