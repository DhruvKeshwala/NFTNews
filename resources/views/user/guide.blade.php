@extends('layouts.user.header')

@section('title', 'NFT Markets | Guide')

@section('content')
<style>
.tagLink {
  cursor: pointer;
}  
</style>

<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Guide</span></p>
          </div>
          
        </div>
      </div>
    </section>
    
    <section class="ftco-section py-5 bg-info-gradient-3">
    	<div class="container">
    	 
          
          <div class="row">
              <div class="col-md-12">
              	<div class="row ftco-animate">
                  <div class="col-md-12 mx-auto mb-3 heading-section heading-section-white text-left ftco-animate">
                    <h2 class="mb-0 py-1">GUIDE</h2>
                  </div>
                </div>
				<div class="row d-flex">
                  <div class="col-md-4 d-flex mb-4 text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'getting-started']) }}" class="text-light">Getting Started</a></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'buying' ]) }}" class="text-light">Buying</a></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'selling' ]) }}" class="text-light">Selling</a></h4>
                      </div>
                    </div>
                   </div>
                   <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'creating']) }}" class="text-light">Creating</a></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'policies' ]) }}" class="text-light">Policies</a></h4>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'faqs' ]) }}" class="text-light">FAQs</a></h4>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'userSafety' ]) }}" class="text-light">User Safety</a></h4>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'developers']) }}" class="text-light">Developers</a></h4>
                      </div>
                    </div>
                  </div>
                   
                  <div class="col-md-4 mb-4 d-flex text-center ftco-animate">
                    <div class="services py-5 rounded border btn-light align-self-stretch">
                      <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-crm"></span>
                      </div>
                      <div class="text px-4 mt-3">
                        <h4 class="heading"><a href="{{ route('user.guideList', ['category' => 'solana']) }}" class="text-light">Solana</a></h4>
                      </div>
                    </div>
                  </div>
                   
                  </div>
               </div>
               
             </div>
    	</div>
    </section>
@endsection