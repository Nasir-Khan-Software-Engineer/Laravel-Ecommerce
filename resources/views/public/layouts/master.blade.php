<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        {{-- 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        --}}
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="author" content="John Doe">
        @yield('seo')
        @yield('title')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('assets/img/favicon.ico')}}">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Bootstrap Fremwork Main Css -->
        <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/bootstrap.min.css')}}">
        <!-- All Plugins css -->
        <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/plugins.css')}}">
        <!-- Theme shortcodes/elements style -->
        <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/shortcode/shortcodes.css')}}">
        <!-- Theme main style -->
        <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/style.css')}}">
        <!-- Responsive css -->
        <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/responsive.css')}}">
        <!-- User style -->
        <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/custom.css')}}">
        <!-- Modernizr JS -->
        <script src="{{URL::asset('assets/front-end/js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <style>
            footer{
            background:#e0e0e0 !important;
            }
            #notificaton-div{
            width: 300px;
            height: 40px;
            position: fixed;
            bottom: 10px;
            left: calc(50% - 150px);
            z-index: 1000;
            line-height: 40px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 0px 2px 0px #8c8c8c;
            color:#fff;
            font-size: 17px;
            display: none;
            }
            .cart-side{
            position: fixed;
            top: 50%;
            right: 0%;
            padding: 10px;
            cursor: pointer;
            font-size: 25px;
            z-index: 1000;
            background: red;
            background: white;
            box-shadow: 0px 0px 1px 1px #dadada;
            display: none;
            }
            #scroll-search #inlineFormInputGroupUsername{
            border: 2px solid #dc3545;
            border-right: 0px !important;
            }
            .input-group-prepend .input-group-text{
            border-top-right-radius: 3px !important;
            border-bottom-right-radius: 3px !important;
            background: #dc3545;
            border: 2px solid #dc3545;
            border-left: 0px !important;
            }
            #scroll-search #inlineFormInputGroupUsername:focus{
            -webkit-box-shadow: none;
            box-shadow: none;
            }
            .input-group-text button{
            font-weight: bold;
            background: #dc3545;
            color: #fff;
            padding: 0px 20px;
            }
            #my_slider .single-slide {
                border:1px solid #dc3545;
            }
        </style>
        @yield('custom-css')
    </head>
    <body id="main-body">
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->  
        <div id="notificaton-div">
            <span id="notificaton-text"></span>
        </div>
        <div id="cart-side" class="cart-side cart__menu">
            <span class="ti-shopping-cart"><span class="total_cart_products" ></span></span>
        </div>
        <!-- Body main wrapper start -->
        <div class="wrapper home-9 wrap__box__style--1">
            <!-- Start Header Style -->
            <header id="header" class="htc-header header--3 " style="background:#efefef;">
                <!-- Start Mainmenu Area -->
                <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                    <div class="container" >
                        <div class="row">
                            <div id="scroll-logo" class="col-md-2 col-lg-2 col-6">
                                <div class="logo">
                                    <a href="{{route('website.home')}}">
                                    <img src="{{URL::asset('assets/img/logo/uniqlo.png')}}" alt="logo">
                                    </a>
                                </div>
                            </div>


                            <div id="scroll-icon" class="col-md-10 col-lg-2 col-6  d-block d-lg-none ">
                                <ul class="menu-extra text-right">

                                    <li class="d-none d-md-block">
                                        <a href="{{route('website.all_categories')}}"><b>Categories</b></a>
                                    </li>
                                    <li class="d-none d-md-block">
                                        <a href="{{route('website.shop_page')}}"><b>Shop</b></a>
                                    </li>

                                    

                                    @auth
                                        <li>
                                            <a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <span class="ti-export"></span></a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{route('website.customer.login')}}"><span class="ti-user"></span></a></li>
                                    @endauth
                                    
                                    <li class="cart__menu"><span class="ti-shopping-cart"><span class="total_cart_products" ></span></span></li>
                                </ul>
                            </div>


                            <!-- Start MAinmenu Ares -->
                            <div id="scroll-search" class="col-md-12 col-lg-7 m-lg-0 mb-3">
                                <form action="{{route('website.search')}}" method="POST">
                                    @csrf
                                    <label class="sr-only" for="inlineFormInputGroupUsername">Search Here...</label>
                                    <div class="input-group">
                                        <input required name="keyword" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search Here...">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <button type="submit" class="ti-search border-0"></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                               
                            </div>
                            <!-- End MAinmenu Ares -->
                            <div class="col-md-2 col-lg-3 col-6 d-none d-lg-block ">
                                <ul class="menu-extra m-0 text-right">
                                    <li>
                                        <a href="{{route('website.all_categories')}}"><b>Categories</b></a>
                                    </li>
                                    <li>
                                        <a href="{{route('website.shop_page')}}"><b>Shop</b></a>
                                    </li>
                                    @auth
                                        <li>
                                            <a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <span class="ti-export"></span></a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{route('website.customer.login')}}"><span class="ti-user"></span></a></li>
                                    @endauth

                                    <li class="cart__menu"><span class="ti-shopping-cart"><span class="total_cart_products" ></span></span></li>
                                </ul>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <!-- End Mainmenu Area -->
            </header>
            <!-- End Header Style -->
            <div class="body__overlay"></div>

            <!-- Start Offset Wrapper -->
            <div class="offset__wrapper">

                <!-- Start Cart Panel -->
                <div class="shopping__cart">
                    <div class="shopping__cart__inner">
                        <div class="offsetmenu__close__btn">
                            <a href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                        <div class="shp__cart__wrap" id="cart_items_list">
                            {{-- show cart product --}}
                        </div>
                        <ul class="shoping__total">
                            <li class="subtotal">Subtotal:</li>
                            <li class="total__price" id="total_price_of_cart">$00.00</li>
                        </ul>
                        <ul class="shopping__btn">
                            <li><a href="{{route('website.cart.view')}}">View Cart</a></li>
                            <li class="shp__checkout"><a href="{{route('website.cart.check_out')}}">Checkout</a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Cart Panel -->
            </div>
            <!-- End Offset Wrapper -->

            <!-- main body -->
            <div class="page-content">
                <div class="bg--4 ">
                    @if(Request::is('/'))
                    <div class="container slider--four slider__new">
                        <div class="row">
                            <div id="my_left_nav" class="d-none d-xl-block" >
                                <div class="card  rounded-0 this_nav">
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
                                        
                                                if($category->left_nav == 0){
                                                    continue;
                                                }
                                        
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
                            <div id="my_slider" >
                                <div class="slider__activation__02 owl-carousel owl-theme">
                                    @foreach($sliders as $slider)
                                    @if($slider->active == 1)
                                    <div class="single-slide item">
                                       

                                        <a href="/{{$slider->link}}">
                                        <img src="{{URL::asset('assets/img/slider/')}}/{{$slider->image}}" alt="">
                                        </a>

                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="category-slider-area pt--10">
                                    <div class="owl-carousel owl-theme popular__product__wrap">
                                        @foreach($categories as $category)
                                        @if($category->id != 1)
                                        <div class="single-category item">
                                            <a href="{{route('website.single_category',['slug' => $category->slug])}}">
                                            {{-- <img src="https://via.placeholder.com/120x60" alt="{{$category->name}}"> --}}
                                            <img src="{{URL::asset('assets/img/category/')}}/{{$category->image}}" alt="{{$category->name}}">
                                            </a>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="text-right mr-5 mt-2 d-none d-lg-block">
                                        <a href="{{route('website.all_categories')}}" class="mr-4"><b>All Categories</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Slider Area -->
                    @endif
                    <!-- page content -->
                    @yield('content')
                    <!-- end page content -->
                    <!-- Start Footer Area -->
                    <footer class="htc__foooter__area bg__white footer--4">
                        <div class="container-fluid">
                            <div class="row footer__container clearfix">
                                <!-- Start Single Footer Widget -->
                                <div class="col-md-6 col-lg-3 col-sm-6">
                                    <div class="ft__widget">
                                        <div class="ft__logo">
                                            <a href="/">
                                            <img src="{{URL::asset('assets/img/logo/uniqlo.png')}}" alt="footer logo">
                                            </a>
                                        </div>
                                        <div class="footer__details">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus aliquam nihil est odio architecto perspiciatis velit modi consectetur! Voluptates, quia..</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Footer Widget -->
                                <!-- Start Single Footer Widget -->
                                <div class="col-md-6 col-lg-3 col-sm-6 smb-30 xmt-30">
                                    <div class="ft__widget">
                                        <h2 class="ft__title">Quick Menu</h2>
                                        <div class="newsletter__form">
                                            <div class="input__box">
                                                <div id="mc_embed_signup">
                                                    <ul>
                                                        <li>
                                                            <a href="{{route('website.about_page')}}">About Us</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('website.contact_page')}}">Contact Us</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('website.contact_page')}}">Feedback</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('website.faq_page')}}">FAQ</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('website.privacy_page')}}">Privacy Policy</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('website.condition_page')}}">Terms and Conditions</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Footer Widget -->
                                <!-- Start Single Footer Widget -->
                                <div class="col-md-6 col-lg-3 col-sm-6 smt-30 xmt-30">
                                    <div class="ft__widget contact__us">
                                        <h2 class="ft__title">Contact Us</h2>
                                        <div class="footer__inner">
                                            <p>Dhanmondi 15<br>Dhaka, Bangladesh</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Footer Widget -->
                                <!-- Start Single Footer Widget -->
                                <div class="col-md-6 col-lg-2 lg-offset-1 col-sm-6 smt-30 xmt-30">
                                    <div class="ft__widget follow-us">
                                        <h2 class="ft__title">Follow Us</h2>
                                        <ul class="social__icon">
                                            <li><a href="https://twitter.com/" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                                               <li><a href="https://www.instagram.com//" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
                                               <li><a href="https://www.facebook.com/" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                               <li><a href="https://plus.google.com/" target="_blank"><i class="zmdi zmdi-google-plus"></i></a></li>
                                           </ul>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Footer Widget -->
                            </div>
                            <!-- Start Copyright Area -->
                            <div class="htc__copyright__area">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                        <div class="copyright__inner">
                                            <div class="copyright">
                                                <p>© 2021 <a target="_blank" href="https://nasir-khan.com" target="_blank">Nasir Khan</a>
                                                    All Right Reserved.
                                                </p>
                                            </div>
                                            <ul class="footer__menu">
                                               
                                              
                                                <li><a target="_blank" href="https://nasir-khan.com">Developed By Nasir Khan</a></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Copyright Area -->
                        </div>
                        <audio style="position: absolute; top: -100%; opacity: 0;"  id="error_sound" src="{{URL::asset('assets/audio/error.mp3')}}" preload="auto"></audio>
                        <audio style="position: absolute; top: -100%; opacity: 0;"  id="success_sound" src="{{URL::asset('assets/audio/success.mp3')}}" preload="auto"></audio>
                    </footer>
                    <!-- End Footer Area -->
                </div>
            </div>
            <!-- end main body -->
        </div>
        <!-- Body main wrapper end -->
        <!-- Placed js at the end of the document so the pages load faster -->
        <!-- jquery latest version -->
        <script src="{{URL::asset('assets/front-end/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <!-- Bootstrap Framework js -->
        <script src="{{URL::asset('assets/front-end/js/popper.min.js')}}"></script>
        <script src="{{URL::asset('assets/front-end/js/bootstrap.min.js')}}"></script>
        <!-- All js plugins included in this file. -->
        <script src="{{URL::asset('assets/front-end/js/plugins.js')}}"></script>
        <!-- Main js file that contents all jQuery plugins activation. -->
        <script src="{{URL::asset('assets/front-end/js/main.js')}}"></script>
        <script>
            // ajax call setup header 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // end header setup 
        </script>
        {{-- add to cart --}}
        <script src="{{URL::asset('assets/front-end/js/add-to-cart.js')}}"></script>
        @yield('custom-js')
    </body>
</html>