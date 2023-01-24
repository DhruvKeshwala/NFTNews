@extends('layouts.user.header')

@section('title', 'NFT Markets | Videos')

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Videos</span></p>
          </div>
          
        </div>
      </div>
    </section>
    <div class="container news-banner mb-3"><a href="#" class="text-dark"><img src="{{ URL::asset('uploads/banner/' . @$banners->image)}}" width="100%" height="auto" @if($banners->image_alt != null || $banners->image_alt != '') alt="{{@$banners->banner_image_alt}}" @else alt="Top Banner Image" @endif></a></div>
    
    <section class="ftco-section py-5 bg-info-gradient">
       <div class="container">
       <form action="{{ route('user.videoSearch') }}" id="video_form" method="GET">
         <div class="row">
            <div class="col-md-4 d-flex">
              <input type="hidden" name="filterValue" id="filterValue" value="{{@$filterValue}}">
              <a onclick="filterForVideos('all')" id="allData" class="page-link py-3 {{ @$filterValue == 'all' || @$filterValue == '' ? 'active' : '' }}">ALL</a> 
              <a onclick="filterForVideos('latest')" class="py-3 page-link px-4 mx-2 {{ @$filterValue == 'latest' ? 'active' : '' }}">LATEST</a> 
              <a onclick="filterForVideos('featured')" class="py-3 page-link px-4 {{ @$filterValue == 'featured' ? 'active' : '' }}">FEATURED</a>
            </div>
            
            <div class="col-md-3 px-0">
              {{-- <form action="#" class="w-100"> --}}
                <div class="form-group d-flex bg-white searchform border mb-0 mx-0">
                  <input type="text" name="search" class="form-control text-center" placeholder="SEARCH VIDEOS" value="{{@$search}}">
                  <button type="submit" placeholder="" class="form-control w-auto"><span class="fa fa-search text-light"></span></button>
                </div>
              {{-- </form> --}}
            </div>

          <div class="col-md-2 text-right pr-0">
          <select class="form-control" id="filternftcategoryValue" name="filternftcategoryValue" onchange="filterForVideos('category')">
            <option value="">Select Categories</option>
            {{-- <option value="all" {{ @$filtercategoryId == 'all' || @$filtercategoryId == ''  ? "selected" : "" }}>All</option> --}}
            @foreach($categories as $category)
                <option value="{{base64_encode(@$category->id)}}" {{ base64_encode(@$filtercategoryId) == base64_encode(@$category->id)  ? "selected" : "" }}>{{@$category->name}}</option>
            @endforeach
            {{-- <option value="avalanche">Avalanche</option> --}}
          </select>
          </div>
          </div>
        </form>
          <br> 
          <div>
            {{ $videos->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
          </div>
      </div>
    </section>
    <style>
        figure.effect-lily.video-section img{
            height: auto !important;
        }
        figure.effect-lily.video-section p{
            line-height: 0 !important;
        }
    </style>
    <section class="ftco-section ftco-animate pt-0">
    <div class="container">
       <div class="row">
       @if(count($videos))
        @foreach($videos as $video)
        
        <div class="col-md-3"> 
       	  <figure class="effect-lily play">
           <img 
            @if($video->image1 != null || $video->image1 != '' || file_exists($video->image) == true) 
              src="{{URL::asset('uploads/'. @$video->image1)}}"
            @else
              src="{{URL::asset('images/default-video-list.png')}}"
            @endif 
            @if($video->image1_alt != null || $video->image1_alt != '') 
              alt="{{@$video->image1_alt}}"
            @else
              alt="{{@$video->title}}"
            @endif 
            width="100%" class="img-fluid w-100 h-auto" >
           <figcaption>
            @if($video->videoType == 'Featured Video')
              <span class="badge_featured badge-light text-light">Featured</span>
            @endif
            <p class="text-center"><a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5 js-anchor-link" data-toggle="modal" data-target="#myModal-{{@$video->id}}">Watch Now</a> <a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5">View Details</a></p>
           </figcaption>          
          <div class="mt-md-n4">
          	<span class="text-light d-block mt-2" title="{{@$video->title}}">{{substr(@$video->title, 0, 30)}}..</span>
            {{-- <p class="text-justify"><a href="#" title="{{ @$video->shortDescription }}" class="text-dark">{{substr(@$video->shortDescription, 0, 40)}}..</a></p>	 --}}
          </div>
          </figure>
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
        <div class="modal-dialog" style="top:15%; max-width: 60%;" role="document">  
          <!-- Modal content-->     
          <div class="modal-content">
            <div class="modal-header">
              {{-- <h6 class="modal-title"><i class="fa fa-calendar"></i>{{@$video->created_at->format('F d, Y')}}</h6> --}}
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                {{-- <h4>{{@$video->title}}</h4><br> --}}
              {!!@$video->code!!}
              </div>
         </div>
  
        </div>
    </div>
    @endforeach
@endsection