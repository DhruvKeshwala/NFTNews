@extends('layouts.user.header')

@section('title', 'NFT Markets | Crypto Journal')

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Crypto Journal</span></p>
          </div>
          
        </div>
      </div>
    </section>

<div class="ftco-section bg-info-gradient pb-3 pt-5">
      <div class="container">
      <form action="{{ route('user.filter_crypto') }}" id="crypto_form" method="POST">
        @csrf
        <div class="row mt-2">
            
          <div class="col-md-4 d-flex">
            <input type="hidden" name="filterValue" id="filterValue" value="{{@$filterValue}}">
            <a onclick="filterForCrypto('all')" id="allData" class="page-link py-3 {{ @$filterValue == 'all' || @$filterValue == '' ? 'active' : '' }}">ALL</a> <a onclick="filterForCrypto('thisWeek')" class="py-3 page-link px-4 mx-2 {{ @$filterValue == 'thisWeek' ? 'active' : '' }}">THIS WEEK</a> <a onclick="filterForCrypto('thisMonth')" class="py-3 page-link px-4 {{ @$filterValue == 'thisMonth' ? 'active' : '' }}">THIS MONTH</a>
          </div>
          
          <div class="col-md-3 px-0">
            {{-- <form action="#" class="w-100"> --}}
              <div class="form-group d-flex searchform border mb-0 mx-0 bg-white">
                <input type="text" name="search" class="form-control text-center" placeholder="SEARCH NEWS" value="{{@$search}}">
                <button type="submit" placeholder="" class="form-control w-auto"><span class="fa fa-search text-light"></span></button>
              </div>
            {{-- </form> --}}
          </div>
          
          {{-- <div class="col-md-2 text-right pr-0">
          <select class="form-control" id="list" name="list">
                <option>SELECT CATEGORY</option>
                <option value="avalanche">ALL</option>
                <option value="bsc">NFTs</option>
                <option value="cardano">COLLECTABLES</option>
                <option value="ethereum">ART</option>
                <option value="harmony">BLOCKCHAIN</option>
                <option value="nahmii">GAMING</option>
                <option value="near">METAVERSE</option>
                <option value="nervos">COINS</option>
                <option value="other">DAO</option>
                <option value="polygon">WEB 3.0</option>
                <option value="solana">REVIEWS</option>
            </select>
            
          </div> --}}
            
        </div>
      </form>
        <br>
        <div>
          {{ $cryptoJournals->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
        </div>
        <div class="heading-section heading-section-white mt-5 text-center ftco-animate">
          <h2>Crypto Journal</h2>
        </div>
        
      </div>
    </div>

    <section class="ftco-section pt-0 bg-info-gradient-3">
       <div class="container">
    	  		<div class="row d-flex">
                @if(!empty($cryptoJournals))
                    @foreach($cryptoJournals as $crypto)
                        <div class="col-md-3 d-flex mb-4 text-center ftco-animate">
                            <a href="{{ route('user.crypto_detail', ['id' => @$crypto->slug]) }}">
                            <figure class="effect-lily">
                            <img src="{{URL::asset('uploads/' . @$crypto->image)}}" width="100%" class="img-fluid w-100 h-auto" alt="">
                            <figcaption>
                                <p class="mt-n5 text-center"><a href="{{ route('user.crypto_detail', ['id' => @$crypto->slug]) }}" class="btn btn-primary border py-1 mt-n5">View More</a> <a href="#" class="btn btn-primary border py-1 mt-n5 js-anchor-link" data-toggle="modal" data-target="#myModal-{{@$crypto->id}}">Quick View</a></p>
                            </figcaption>
                            </figure>
                            </a>
                        </div>
                    @endforeach
                @endif
             </div>
             
             <div>
                {{ $cryptoJournals->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
             </div>
    	</div>
    </section>

    <!-- Quick View -->
    @foreach($cryptoJournals as $crypto)
    <div class="modal fade" id="myModal-{{@$crypto->id}}" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">  
          <!-- Modal content-->     
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title"><i class="fa fa-calendar"></i> {{@$crypto->created_at->format('F d, Y')}}</h6>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>{{@$crypto->title}}</h4>
                <p><strong>PDF</strong> <a href="{{ URL::asset('uploads/') . '/' . @$crypto->pdf }}" target="_blank" style="color:blue;">Download</a><br>
                </p>
                
                <p>{{@$crypto->shortDescription}}</p>
            </div>
         </div>
  
        </div>
    </div>
    @endforeach
@endsection