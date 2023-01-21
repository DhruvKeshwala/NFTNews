@extends('layouts.user.header')

@if(@$page->metaTitle != null)
  @section('title', @$page->metaTitle)
@else
  @section('title', 'NFT Markets | Partners')
@endif

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Partners</span></p>
          </div>
        </div>
      </div>
    </section>
    <div class="container news-banner mb-3">
      @if(@$partnerTopBanner->location != null)
          <a href="{{@$partnerTopBanner->url}}" class="text-dark" target="_blank"><img
          src="{{ URL::asset('uploads/banner/' . @$partnerTopBanner->image) }}" width="100%"
          height="auto"  alt="{{@$partnerTopBanner->banner_image_alt}}"></a>
      @endif
    </div>
 @if(@$page->selectTemplate == 'education')   
    <section class="ftco-section py-5 bg-info-gradient-3">
    	<div class="container">
    		<div class="row">
         	<div class="col-md-5"><img src="{{ URL::asset('uploads/' . @$page->image1)}}" width="100%" height="auto" alt="{{@$page->title}}"></div>
            <div class="col-md-7">
            	<h5 class="modal-title">{{@$page->title}}</h5>
		        <h3 class="modal-title mb-3">{{@$page->metaTitle}}</h3>
                
                {!! @$page->contents !!}
                
                <!-- SUBSCRIBE FORM -->

                <a href="{{route('user.contact')}}" target="_blank" class="btn btn-primary mt-2 mb-5 bt-mdl">
                   MAKE ENQUIRY
                   <i class="fa fa-paper-plane"></i>
                </a>
           </div>
         </div>
    	</div>
    </section>
@elseif(@$page->selectTemplate == 'basicpage-layout')
<section class="ftco-section py-5 bg-info-gradient-3">
    	<div class="container">
    		<div class="row">
         	<div class="col-md-12 mb-4"><img src="{{ URL::asset('uploads/' . @$page->image2)}}" width="100%" height="auto" alt="{{@$page->title}}"></div>
            <div class="col-md-12">
            	<h5 class="modal-title">{{@$page->title}}</h5>
		        <h3 class="modal-title mb-3">{{@$page->metaTitle}}</h3>
                
                {!! @$page->contents !!}
                
                <!-- SUBSCRIBE FORM -->

                <a href="{{route('user.contact')}}" target="_blank" class="btn btn-primary mt-2 mb-5 bt-mdl">
                   MAKE ENQUIRY
                   <i class="fa fa-paper-plane"></i>
                </a>
                
                
           </div>
         </div>
    	</div>
    </section>
@else
    <section class="ftco-section py-5 bg-info-gradient-3">
        <div class="container">
            <div><h1>{{@$page}}</h1></div>
        </div>
    </section>
@endif
@endsection