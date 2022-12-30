@extends('layouts.user.header')

@section('title', 'NFT Markets | NFT Drops')

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>NFT Drops</span></p>
          </div>
        </div>
      </div>
    </section>
    
    <div class="ftco-section py-5 bg-info-gradient">
      <div class="container text-center">
    	<h1>Blockchain Bandicoots Are Coming</h1>
        <h3>December 26, 2022</h3>
        <h4><strong>Company</strong> <span class="divider">|</span> Blockchain Bandicoots</h4>
        <h4><strong>Price</strong> <span class="divider">|</span> 0.2 ETH</h4>
        <h4><strong>Supply</strong> <span class="divider">|</span> 5000</h4>

      </div>
    </div>
   	
    <section class="ftco-section pt-0 pb-4">
    	<div class="container">
    	    
            <div class="news-listing ftco-animate">
              <div class="news-wrap p-0 align-items-center">
               
               <div class="w-100 pb-2">
                <a href="#" class="text-dark"><img src="{{ URL::asset('uploads/' . @$nftDropDetail->image2 ) }}" width="100%" alt="" height="auto" class="img"></a>
               </div>
               <div class="row">
                  <div class="col-md-6"><a href="#" class="btn-sm btn-light border d-inline-block">NFT DROPS</a> <a href="#" class="btn-sm btn-light border d-inline-block">ETHEREUM</a></div>
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
               <div class="text mt-3">
                <p>Blockchain Bandicoot™ is a collection of 5,000 unique NFTs living on the Ethereum blockchain. Bandicoot Guardians are the protectors of the Blockchain World, Burokuchen. An evil mastermind named Korruption has infected the Blockchain, Korrupting Bandicoots all across their world.</p>
                 <p>On Kobe’s first day of Guardian training, he gets attacked by a Korrupted Bandicoot and to his surprise, he’s saved by two Blockchain Developers from the real world, Devon and Kari.</p>
                 <p>When the three are bombarded by a hoard of Korrupted Bandicoots, Devon thinks quickly and copies Kobe’s code to create several Bandicoots to protect them… That was the day 5000 Blockchain Bandicoots were born.</p>
                 
                 <p>Pre-Sale Mint: December 22nd – .1ETH<br>
                 Public Mint: December 26th – .2 ETH</p>
                 
                 <p>Join the Pre-Sale List Today: https://onemint.io/join/bcbcaccesslist</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <p class="m-0 p-0">Addes November 18, 2022</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="#" class="btn-sm bg-light"><i class="fa fa-twitter text-light"></i></a>
                        <a href="#" class="btn-sm bg-light"><i class="fa fa-facebook text-light"></i></a>
                        <a href="#" class="btn-sm bg-light"><i class="fa fa-github-alt text-light" aria-hidden="true"></i></a>
                    </div>
              	</div>
              </div>
             
             </div>
             <!--<a href="#" class="btn d-block btn-light py-2 mt-4">Load More News</a>-->
        </div>
    </section>
@endsection