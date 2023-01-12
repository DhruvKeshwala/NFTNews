@extends('layouts.user.header')

@if(@$nftDropDetail->metaTitle != null)
  @section('title', @$nftDropDetail->metaTitle)
@else
  @section('title', 'NFT Markets | NFT Drops')
@endif


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
    	<h1>{{@$nftDropDetail->description}}</h1>
        <h3>{{@$nftDropDetail->created_at->format('F d, Y')}}</h3>
        <h4><strong>Company</strong> <span class="divider">|</span> {{@$nftDropDetail->blockChain}}</h4>
        <h4><strong>Price</strong> <span class="divider">|</span> {{@$nftDropDetail->priceOfSale}}</h4>
        {{-- <h4><strong>Supply</strong> <span class="divider">|</span> 5000</h4> --}}

      </div>
    </div>
   	
    <section class="ftco-section pt-0 pb-4">
    	<div class="container">
    	    
            <div class="news-listing ftco-animate">
              <div class="news-wrap p-0 align-items-center">
               
               <div class="w-100 pb-2">
                <a href="#" class="text-dark"><img src="@if($nftDropDetail->image2 != null) {{ URL::asset('uploads/' . @$nftDropDetail->image2 ) }} @else {{ URL::asset('images/default-image-2.png') }} @endif" width="100%" alt="" height="auto" class="img"></a>
               </div>
               <div class="row">
                  <div class="col-md-6"><span class="btn-sm btn-light border d-inline-block">NFT DROPS</span> <span class="btn-sm btn-light border d-inline-block">ETHEREUM</span></div>
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
                {!! @$nftDropDetail->description !!}
                {{-- <p>{Blockchain Bandicoot™ is a collection of 5,000 unique NFTs living on the Ethereum blockchain. Bandicoot Guardians are the protectors of the Blockchain World, Burokuchen. An evil mastermind named Korruption has infected the Blockchain, Korrupting Bandicoots all across their world.</p>
                 <p>On Kobe’s first day of Guardian training, he gets attacked by a Korrupted Bandicoot and to his surprise, he’s saved by two Blockchain Developers from the real world, Devon and Kari.</p>
                 <p>When the three are bombarded by a hoard of Korrupted Bandicoots, Devon thinks quickly and copies Kobe’s code to create several Bandicoots to protect them… That was the day 5000 Blockchain Bandicoots were born.}</p>
                 
                 <p>Pre-Sale Mint: December 22nd – .1ETH<br>
                 Public Mint: December 26th – .2 ETH</p>
                 
                 <p>Join the Pre-Sale List Today: https://onemint.io/join/bcbcaccesslist</p> --}}
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <p class="m-0 p-0">Addes {{@$nftDropDetail->created_at->format('F d, Y')}}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{@$nftDropDetail->twitterLink}}" class="btn-sm bg-light"><i class="fa fa-twitter text-light"></i></a>
                        <a href="{{@$nftDropDetail->websiteLink}}" class="btn-sm bg-light"><i class="fa fa-globe text-light"></i></a>
                        <a href="{{@$nftDropDetail->discordLink}}" class="btn-sm bg-light"><i class="fa fa-github-alt text-light" aria-hidden="true"></i></a>
                    </div>
              	</div>
              </div>
             
             </div>
             <!--<a href="#" class="btn d-block btn-light py-2 mt-4">Load More News</a>-->
        </div>
    </section>

    <section class="ftco-section bg-light mb-5 py-5">
      <div class="container mb-5">
		    <div class="row ftco-animate">
        	<div class="col-md-12 mx-auto mb-3 heading-section heading-section-white text-left ftco-animate">
            <h2 class="mb-0 py-1">NFT DROPS <span class="text-light">|</span> FEATURED</h2>
          </div>
          <div class="container">
            <div class="row d-flex">
              @if (@$featuredDropManagement)
                @foreach ($featuredDropManagement as $dropManagement)
                  <div class="col-md-4 d-flex ftco-animate">
                      <div class="blog-entry rounded shadow align-self-stretch">
                          {{-- {{ $dropManagement->start_date }} --}}
                          @if ($dropManagement->start_date && $dropManagement->end_date)
                              <span class="badge_featured badge-light text-light">Featured</span>
                          @endif
                          <a href="{{ route('user.nftDrop_detail', ['id' => @$dropManagement->slug]) }}" class="block-30 rounded"
                              style="background-image: url(@if($dropManagement->image != null) {{ URL::asset('uploads/' . @$dropManagement->image) }} @else {{ URL::asset('images/default-image-1.png') }} @endif);">
                          </a>
                          <div class="text px-4 mt-3 text-center">

                              <h3 class="heading pt-3"><a href="{{ route('user.nftDrop_detail', ['id' => @$dropManagement->slug]) }}">{{ @$dropManagement->name }}</a>
                              </h3>
                              <div class="row pb-4">
                                  <div class="col-md-6 pb-3 text-left">
                                      <a href="{{ @$dropManagement->twitterLink }}" class="btn-sm bg-light"><i
                                              class="fa fa-twitter" title="Twitter"></i></a>
                                      <a href="{{ @$dropManagement->websiteLink }}" class="btn-sm bg-light"><i
                                              class="fa fa-globe" title="Website"></i></a>
                                      <a href="{{ @$dropManagement->discordLink }}" class="btn-sm bg-light"><i
                                              class="fa fa-github-alt" title="Discord" aria-hidden="true"></i></a>
                                  </div>
                                  <div class="col-md-5 ml-auto text-right">
                                      <small class="btn-light py-1 px-2 rounded"><i class="fa fa-calendar"></i>
                                          {{ @$dropManagement->created_at->format('M d, Y') }}</small>
                                  </div>
                                  <div class="col-md-6 pr-0 text-left">
                                            <span class="text-dark"><strong>Blockchain</strong> <span
                                                    class="text-black-50">|</span>
                                                {{ @$dropManagement->blockChain }}</span><br>
                                            {{-- <span class="text-dark"><strong>Supply</strong> <span
                                                    class="text-black-50">|</span>
                                                {{ @$dropManagement->priceOfSale }}</span><br> --}}
                                            <span class="text-dark"><strong>Price</strong> <span
                                                    class="text-black-50">|</span>{{ @$dropManagement->priceOfSale }}</span>
                                        </div>

                                  <div class="col-md-6 pt-1 text-right">
                                      <a href="#" class="btn btn-outline-light-gradient border py-1 mb-2 w-100"
                                          style="font-size: 12px;">Add to Calendar</a>
                                      <a href="{{ route('user.nftDrop_detail', ['id' => @$dropManagement->slug]) }}"
                                          class="btn btn-outline-light-gradient border w-100 py-1 mb-2"
                                          style="font-size: 12px;">View Project</a>
                                  </div>
                              </div>

                          </div>

                      </div>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection