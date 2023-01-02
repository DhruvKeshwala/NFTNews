@extends('layouts.user.header')

@section('title', 'NFT Markets | Videos')

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="index.html">Home</a><i class="fa fa-angle-right"></i></span><span>Videos</span></p>
          </div>
          
        </div>
      </div>
    </section>
    
    <div class="ftco-section pt-5 pb-2 bg-info-gradient">
      <div class="container col-md-7 mx-auto text-center">
      	<div class="row mb-5">
          <div class="col-md-6 text-left">{{@$videoDetail->created_at->format('F d, Y')}}</div>
          <div class="col-md-6 text-right">
            <!-- AddToAny BEGIN -->
            <div class="a2a_kit a2a_kit_size_32 float-right a2a_default_style" data-a2a-icon-color="lightgray">
            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_telegram"></a>
            <a class="a2a_button_email"></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
            <!-- AddToAny END -->
          </div>
        </div>
    	<h1 class="my-5 text-justify">{{@$videoDetail->title}}</h1>
        
        <iframe width="100%" height="415" src="https://www.youtube.com/embed/vMnlgWFnJWU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        
        <div class="text-left my-4 text-justify">
        	{!!@$videoDetail->fullDescription!!}
        </div>
        
      </div>
    </div>
    
    <section class="ftco-section ftco-animate pt-0">
     <div class="container">
       <div class="row">
      	
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