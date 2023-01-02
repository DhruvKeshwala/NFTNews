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
          	  <div class="col-md-3">
              	<div class="sidebar-box bg-transparent ftco-animate">
                  <div class="categories">
                    <h3>Articles in this section</h3>
                    @if(count($guides))
                    @foreach($guides as $guide)
                    <a href="{{route('user.guideList', ['id' => @$guide->id, 'slug' => @$guide->slug])}}" class="btn btn-outline-light d-block border my-2 ">{!!@$guide->question!!}</a>
                    @endforeach
                    @endif
                    {{-- <a href="#" class="btn btn-outline-light d-block border my-2">What crypto wallets can I use with OpenSea?</a>
                    <a href="#" class="btn btn-outline-light d-block border my-2">What is a Non-Fungible Token (NFT)?</a>
                    <a href="#" class="btn btn-outline-light d-block border my-2">What are the key terms to know in NFTs and Web3?</a>
                    <a href="#" class="btn btn-outline-light d-block border my-2">What is a crypto wallet?</a>
                    <a href="#" class="btn btn-outline-light d-block border my-2">What currencies can I use on OpenSea?</a>
                    <a href="#" class="btn btn-outline-light d-block border my-2">How do I purchase Ethereum (ETH)?</a> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-9">
              	
				<div class="row d-flex">
                  <div class="col-md-12 mb-4 pt-5 ftco-animate">

                    @if(!empty(@$singleGuide))
                        @foreach($singleGuide as $guide)
                            {!! @$guide->answer !!}
                        @endforeach
                    @endif
                  	{{-- <h2>How do I create an OpenSea account?</h2>  
                    
                    <p>You'll need digital currency, a crypto wallet, and an OpenSea account to start buying or selling NFTs using OpenSea. Let's get started! </p>
                    
                    <h4>1. Purchase digital currency (ETH)</h4>
                    <p>You can buy ETH, the digital currency that fuels transactions on the Ethereum blockchain, from a digital currency exchange like Coinbase. You'll need ETH to "mint" an NFT, purchase an NFT, and for gas fees to complete transactions. Gas fees are a bit of a tricky concept, but we simplify the basics in our What are gas fees? help guide.</p>
                    <p>Now that you have ETH, let's get a crypto wallet.</p>
                    
                    <h4>2. Install a crypto wallet</h4>
                    <p>A crypto wallet, such as MetaMask, stores your ETH and processes transactions on the Ethereum blockchain. A unique wallet address will be generated for you, and you'll use this address to complete transactions.</p>
                    
                    <iframe width="100%" height="415" src="https://www.youtube.com/embed/mLQB1m5keQQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <br>
<br>

                    <p>All transactions connected to your wallet address can be found on etherscan.io, an independent blockchain explorer. It's a good idea to check Etherscan after completing each transaction.</p>
                    
                    <h4>Why do I need a wallet before buying and selling on OpenSea? </h4>
                    
                    <p>OpenSea is a tool you use to interact with the blockchain. We never take possession of your items or store your NFTs. Instead, we provide a system for peer-to-peer exchanges. Since you’ll be using OpenSea to interact directly with others on the blockchain, you’ll need a wallet to help you turn your actions in the browser into transactions on the blockchain. You can see the available wallets in our help center guide, What crypto wallets can I use with OpenSea?</p>
                    <p>Now that you have a crypto wallet installed, you can connect your wallet address to OpenSea.</p> --}}
                    
                  </div>
                  
                   
                  </div>
               </div>
               
             </div>
    	</div>
    </section>
@endsection