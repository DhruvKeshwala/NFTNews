@extends('layouts.user.header')

@section('title', 'NFT Markets | Latest News')

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
        <p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Latest News</span></p>
      </div>
    </div>
  </div>
</section>

<div class="container news-banner mb-3">
  {{-- @if(@$newsTopBanner->location != null) --}}
      <a href="{{@$newsTopBanner->url}}" class="text-dark" target="_blank"><img
      src="{{ URL::asset('uploads/banner/' . @$newsTopBanner->image) }}" width="100%"
      height="auto" alt="Top Banner Image"></a>
  {{-- @endif --}}
</div>

  
    <div class="ftco-section py-5 bg-info-gradient">
      <div class="container">
    	<form action="{{ route('user.filter_news') }}" method="get" class="col-md-12 mr-auto pl-0 pr-2">
          {{-- @csrf --}}
          <div class="form-group d-flex searchform border mb-0 mx-0 bg-white">
            <input type="text" name="filterNewsTitle" class="form-control text-center" placeholder="SEARCH NEWS" value="<?php 
                if (!empty($_REQUEST['filterNewsTitle'])) {
                    $q = $_REQUEST['filterNewsTitle'];
                    echo $q;
                }  
                if (!empty($_REQUEST['homeSearch'])) {
                    $q = $_REQUEST['homeSearch'];
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
          
          <div class="col-md-9 px-md-0 px-0">
           <div class="container">
            <div class="mb-3 ftco-animate">
            <div class="heading-section">
             <h2 class="mb-0 py-1">LATEST NEWS</h2>
            </div>
           </div>
           	
            <div class="news-listing ftco-animate">
            <div class="Newses">
            {{ $allNews->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
              @if(@$allNews)
                  @foreach($allNews as $news)
                      <div class="story-wrap p-0 blog-entry d-md-flex align-items-center">
                      <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark"><div class="img" 
                        @if($news->image != null || $news->image != '' || file_exists($news->image) == true)
                          style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"
                        @else
                          style="background-image: url({{ URL::asset('images/default-listing-news.png') }});" 
                        @endif></div></a>
                      <div class="text pl-md-3">
                          <div class="meta mb-2">
                          <div><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">INDUSTRY TALK</a></div>
                          <div><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"><span class="fa fa-clock"></span>{{ @$news->created_at->diffForHumans() }}</a></div>
                          </div>
                          <h4><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                          <p>{{@$news->shortDescription}}</p>
                      </div>
                      </div>
                  @endforeach
              @else
                  <p>No Data Found..</p>
              @endif
            {{ $allNews->appends(Request::except('page'))->links('vendor.pagination.userCustom') }} 
          </div>  
          </div>
            <!--<a href="#" class="btn d-block btn-light py-2 mt-4">Load More News</a>-->
           
           </div>
           </div>
           <div class="col-md-3 pl-md-0">
            
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Browse Categories</h3>
                {{-- <li class="pl-2"><a href="#">Art </a></li>
                <li class="pl-2"><a href="#">Collectibles </a></li>
                <li class="pl-2"><a href="#">Education </a></li>
                <li class="pl-2"><a href="#">Gaming </a></li>
                <li class="pl-2"><a href="#">Metavers </a></li>
                <li class="pl-2"><a href="#">Music </a></li>
                <li class="pl-2"><a href="#">Web 3.0 </a></li> --}}
                {{-- <li><a class="pl-2 tagLink" onclick="filterCategory(0)">ALL</a></li> --}}
                <li><a class="pl-2 tagLink" href="{{ route('userFilterCategoryNews', ['id' => 'All']) }}">All</a></li>
                @if(@$categories)
                  @foreach($categories as $category)
                    {{-- <li><a class='pl-2 tagLink' onclick="filterCategory({{@$category->id}})" id="categoryId">{{@$category->name}}</a></li> --}}
                    <li><a class='pl-2 tagLink' href="{{ route('userFilterCategoryNews', ['id' => @$category->slug])}}" id="categoryId">{{@$category->name}}</a></li>
                  @endforeach
                @endif
              </div>
            </div>
          	
            @if(@$innerSideBanner->location != null)
              <div class="sidebar-box">
                  <a href="{{@$innerSideBanner->url}}" target="_blank"><img src="{{ URL::asset('uploads/banner/' . @$innerSideBanner->image) }}"
                          width="100%" height="auto" alt="{{@$innerSideBanner->banner_image_alt}}"></a>
              </div>
            @endif
          	 {{-- <div class="sidebar-box">
                <a href="#"><img src="images/side-banner.png" width="100%" height="auto" alt=""></a>
             </div> --}}
             
             <div class="sidebar-box ftco-animate fadeInUp ftco-animated border bg-info-gradient p-3">
                <h5 style="background-image:url(images/envelope-icon.png); padding: 5px 0px 5px 35px; background-repeat:no-repeat;">SUBSCRIBE NOW</h5>
                <p>Sign up for free newsletters and get more NFT Markets delivered to your inbox</p>
                <form action="{{ route('user.subscribe') }}" class="form-consultation">
                  <div class="form-group">
                    <button type="submit" class="btn-outline-light-gradient px-3 btn border py-1">SIGN UP NOW</button>
                  </div>
                  <div class="form-group">
                    <small>Get this delivered to your inbox, and more info about our products and services. </small>
                  </div>
                </form>
              </div>                
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
                        width="100%" class="img-thumbnail" height="auto"
                        @if(@$news->image1_alt != '' && @$news->image1_alt != null)
                        alt="{{@$news->image1_alt}}"
                        @else 
                        alt="{{@$news->title}}"
                        @endif/></a></div>
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

      <div class="container">
        <div class="row d-flex">
          @if(count(@$getAllNewses))
          @foreach ($getAllNewses as $news)
                        @if ($i == 5 || $i - $ln == 5)
                            {{-- Ad Banner small --}}
                            <div class="col-md-4 d-flex ftco-animate rounded">
                                <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
                                    @if($sbcount == 0)
                                    <a href="{{ @$banners_small[$sb]['url'] }}"><img src="{{ URL::asset('user/images/middle-list-ads.jpg') }}"
                                            width="100%" alt="{{@$banners_small[$sb]['banner_image_alt']}}" class="img-fluid"></a>
                                    @else 
                                    <a href="{{@$banners_small[$sb]['url']}}"><img src="{{ URL::asset('uploads/banner/'.@$banners_small[$sb]['image']) }}"
                                            width="100%" 
                                            @if(@$banners_small[$sb]['banner_image_alt'] != '' && @$banners_small[$sb]['banner_image_alt'] != null)
                                            alt="{{@$banners_small[$sb]['banner_image_alt']}}"
                                            @else 
                                            alt="Banner"
                                            @endif
                                            class="img-fluid"></a>
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
                                                    class="text-light"><span class="fa fa-calendar"></span> 3 hours
                                                    ago</a></div>
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
                                    <a href="{{ @$banners_horizontal[$bz]['url'] }}"><img src="{{ URL::asset('user/images/banner-full-width.jpg') }}" width="100%"
                                    height="auto" class="img-fluid rounded" alt="{{ @$banners_horizontal[$bz]['banner_image_alt'] }}"></a>
                                    @else 
                                    <a href="{{ @$banners_horizontal[$bz]['url'] }}"><img src="{{ URL::asset('uploads/banner/'.@$banners_horizontal[$bz]['image']) }}" width="100%"
                                    height="auto" class="img-fluid rounded" 
                                    @if(@$banners_horizontal[$bz]['banner_image_alt'] != '' && @$banners_horizontal[$sb]['banner_image_alt'] != null)
                                    alt="{{@$banners_horizontal[$bz]['banner_image_alt']}}"
                                    @else 
                                    alt="Banner Full Width"
                                    @endif
                                    ></a>
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
                                                    class="text-light"><span class="fa fa-calendar"></span> 3 hours
                                                    ago</a></div>
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
                                                    class="text-light"><span class="fa fa-calendar"></span> 3 hours
                                                    ago</a></div>
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


@section('script')
<script>
$(document).ready(function() {
    $('.tagLink').click(function() {
        $('.tagLink.active').removeClass("active");
        $(this).addClass("active");
    });
});

function filterCategory(value){
    var categoryId = parseInt(value);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('userFilterCategoryNews') }}",
        type: "GET",
        data: {
            categoryId: categoryId,
        },
        dataType : 'html',
        success: function(allNews) {
          console.log('success'); // code here paste
          $('.Newses').html(allNews);
        },
        error: function(xhr, status, error) {}
    });
  }
</script>
@endsection