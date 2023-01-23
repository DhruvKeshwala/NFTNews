@extends('layouts.user.header')

@section('title', 'NFT Markets | Press Release')

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Press Release</span></p>
          </div>
        </div>
      </div>
    </section>

    <div class="container news-banner mb-3">
      @if(@$pressTopBanner->location != null)
          <a href="{{@$pressTopBanner->url}}" class="text-dark" target="_blank"><img
          src="{{ URL::asset('uploads/banner/' . @$pressTopBanner->image) }}" width="100%"
          height="auto" @if($pressTopBanner->banner_image_alt != null || $pressTopBanner->banner_image_alt != '') alt="{{@$pressTopBanner->banner_image_alt}}" @else alt="Top Banner Image" @endif></a>
      @endif
    </div>

    <div class="ftco-section py-5 bg-info-gradient">
      <div class="container">
      <form action="{{ route('user.filterPress') }}" id="press_form" method="GET">
        {{-- @csrf --}}
    	<div class="row my-2">
          
          <div class="col-md-4 d-flex">
            <input type="hidden" name="filterValue" id="filterValue" value="{{@$filterValue}}">
            <a onclick="filterForPress('all')" id="allData" class="page-link py-3 {{ @$filterValue == 'all' || @$filterValue == '' ? 'active' : '' }}">ALL</a> <a onclick="filterForPress('thisWeek')" class="py-3 page-link px-4 mx-2 {{ @$filterValue == 'thisWeek' ? 'active' : '' }}">THIS WEEK</a> <a onclick="filterForPress('thisMonth')" class="py-3 page-link px-4 {{ @$filterValue == 'thisMonth' ? 'active' : '' }}">THIS MONTH</a>
          </div>
          
          <div class="col-md-3 px-0">
          	{{-- <form action="#" class="w-100"> --}}
              <div class="form-group d-flex searchform border mb-0 mx-0 bg-white">
                <input type="text" name="search" class="form-control text-center" placeholder="SEARCH NEWS" value="{{@$search}}">
                <button type="submit" placeholder="" class="form-control w-auto"><span class="fa fa-search text-light"></span></button>
              </div>
            {{-- </form> --}}
          </div>
          
          <div class="col-md-2 text-right pr-0">
          <select class="form-control" id="filternftcategoryValue" name="filternftcategoryValue" onchange="filterForPress('category')">
            <option value="">Select Categories</option>
            {{-- <option value="all" {{ @$filtercategoryId == 'all' || @$filtercategoryId == ''  ? "selected" : "" }}>All</option> --}}
            @foreach($categories as $category)
                <option value="{{base64_encode(@$category->id)}}" {{ base64_encode(@$filtercategoryId) == base64_encode(@$category->id)  ? "selected" : "" }}>{{@$category->name}}</option>
            @endforeach
           </select>
          </div>
      </div>
      </form>
    <br>
    <div>
        {{ $pressReleases->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
    </div>
    </div>
    
   	
    <section class="ftco-section pt-0 pb-4">
      <div class="container">
         
        <div class="row">    
          <div class="col-md-9 px-md-0 px-0">
           <div class="container">
            
            <div class="news-listing ftco-animate">
             @if($pressReleases)
             @foreach($pressReleases as $press)
                <div class="story-wrap p-0 blog-entry d-md-flex align-items-center">
                    <a href="{{ route('user.press_detail', ['id' => @$press->slug]) }}" class="text-dark"><div class="img" 
                      @if($press->image != null || $press->image != '' || file_exists($press->image) == true)
                        style="background-image: url({{ URL::asset('uploads/' . @$press->image)}});"
                      @else
                        style="background-image: url({{ URL::asset('images/default-press-release.png')}});"
                      @endif
                      >
                      </div></a>
                    <div class="text pl-md-3">
                        <div class="meta mb-2">
                        <div><a href="{{ route('user.press_detail', ['id' => @$press->slug]) }}" class="meta-chat">PRESS RELEASE</a></div>
                        <div><a href="{{ route('user.press_detail', ['id' => @$press->slug]) }}"><span class="fa fa-clock"></span> {{ @$press->created_at->diffForHumans() }}</a></div>
                        </div>
                        <h4><a href="{{ route('user.press_detail', ['id' => @$press->slug]) }}" class="text-dark">{{@$press->title}}</a></h4>
                        <p>{{@$press->shortDescription}}</p>
                    </div>
                </div>
            @endforeach
            @endif
             
            </div>
            <!--<a href="#" class="btn d-block btn-light py-2 mt-4">Load More News</a>-->
           </div>
           
           <div>
                {{ $pressReleases->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
            </div>
          </div>
          
          <div class="col-md-3 pl-md-0">
            
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Recommended</h3>
                @if($pressRecommended)
                  @foreach($pressRecommended as $pressRec)
                  <div class="block-21 border p-1 mb-2 d-flex">
                  	<a href="{{ route('user.press_detail', ['id' => @$pressRec->slug]) }}" class="blog-img mr-2" 
                       @if($pressRec->image != null || $pressRec->image != '' || file_exists($pressRec->image) == true)
                        style="background-image: url({{ URL::asset('uploads/' . @$pressRec->image)}});"
                      @else
                        style="background-image: url({{ URL::asset('images/default-press-release-recommended.png')}});"
                      @endif
                      >
                    </a>
                    <div class="text">
                      <h3 class="heading mb-1"><a href="{{ route('user.press_detail', ['id' => @$pressRec->slug]) }}">{{@$pressRec->title}}</a></h3>
                    </div>
                  </div>
                  @endforeach
                @endif
              </div>
            </div>
          	
            @if(@$pressSideBanner->location != null)
              <div class="sidebar-box">
                  <a href="{{$pressSideBanner->url}}" target="_blank"><img src="{{ URL::asset('uploads/banner/' . $pressSideBanner->image) }}"
                          width="100%" height="auto" alt="{{@$pressSideBanner->banner_image_alt}}"></a>
              </div>
            @endif
          	 {{-- <div class="sidebar-box">
                <a href="#"><img src="{{ URL::asset('images/side-banner.png') }}" width="100%" height="auto" alt=""></a>
             </div> --}}
            
            
            </div>
                       
            
          </div>
    	</div>
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
              @if(@$resultFeaturedNews)
                @foreach($resultFeaturedNews as $news)
                  @if($news->is_featurednew == 1)
                    <div class="item text-center">
                      <div class="align-items-center justify-content-center"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"><img 
                        @if($news->article_1 != null || $news->article_1 != '' || file_exists($news->article_1) == true)
                            src="{{ URL::asset('uploads/' . @$news->article_1) }}"
                        @else
                            src="{{ URL::asset('images/default-market-news-featured.png') }}"
                        @endif
                        width="100%" class="img-thumbnail" height="auto" alt="{{@$news->image1_alt}}"/></a></div>
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
  $i = 1;
  $ln = 0;
  $ln2 = 0;
  $sb = 0;
  $bz = 0;
  $sbcount = count($banners_small);
  $bzcount = count($banners_horizontal);
@endphp
    <section class="ftco-section py-5">
        <div class="container">
            <div class="row d-flex">
                @if (count(@$getAllNewses))
                    @foreach ($getAllNewses as $news)
                        @if ($i == 5 || $i - $ln == 5)
                            {{-- Ad Banner small --}}
                            <div class="col-md-4 d-flex ftco-animate rounded">
                                <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
                                    @if($sbcount == 0)
                                    <span><img src="{{ URL::asset('user/images/middle-list-ads.jpg') }}"
                                            width="100%" alt="{{ @$banners_small[$sb]['banner_image_alt'] }}" class="img-fluid"></span>
                                    @else 
                                    <a href="{{@$banners_small[$sb]['url']}}"><img src="{{ URL::asset('uploads/banner/'.@$banners_small[$sb]['image']) }}"
                                            width="100%" alt="{{ @$banners_small[$sb]['banner_image_alt'] }}" class="img-fluid"></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image != null || @$news->image != '' || file_exists($news->image) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{@$news->created_at->diffForHumans()}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $ln = $i;
                                $sb++;
                                if($sb>=$sbcount)
                                {
                                    $sb = 0;
                                }
                            @endphp
                        @elseif($i == 6 || $i - $ln2 == 5)
                            {{-- horizontal Ad --}}
                            <div class="col-md-12 d-flex mb-4 ftco-animate">
                                    @if($bzcount == 0)
                                    <span><img src="{{ URL::asset('user/images/banner-full-width.jpg') }}" width="100%"
                                    height="auto" class="img-fluid rounded" alt="{{@$banners_horizontal[$bz]['banner_image_alt']}}"></span>
                                    @else 
                                    <a href="{{ @$banners_horizontal[$bz]['url'] }}"><img src="{{ URL::asset('uploads/banner/'.@$banners_horizontal[$bz]['image']) }}" width="100%"
                                    height="auto" class="img-fluid rounded" alt="{{@$banners_horizontal[$bz]['banner_image_alt']}}"></a>
                                    @endif
                            </div>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image != null || @$news->image != '' || file_exists($news->image) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ @$news->created_at->diffForHumans()}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $ln2 = $i;
                                $bz++;
                                if($bz >= $bzcount)
                                {
                                    $bz = 0;
                                }
                            @endphp
                        @else
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image != null || @$news->image != '' || file_exists($news->image) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ @$news->created_at->diffForHumans()}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php      $i++;   @endphp
                    @endforeach
                @endif
            </div>

            <a href="{{ route('user.news') }}" class="btn d-block btn-outline-light py-2 mt-4">Load More Articles</a>

        </div>
    </section>
@endsection