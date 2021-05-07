@extends('public.layouts.master')

@section('seo')
<meta name="description" content="{{$settings->description}}">
<meta name="keywords" content="{{$settings->tag}}">
@endsection

@section('title')
<title>FAQ | {{$settings->title}}</title>
@endsection
@section('custom-css')
<style>
	
</style>
@endsection


@section('content')
	<section id="faq-section" class="mb-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class=" text-justify">
						<h1 class="text-center m-0">FAQ</h1>
						<br>

						<div id="accordion">


 						@foreach($faqs as $faq)

						  <div class="card mb-1">
						    <div class="card-header" id="heading-{{$faq->id}}">
						      <h5 class="mb-0">
						        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$faq->id}}" aria-expanded="true" aria-controls="collapse-{{$faq->id}}">
						          {{$faq->question}}
						        </button>
						      </h5>
						    </div>

						    <div id="collapse-{{$faq->id}}" class="collapse" aria-labelledby="heading-{{$faq->id}}" data-parent="#accordion">
						      <div class="card-body">
						        {{$faq->ans}}
						      </div>
						    </div>
						  </div>
						@endforeach

	

					</div>
				</div>
			</div>
		</div>
	</section>
@endsection


@section('custom-js')
@endsection