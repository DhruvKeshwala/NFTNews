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
    
    <section class="ftco-section py-5 bg-info-gradient">
       <div class="container">
       
         <div class="row">
          
          <div class="col-md-4 d-flex">
            <a href="#" class="page-link active py-3">ALL</a> <a href="#" class="py-3 page-link px-4 mx-2">LATEST</a> <a href="#" class="py-3 page-link px-4">FEATURED</a>
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
          </div>
          <br>
          </div>
          <div>
            {{ $videos->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
          </div>
      </div>
    </section>
    
    <section class="ftco-section ftco-animate pt-0">
    <div class="container">
       <div class="row">
       @if(count($videos))
        @foreach($videos as $video)
        <div class="col-md-3"> 
       	  <figure class="effect-lily play">
           <img src="{{URL::asset('uploads/'. @$video->image1)}}" width="100%" class="img-fluid w-100 h-auto" alt="">
           <figcaption>
            <p class="text-center"><a href="{{ route('user.video_detail', ['id' => base64_encode(@$video->id)]) }}" class="btn btn-primary border py-1 mt-n5 js-anchor-link" data-toggle="modal" data-target="#myModal-{{@$video->id}}">Quick View</a> <a href="#" class="btn btn-primary border py-1 mt-n5">View Details</a></p>
           </figcaption>
          </figure>
          <div class="mt-md-n4">
          	<span class="text-light d-block">{{@$video->title}}</span>
		    <p><a href="#" class="text-dark">{{@$video->shortDescription}}</a></p>	
          </div>
        </div>
        @endforeach
        @endif
       
         
         
	  </div>
      
      <div>
        {{ $videos->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
        </div>
     </div>
    </section>	
    <!-- Quick View -->
    @foreach($videos as $video)
    <div class="modal fade" id="myModal-{{@$video->id}}" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">  
          <!-- Modal content-->     
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title"><i class="fa fa-calendar"></i>{{@$video->created_at->format('F d, Y')}}</h6>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>{{@$video->title}}</h4>
                <p><strong>Company</strong> | Blockchain Bandicoots<br>
                <strong>Price</strong> | 0.2 ETH<br>
                <strong>Supply</strong> | 5000</p>
                
                <p>{{@$video->shortDescription}}</p>
            </div>
         </div>
  
        </div>
    </div>
    @endforeach
@endsection