@extends('layouts.user.header')

@section('title', 'NFT Markets | About')

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