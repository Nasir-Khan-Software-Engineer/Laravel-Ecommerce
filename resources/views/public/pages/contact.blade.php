@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="{{$settings->description}}">
@endsection

@section('title')
<title>Contact Us</title>
@endsection

@section('custom-css')
	<style>
		input,textarea{
			border-radius: 0px !important;
		}
		#contact-section{
			margin-top: -70px;
		}
		#send_btn{
			padding: 5px 50px;
			border: 0px;
			background: #dc3545;
			color: #fff;
		}
		.read-border{
			border: 1px solid red !important;
			outline: none !important;
			box-shadow: 0px 0px 0px !important;
		}
	</style>
@endsection



@section('content')
	<section id="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class=" text-justify">
						<h1 class="text-center m-0">Contact Us</h1>
						<hr class="my-2 ">

						<br>
						<br>
						<div class="row">
							<div class="col-12 col-lg-4">
								<div class="card rounded-0 p-3">
									<a target="_balnk" href="/customer/login"><b>I want to know where my order is?</b></a>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Repudiandae, dolor. Eius soluta autem quos reiciendis.</p>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="card rounded-0 p-3">
									<a target="_balnk" href="/customer/login"><b>I want to cancel an order</b></a>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Repudiandae, dolor. Eius soluta autem quos reiciendis.</p>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="card rounded-0 p-3">
									<a target="_balnk" href="/customer/login"><b>How can I paid my payment?</b></a>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Repudiandae, dolor. Eius soluta autem quos reiciendis.</p>
								</div>
							</div>
						</div>

						<div class="row my-4">
							<div class="col-12 col-lg-7">
								<h2 style="font-size: 20px;" class="text-center">Email Us</h2>
								<hr class="my-2">
								<div class="row">
									<div class="col-12">
										<label for="name"><b>Name:</b></label>
										<input maxlength="200" type="text" class="form-control mb-2 " id="name" placeholder="Your Full Name">
									</div>
								</div>

								<div class="row mb-2">
									<div class="col-12">
										<label for="subject"><b>Subject*</b></label>
										<input maxlength="150" type="text" class="form-control" id="subject" placeholder="Subject">
									</div>
								</div>

								<div class="row mb-2">
									<div class="col-12 col-lg-6">
										<label for="email"><b>Email:</b></label>
										<input maxlength="100" type="text" class="form-control" id="email" placeholder="Your Email">
									</div>
									<div class="col-12 col-lg-6">
										<label for="phone"><b>Phone:</b></label>
										<input maxlength="15" type="text" class="form-control" id="phone" placeholder="Your Phone">
									</div>
								</div>

								<div class="row mb-2">
									<div class="col-12">
										<label for="message"><b>Message*</b></label>
										<textarea  name="message" id="message" cols="30" rows="5"class="form-control" placeholder="Your Message"></textarea>
									</div>
								</div>

								<div class="text-right">
									<button id="send_btn" class="btn_1 full-width mt-3 form-control">
										Send
								    </button>
								</div>
								
							</div>

							<div class="col-12 col-lg-5">
								<h2 style="font-size: 20px;" class="text-center">Contact Information</h2>
								<hr class="my-2">
								<p>
									Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure natus saepe, aperiam, necessitatibus nulla harum ratione facilis tenetur provident. Quaerat dignissimos, modi recusandae nesciunt velit quasi fugiat. Iure, provident officia.
									<br>

									Lorem ipsum dolor sit amet, consectetur adipisicing, elit. Alias doloremque rerum esse adipisci! Eius natus modi repellendus similique quidem reiciendis deleniti at, culpa impedit, nam nihil deserunt, odit nostrum, hic.
								</p>
								<br>
								<address>
									<p class="mb-2"><b>Address: </b> 	{{$settings->address}}</p>
									<p class="mb-2"><b>Phone: </b> 		{{$settings->phone}}</p>
									<p class="mb-2"><b>Email: </b> 		{{$settings->email}}</p>
									
								</address>
								<br>
								<h2 class="ft__title">Follow Us</h2>
								<ul class="social__icon">
								    <li><a href="https://twitter.com/71solutionllc" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
								    <li><a href="https://www.instagram.com/71solution/" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
								    <li><a href="https://www.facebook.com/71solution/?ref=bookmarks" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
								    <li><a href="https://plus.google.com/" target="_blank"><i class="zmdi zmdi-google-plus"></i></a></li>
								</ul>
							</div>
						</div>



						<div>
							<iframe src="{{Session::get('location')}}" width="100%" height="550" frameborder="0" style="border:2px solid #ff4136; border-radius: 20px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection


@section('custom-js')

	
	<script>

	  
	  $(document).ready(function() {



	  	$('input').keyup(function(){
	  		$(this).removeClass('read-border');
	  	})

	  	$('textarea').keyup(function(){
	  		$(this).removeClass('read-border');
	  	})



	  	$("#send_btn").click(function(){

	  		$("#loader").show();

	  		var name = $("#name").val();
	  		var email = $("#email").val();
	  		var phone = $("#phone").val();
	  		var subject = $("#subject").val();
	  		var message = $("#message").val();

	  		if(name == ''){
	  			$("#name").focus();
	  			$("#name").addClass('read-border');
	  			return false;
	  		}
	  		const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  		if(email == '' || !re.test(String(email).toLowerCase())){
	  			$("#email").focus();
	  			$("#email").addClass('read-border');
	  			return false;
	  		}


	  
	  		if(phone == ''){
	  			$("#phone").focus();
	  			$("#phone").addClass('read-border');
	  			return false;
	  		}

	  		if(subject == ''){
	  			$("#subject").focus();
	  			$("#subject").addClass('read-border');
	  			return false;
	  		}

	  		if(message == ''){
	  			$("#message").focus();
	  			$("#message").addClass('read-border');
	  			return false;
	  		}



	  		$.ajax({
	  		   type:'POST',
	  		   url:'/contact/email/send',
	  		   data:{
	  		   	name:name,
	  		   	email:email,
	  		   	phone:phone,
	  		   	subject:subject,
	  		   	message:message
	  		   },
	  		   success:function(data){
	  		   	console.log(data);
	  		   	

	  		   	var name 		= $("#name").val("");
	  		   	var email 		= $("#email").val("");
	  		   	var phone 		= $("#phone").val("");
	  		   	var subject 	= $("#subject").val("");
	  		   	var message 	= $("#message").val("");


	  		  } // end success
	  		
	  		});



	  	})
	  });

	</script>


@endsection