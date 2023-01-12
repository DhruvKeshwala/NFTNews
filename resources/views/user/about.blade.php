@extends('layouts.user.header')

@if(@$page->metaTitle != null)
  @section('title', @$page->metaTitle)
@else
  @section('title', 'NFT Markets | About')
@endif

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>About</span></p>
          </div>
        </div>
      </div>
    </section>
    <div class="container news-banner mb-3"><a href="#" class="text-dark"><img src="{{ URL::asset('uploads/banner/' . @$banners->image)}}" width="100%" height="auto" alt="Banner Image"></a></div>
    
    
    <section class="ftco-section py-5 bg-info-gradient-3">
    	<div class="container">
    		<div class="row justify-content-center mb-3">
              <div class="col-md-12 heading-section text-left ftco-animate">
                <h2>{{@$page->title}}</h2>
              </div>
            </div>
    		<div class="row no-gutters">    			
                <div class="col-md-12">

                   {!! @$page->contents !!}
                   
                </div>
        	</div>
    	</div>
    </section>
@endsection