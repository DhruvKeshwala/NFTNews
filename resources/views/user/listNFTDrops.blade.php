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

<section class="ftco-section pt-0 pb-5 bg-info-gradient">
       <div class="container">
       
         <div class="row my-2">
              
          <div class="col-md-12 text-right py-4">
            <a href="submit-nft.html" class="rounded px-4 btn bg-white btn-outline-light-gradient border mt-md-n5 pb-2">SUBMIT NFT</a>
          </div>
          <div class="col-md-4 d-flex">
            <a href="#" class="page-link active py-3">UPCOMING</a> <a href="#" class="py-3 page-link px-4 mx-2">PAST</a> <a href="#" class="py-3 page-link px-4">MOST POPULAR</a>
          </div>
          
          <div class="col-md-3 px-0">
          	<form action="#" class="w-100">
              <div class="form-group d-flex searchform border mb-0 mx-0 bg-white">
                <input type="text" class="form-control text-center" placeholder="SEARCH NEWS">
                <button type="submit" placeholder="" class="form-control w-auto"><span class="fa fa-search text-light"></span></button>
              </div>
            </form>
          </div>
          
          <div class="col-md-2 text-right pr-0">
          <select class="ddl-select" id="list" name="list">
                <option>SELECT BLOCKCHAIN</option>
                <option value="avalanche">Avalanche</option>
                <option value="bsc">BSC</option>
                <option value="cardano">Cardano</option>
                <option value="ethereum">Ethereum</option>
                <option value="harmony">Harmony</option>
                <option value="nahmii">Nahmii</option>
                <option value="near">Near</option>
                <option value="nervos">Nervos</option>
                <option value="other">Other</option>
                <option value="polygon">Polygon</option>
                <option value="solana">Solana</option>
                <option value="tezos">Tezos</option>
                <option value="ton">TON</option>
                <option value="waves">Waves</option>
                <option value="wax">Wax</option>
           </select>
          </div>
          {{-- <div class="col-md-3 text-right">
            <div class="block-27 pt-2">
              <ul>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
           </div> --}}
               
          </div>
          <br>
            {{ @$allDropManagement->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
          
          <div class="row">
           <div class="col-md-12 mt-5 text-center">
             <div class="tag-widget post-tag-container">
              <div class="tagcloud"><a href="#" class="active">ALL</a><a href="#">NFTs</a><a href="#">COLLECTABLES</a><a href="#">ART</a><a href="#">BLOCKCHAIN</a><a href="#">GAMING</a><a href="#">METAVERSE</a><a href="#">COINS</a><a href="#">DAO</a><a href="#">WEB 3.0</a><a href="#">REVIEWS</a></div>
             </div>
           </div>

        </div>
      </div>
    </section>
    
    <section class="ftco-section pt-0 pb-5">
      <div class="container">
      	<div class="row d-flex">
        @if(@$allDropManagement)
            @foreach($allDropManagement as $dropManagement) 
              <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry rounded shadow align-self-stretch">
                  <a href="nft-details.html" class="block-30 rounded" style="background-image: url({{ URL::asset('uploads/' . @$dropManagement->image)}});">
                  </a>
                  <div class="text px-4 mt-3 text-center">
                    
                    <h3 class="heading pt-3"><a href="nft-details.html">{{@$dropManagement->name}}</a></h3>
                    <p>Welcome to the Voxel Crazy Head project! Voxel Crazy Head is a collection of 10 000 NFT unique heads on</p>
                    <div class="row pb-4">
                      <div class="col-md-6 pb-3 text-left">
                        <a href="{{@$dropManagement->twitterLink}}" class="btn-sm bg-light"><i class="fa fa-twitter" title="Twitter"></i></a>
                        <a href="{{@$dropManagement->websiteLink}}" class="btn-sm bg-light"><i class="fa fa-globe" title="Website"></i></a>
                        <a href="{{@$dropManagement->discordLink}}" class="btn-sm bg-light"><i class="fa fa-github-alt" title="Discord" aria-hidden="true"></i></a>
                      </div>
                      <div class="col-md-5 ml-auto text-right">
                        <small class="btn-light py-1 px-2 rounded"><i class="fa fa-calendar"></i> {{ @$dropManagement->created_at->format('M d, Y')}}</small>
                      </div>
                      <div class="col-md-6 pr-0 text-left">
                        <span class="text-dark"><strong>Blockchain</strong> <span class="text-black-50">|</span> {{@$dropManagement->blockChain}}</span><br>
                        <span class="text-dark"><strong>Supply</strong> <span class="text-black-50">|</span> {{@$dropManagement->priceOfSale}}</span><br>
                        <span class="text-dark"><strong>Price</strong> <span class="text-black-50">|</span> 0.05 USDT</span>
                      </div>
                      
                      <div class="col-md-6 pt-1 text-right">
                        <a href="#" class="btn btn-outline-light-gradient border py-1 mb-2 w-100" style="font-size: 12px;">Add to Calendar</a>
                        <a href="nft-details.html" class="btn btn-outline-light-gradient border w-100 py-1 mb-2" style="font-size: 12px;">View Project</a>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
              </div>
            @endforeach
        @endif
          
          
          
        </div>
      </div>
    </section>	

@endsection