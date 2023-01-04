@extends('layouts.user.header')

@section('title', 'NFT Markets | Advertise')

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Advertise</span></p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-section py-5 bg-info-gradient-3">
    	<div class="container">
    		<div class="row">
         	<div class="col-md-5"><img src="{{ URL::asset('images/middle-list-ads.jpg')}}" width="100%" height="auto" alt=""></div>
            <div class="col-md-7">
            	<h5 class="modal-title">THE MOST POPULAR</h5>
		        <h3 class="modal-title mb-3">NFTs IN THE MARKET</h3>
                
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum viverra elit elit. Suspendisse scelerisque lacus eu quam tincidunt, in vestibulum enim condimentum. Aenean rutrum ante ut mollis ullamcorper. Cras gravida egestas consectetur. Sed quis laoreet risus. Morbi ante diam, cursus commodo est ac, placerat semper turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris vitae odio leo. Aliquam posuere, elit sed venenatis auctor, ipsum urna efficitur mauris, a fermentum mauris lacus et lectus. Suspendisse potenti. Aliquam elit purus, condimentum sed ultrices id, sodales sed justo.</p>
                
                <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam at velit at urna lacinia laoreet vel in odio. Praesent at risus ante. Donec tincidunt vestibulum lacus, ac consequat est malesuada sed. Proin tempor, eros pharetra varius ullamcorper, sapien felis blandit metus, nec finibus libero arcu vel libero. Aenean turpis est, sodales sit amet tortor ut, finibus tincidunt lorem. Integer accumsan aliquet sapien vitae blandit. Morbi pretium sapien ac lacus bibendum imperdiet. Suspendisse euismod porttitor ligula, quis ornare dui convallis ac.</p>
                
                <!-- SUBSCRIBE FORM -->

                <button type="submit" class="btn btn-primary mt-2 mb-5 bt-mdl">
                   MAKE ENQUIRY
                   <i class="fa fa-paper-plane"></i>
                </button>
                
                
                
           </div>
         </div>
    	</div>
    </section>
@endsection