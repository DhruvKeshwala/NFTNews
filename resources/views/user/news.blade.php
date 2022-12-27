@extends('layouts.user.header')

@section('title', 'NFT Markets | News')

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
        <p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>News</span></p>
      </div>
    </div>
  </div>
</section>
    
  
    <div class="ftco-section py-5 bg-info-gradient">
      <div class="container">
    	<form action="{{ route('user.filter_news') }}" method="get" class="col-md-12 mr-auto pl-0 pr-2">
          @csrf
          <div class="form-group d-flex searchform border mb-0 mx-0 bg-white">
            <input type="text" name="filterNewsTitle" class="form-control text-center" placeholder="Search news" value="<?php 
                if (!empty($_GET['filterNewsTitle'])) {
                    $q = $_GET['filterNewsTitle'];
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
             <h2 class="mb-0 py-1">NEWS</h2>
            </div>
           </div>
           	
            <div class="news-listing ftco-animate">
            {{ $allNews->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
            
            <div class="allNews"></div>
            <div class="Newses">
              @if(@$allNews)
                  @foreach($allNews as $news)
                      <div class="story-wrap p-0 blog-entry d-md-flex align-items-center">
                      <a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="text-dark"><div class="img" style="background-image: url({{ URL::asset('uploads/' . @$news->image) }});"></div></a>
                      <div class="text pl-md-3">
                          <div class="meta mb-2">
                          <div><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="meta-chat">INDUSTRY TALK</a></div>
                          <div><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}"><span class="fa fa-clock"></span>{{ @$news->created_at->diffForHumans() }}</a></div>
                          </div>
                          <h4><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                          <p>{{@$news->shortDescription}}</p>
                      </div>
                      </div>
                  @endforeach
              @else
                  <p>No Data Found..</p>
              @endif
            </div>
            {{ $allNews->appends(Request::except('page'))->links('vendor.pagination.userCustom') }} 
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
                <li><a class="pl-2 tagLink" onclick="filterCategory(0)">ALL</a></li>
                @if(@$categories)
                  @foreach($categories as $category)
                    <li><a class='pl-2 tagLink' onclick="filterCategory({{@$category->id}})" id="categoryId">{{@$category->name}}</a></li>
                  @endforeach
                @endif
              </div>
            </div>
          	
          	 <div class="sidebar-box">
                <a href="#"><img src="images/side-banner.png" width="100%" height="auto" alt=""></a>
             </div>
             
             <div class="sidebar-box ftco-animate fadeInUp ftco-animated border bg-info-gradient p-3">
                <h5 style="background-image:url(images/envelope-icon.png); padding: 5px 0px 5px 35px; background-repeat:no-repeat;">SUBSCRIBE NOW</h5>
                <p>Sign up for free newsletters and get more NFT Markets delivered to your inbox</p>
                <form action="#" class="form-consultation">
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
                      <div class="align-items-center justify-content-center"><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}"><img src="{{URL::asset('uploads/' . @$news->article_1)}}" width="100%" class="img-thumbnail" height="auto" alt=""/></a></div>
                        <div class="text">
                          <h4><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                          <div class="meta d-md-flex mb-2">
                            <a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="meta-chat text-dark">INDUSTRY TALK</a>
                            <a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="text-light ml-2"><span class="fa fa-calendar"></span> {{ @$news->created_at->diffForHumans() }}</a>
                          </div>
                        </div>
                    </div>
                  @endif
                @endforeach
              @endif              
          </div>
        </div>
      </div>
      
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry rounded shadow align-self-stretch">
              <a href="#" class="block-30 rounded" style="background-image: url('images/markt-img01.png');">
              </a>
              <div class="text px-4 mt-3">
              	<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="mb-5">
                  <div class="float-left"><a href="#" class="meta-chat">Admin</a></div>
                  <div class="float-right"><a href="#" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry rounded shadow align-self-stretch">
              <a href="#" class="block-30 rounded" style="background-image: url('images/markt-img02.png');">
              </a>
              <div class="text px-4 mt-3">
              	<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="mb-5">
                  <div class="float-left"><a href="#" class="meta-chat">Admin</a></div>
                  <div class="float-right"><a href="#" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry rounded shadow align-self-stretch">
              <a href="#" class="block-30 rounded" style="background-image: url('images/markt-img03.png');">
              </a>
              <div class="text px-4 mt-3">
              	<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="mb-5">
                  <div class="float-left"><a href="#" class="meta-chat">Admin</a></div>
                  <div class="float-right"><a href="#" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry rounded shadow align-self-stretch">
              <a href="#" class="block-30 rounded" style="background-image: url('images/markt-img04.png');">
              </a>
              <div class="text px-4 mt-3">
              	<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="mb-5">
                  <div class="float-left"><a href="#" class="meta-chat">Admin</a></div>
                  <div class="float-right"><a href="#" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate rounded">
            <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
              <a href="#"><img src="images/middle-list-ads.jpg" width="100%" alt="" class="img-fluid"></a>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry rounded shadow align-self-stretch">
              <a href="#" class="block-30 rounded" style="background-image: url('images/markt-img02.png');">
              </a>
              <div class="text px-4 mt-3">
              	<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="mb-5">
                  <div class="float-left"><a href="#" class="meta-chat">Admin</a></div>
                  <div class="float-right"><a href="#" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                </div>
              </div>
            </div>
          </div>
          
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
        url: "{{ url('userFilterCategory') }}",
        type: "GET",
        data: {
            categoryId: categoryId,
        },
        dataType : 'html',
        success: function(allNews) {
          console.log('success'); // code here paste
          $('.Newses').html(allNews);
          $('.allNews').hide();
        },
        error: function(xhr, status, error) {}
    });
  }
</script>
@endsection