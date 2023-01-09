@extends('layouts.user.header')

@section('title', 'NFT Markets | Crypto Journal')

@section('content')

<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="index.html">Home</a><i class="fa fa-angle-right"></i></span><span>Crypto Journal</span></p>
          </div>
          
        </div>
      </div>
    </section>
    
    <section class="ftco-section ftco-animate bg-info-gradient-3">
     <div class="container">
       <div class="row">
			<div class="col-md-12">
             
             <h1 class="mb-4 text-center">{{@$cryptoDetail->title}}</h1>
             
             <div id="book1-trigger" class="text-center">
             	<img src="{{ URL::asset('uploads/' . @$cryptoDetail->image) }}" width="auto" height="500">
             </div>
             <div style="display: none">
	         	<div id="book1"></div>
             </div>
             
             <div class="text-center mt-4">
             	<a href="{{URL::asset('uploads/' . @$cryptoDetail->pdf) }}" target="_blank" class="btn btn-outline-light-gradient bg-white border">DOWNLOAD PDF HERE</a>
             </div>
            
             <div class="text-left my-4 text-justify">
                {!! @$cryptoDetail->fullDescription !!}
            </div>
           </div>
           
           {{-- <div class="col-md-3 pl-md-0">
            @if($banners->size == "280 x 400 pixels")
              <div class="sidebar-box">
                  <a href="{{$banners->url}}" target="_blank"><img src="{{ URL::asset('uploads/banner/' . $banners->image) }}"
                          width="100%" height="auto" alt=""></a>
              </div>
            @endif --}}
            {{-- <div class="sidebar-box">
                <a href="#" target="_blank"><img src="{{URL::asset('images/side-banner.png') }}" width="100%" height="auto" alt=""></a>
             </div>         --}}
          </div>      	
       </div>
     </div>
    </section>	
    
    <!-- Quick View -->
    <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">  
          <!-- Modal content-->     
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title"><i class="fa fa-calendar"></i> December 15, 2022</h6>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Blockchain Bandicoots Are Coming</h4>
                <p><strong>Company</strong> | Blockchain Bandicoots<br>
                <strong>Price</strong> | 0.2 ETH<br>
                <strong>Supply</strong> | 5000</p>
                
                <p>Blockchain Bandicoot™ is a collection of 5,000 unique NFTs living on the Ethereum blockchain. Bandicoot Guardians are the protectors of the Blockchain World, Burokuchen. An evil mastermind named Korruption has infected the Blockchain, Korrupting Bandicoots all across their world.</p>
            </div>
         </div>
  
        </div>
    </div>

@endsection