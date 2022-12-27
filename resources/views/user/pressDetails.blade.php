@extends('layouts.user.header')

@section('title', 'NFT Markets | Press Release')

@section('content')
<section class="hero-wrap hero-wrap-2">
    <div class="container">
    <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate">
        <p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Press Release Detail</span></p>
        </div>
    </div>
    </div>
</section>

<section class="ftco-section py-5">
    <div class="container">
        <div class="row">
        
        <div class="col-md-9 px-md-0 px-0">
        <div class="container">
        
        <div class="news-listing ftco-animate">
            <div class="news-wrap p-0 align-items-center">
            
            <div class="w-100 pb-2">
            <a href="#" class="text-dark"><img src="{{ URL::asset('uploads/' . @$pressDetail->article_2)}}" width="100%" alt="" height="auto" class="img"></a>
            </div>
            <div class="row">
                <div class="col-md-6"><a href="#" class="text-light">INDUSTRY TALK</a> <a href="#" class="ml-4 text-light"><span class="fa fa-calendar"></span> {{ $pressDetail ? $pressDetail->created_at->diffForHumans() : '-' }}</a></div>
                <div class="col-md-6 text-right">
                <!-- AddToAny BEGIN -->
                <div class="a2a_kit a2a_kit_size_32 float-right a2a_default_style">
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
            
                <h4><a href="#" class="text-dark">{{ @$pressDetail->title }}</a></h4>
                <div class="text-justify">{!! @$pressDetail->fullDescription !!}</div>
            </div>
            </div>
            
        </div>
        <!--<a href="#" class="btn d-block btn-light py-2 mt-4">Load More News</a>-->
        </div>
        </div>
        
        <div class="col-md-3 pl-md-0">
        
        <div class="sidebar-box ftco-animate">
            <div class="categories">
            <h3>Browse Categories</h3>
            <li class="pl-2"><a href="#">Art </a></li>
            <li class="pl-2"><a href="#">Collectibles </a></li>
            <li class="pl-2"><a href="#">Education </a></li>
            <li class="pl-2"><a href="#">Gaming </a></li>
            <li class="pl-2"><a href="#">Metavers </a></li>
            <li class="pl-2"><a href="#">Music </a></li>
            <li class="pl-2"><a href="#">Web 3.0 </a></li>
            </div>
        </div>
        
            <div class="sidebar-box">
            <a href="#" target="_blank"><img src="{{ URL::asset('user/images/side-banner.png')}}" width="100%" height="auto" alt=""></a>
            </div>
            
            <div class="sidebar-box ftco-animate fadeInUp ftco-animated border bg-info-gradient p-3">
            <h5 style="background-image:url(images/envelope-icon.png); padding-left: 35px; background-repeat:no-repeat;">SUBSCRIBE NOW</h5>
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
@endsection