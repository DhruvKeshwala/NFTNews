@extends('layouts.user.header')

@section('title', 'NFT Markets | Featured News')

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
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Featured News</span></p>
          </div>
        </div>
      </div>
    </section>

<div class="ftco-section py-5 bg-info-gradient">
      <div class="container">
    	<form action="{{ route('user.filterFeaturedNews') }}" method="post" class="col-md-12 mr-auto pl-0 pr-2">
          @csrf
          <div class="form-group d-flex searchform border mb-0 mx-0 bg-white">
            <input type="text" name="filterNewsTitle" class="form-control text-center" placeholder="Search news" value="<?php 
                if (!empty($_POST['filterNewsTitle'])) {
                    $q = $_POST['filterNewsTitle'];
                    echo $q;
                } ?>">
            <button type="submit" placeholder="" class="form-control w-auto"><span class="fa fa-search"></span></button>
          </div>
        </form>
      </div>
    </div>
   	
    <section class="ftco-section pt-0 pb-4">
    	<div class="container">
    	 <div class="row">
          
          <div class="col-md-12 px-md-0 px-0">
           <div class="container">
            <div class="mb-3 ftco-animate">
            <div class="heading-section">
             <h2 class="mb-0 py-1">FEATURED NEWS</h2>
            </div>
           </div>
           	
            <div class="news-listing ftco-animate">
            {{-- {{ $resultFeaturedNews->appends(Request::except('page'))->links('vendor.pagination.userCustom') }} --}}
             
              @if(@$resultFeaturedNews)
                  @foreach($resultFeaturedNews as $news)
                    @if($news->is_featurednew == 1)
                      <div class="story-wrap p-0 blog-entry d-md-flex align-items-center">
                      <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark"><div class="img" 
                        @if($news->image != null || $news->image != '' || file_exists($news->image) == true)
                          style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                        @else
                          style="background-image: url({{ URL::asset('images/default-listing-news.png') }});" 
                        @endif
                      ></div></a>
                      <div class="text pl-md-3">
                          <div class="meta mb-2">
                          <div><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">INDUSTRY TALK</a></div>
                          <div><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"><span class="fa fa-clock"></span>{{ @$news->created_at->diffForHumans() }}</a></div>
                          </div>
                          <h4><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                          <p>{{@$news->shortDescription}}</p>
                      </div>
                      </div>
                    @endif
                  @endforeach
              @else
                  <p>No Data Found..</p>
              @endif
            </div>
            {{-- {{ $resultFeaturedNews->appends(Request::except('page'))->links('vendor.pagination.userCustom') }} --}}
             
             
            </div>
            <!--<a href="#" class="btn d-block btn-light py-2 mt-4">Load More News</a>-->
           </div>
           </div>
          
          
          </div>
    	{{-- </div> --}}
    </section>
    <section class="ftco-section bg-light mb-5 py-5">
      <div class="container mb-5">
		<div class="row ftco-animate">
        	<div class="col-md-12 mx-auto mb-3 heading-section heading-section-white text-left ftco-animate">
            <h2 class="mb-0 py-1">MARKET NEWS <span class="text-light">|</span> FEATURED</h2>
          </div>
        </div>
        <div class="ftco-animate">
            <div class="mktnws-slider owl-carousel ftco-owl">
              @if(@$resultFeaturedNews2)
                @foreach($resultFeaturedNews2 as $news)
                  @if($news->is_featurednew == 1)
                    <div class="item text-center">
                      <div class="align-items-center justify-content-center"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"><img 
                         @if($news->article_1 != null || $news->article_1 != '' || file_exists($news->article_1) == true)
                            src="{{ URL::asset('uploads/' . @$news->article_1) }}"
                        @else
                            src="{{ URL::asset('images/default-market-news-featured.png') }}"
                        @endif
                        width="100%" class="img-thumbnail" height="auto" alt="{{ @$news->title }}"/></a></div>
                        <div class="text">
                          <h4><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                          <div class="meta d-md-flex mb-2">
                            <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat text-dark">INDUSTRY TALK</a>
                            <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light ml-2"><span class="fa fa-calendar"></span> {{ @$news->created_at->diffForHumans() }}</a>
                          </div>
                        </div>
                    </div>
                  @endif
                @endforeach
              @endif              
          </div>
        </div>
      </div>
      

@php 
    $i=1;
    $ln=0;
    $ln2=0;
@endphp

      <div class="container">
        <div class="row d-flex">
          @if(count(@$getAllNewses))
          @foreach($getAllNewses as $news)
          @if($i==5 || ($i-$ln)==5)
            {{-- Ad Banner small --}}
            <div class="col-md-4 d-flex ftco-animate rounded">
              <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
                <a href="#"><img src="{{ URL::asset('user/images/middle-list-ads.jpg') }}" width="100%" alt="Middle List Ad Banner" class="img-fluid"></a>
              </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry rounded shadow align-self-stretch">
                <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="block-30 rounded" 
                @if(@$news->image != null || @$news->image != '' || file_exists($news->image) == true)
                  style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                @else
                      style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                @endif>
                </a>
                <div class="text px-4 mt-3">
                  <h3 class="heading"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{$news->title}}</a></h3>
                  <div class="mb-5">
                    <div class="float-left"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">Admin</a></div>
                    <div class="float-right"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                  </div>
                </div>
              </div>
            </div>
            
@php
            $ln = $i;
@endphp
          @elseif($i==6 || ($i-$ln2)==5)
            {{-- horizontal Ad --}}
            <div class="col-md-12 d-flex mb-4 ftco-animate">
              <img src="{{ URL::asset('user/images/banner-full-width.jpg')}}" width="100%" height="auto" class="img-fluid rounded" alt="Banner Image">
            </div>
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry rounded shadow align-self-stretch">
                <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="block-30 rounded" 
                @if(@$news->image != null || @$news->image != '' || file_exists($news->image) == true)
                  style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                @else
                      style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                @endif>
                </a>
                <div class="text px-4 mt-3">
                  <h3 class="heading"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{$news->title}}</a></h3>
                  <div class="mb-5">
                    <div class="float-left"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">Admin</a></div>
                    <div class="float-right"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                  </div>
                </div>
              </div>
            </div>
            @php
            $ln2 = $i;
@endphp
          @else
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry rounded shadow align-self-stretch">
                <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="block-30 rounded" 
                @if(@$news->image != null || @$news->image != '' || file_exists($news->image) == true)
                  style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                @else
                      style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                @endif>
                </a>
                <div class="text px-4 mt-3">
                  <h3 class="heading"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{$news->title}}</a></h3>
                  <div class="mb-5">
                    <div class="float-left"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">Admin</a></div>
                    <div class="float-right"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                  </div>
                </div>
              </div>
            </div>
          @endif
@php      $i++;   @endphp
          @endforeach
          @endif        
        </div>    
        </div>
    </section>
@endsection