@extends('layouts.user.header')

@section('title', 'NFT Markets | News')

@section('content')
<section class="hero-wrap hero-wrap-2">
    <div class="container">
    <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate">
        <p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>News Detail</span></p>
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
            <a href="#" class="text-dark"><img src="{{ URL::asset('uploads/' . @$newsDetail->article_2)}}" width="100%" alt="" height="auto" class="img"></a>
            </div>
            <div class="row">
                <div class="col-md-6"><a href="#" class="text-light">INDUSTRY TALK</a> <a href="#" class="ml-4 text-light"><span class="fa fa-calendar"></span> {{ $newsDetail ? $newsDetail->created_at->diffForHumans() : '-' }}</a></div>
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
            
                <h4><a href="#" class="text-dark">{{ @$newsDetail->title }}</a></h4>
                <div class="text-justify">{!! @$newsDetail->fullDescription !!}</div>
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
    
<section class="ftco-section bg-light mb-5 py-5">
    <div class="container mb-5">
    <div class="row ftco-animate">
        <div class="col-md-12 mx-auto mb-3 heading-section heading-section-white text-left ftco-animate">
        <h2 class="mb-0 py-1">MARKET NEWS <span class="text-light">|</span> FEATURED</h2>
        </div>
    </div>
    <div class="ftco-animate">
        <div class="mktnws-slider owl-carousel ftco-owl">
            <div class="item text-center">
            <div class="align-items-center justify-content-center"><a href="#"><img src="{{ URL::asset('user/images/markt-img01.png')}}" width="100%" class="img-thumbnail" height="auto" alt=""/></a></div>
                <div class="text">
                <h4><a href="#" class="text-dark">FTX Bitcoin stash worth same as Mt. Gox 840K BTC before hack</a></h4>
                <div class="meta d-md-flex mb-2">
                    <a href="#" class="meta-chat text-dark">INDUSTRY TALK</a>
                    <a href="#" class="text-light ml-2"><span class="fa fa-calendar"></span> 3 hours ago</a>
                </div>
                </div>
            </div>
            <div class="item text-center">
            <div class="align-items-center justify-content-center"><a href="#"><img src="{{ URL::asset('user/images/markt-img02.png')}}" width="100%" class="img-thumbnail" height="auto" alt=""/></a></div>
                <div class="text">
                <h4><a href="#" class="text-dark">Bitcoin miners send less BTC to exchanges since 2020 halving despite FTX</a></h4>
                <div class="meta d-md-flex mb-2">
                    <a href="#" class="meta-chat text-dark">INDUSTRY TALK</a>
                    <a href="#" class="text-light ml-2"><span class="fa fa-calendar"></span> 3 hours ago</a>
                </div>
                </div>
            </div>
            <div class="item text-center">
            <div class="align-items-center justify-content-center"><a href="#"><img src="{{ URL::asset('user/images/markt-img03.png')}}" width="100%" class="img-thumbnail" height="auto" alt=""/></a></div>
                <div class="text">
                <h4><a href="#" class="text-dark">Solana entities sold 50M tokens to FTX — How long will SOL price suffer?</a></h4>
                <div class="meta d-md-flex mb-2">
                    <a href="#" class="meta-chat text-dark">INDUSTRY TALK</a>
                    <a href="#" class="text-light ml-2"><span class="fa fa-calendar"></span> 3 hours ago</a>
                </div>
                </div>
            </div>
            <div class="item">
                <div class="align-items-center justify-content-center"><a href="#"><img src="{{ URL::asset('user/images/markt-img04.png')}}" width="100%" class="img-thumbnail" alt=""/></a></div>
                <div class="text">
                <h4><a href="#" class="text-dark">Bitcoin price hits $17K on US PPI as trader warns of ‘final capitulation’ </a></h4>
                <div class="meta d-md-flex mb-2">
                    <a href="#" class="meta-chat text-dark">INDUSTRY TALK</a>
                    <a href="#" class="text-light ml-2"><span class="fa fa-calendar"></span> 3 hours ago</a>
                </div>
                </div>
            </div>
            
            <div class="item">
            <div class="align-items-center justify-content-center"><a href="#"><img src="{{ URL::asset('user/images/markt-img01.png')}}" width="100%" class="img-thumbnail" alt=""/></a></div>
            <div class="text">
                <h4><a href="#" class="text-dark">FTX Bitcoin stash worth same as Mt. Gox 840K BTC before hack</a></h4>
                <div class="meta d-md-flex mb-2">
                    <a href="#" class="meta-chat text-dark">INDUSTRY TALK</a>
                    <a href="#" class="text-light ml-2"><span class="fa fa-calendar"></span> 3 hours ago</a>
                </div>
            </div>
            </div>
            
            <div class="item">
            <div class="align-items-center justify-content-center"><a href="#"><img src="{{ URL::asset('user/images/markt-img02.png')}}" width="100%" class="img-thumbnail" alt=""/></a></div>
                <div class="text">
                <h4><a href="#" class="text-dark">Bitcoin miners send less BTC to exchanges since 2020 halving despite FTX</a></h4>
                <div class="meta d-md-flex mb-2">
                    <a href="#" class="meta-chat text-dark">INDUSTRY TALK</a>
                    <a href="#" class="text-light ml-2"><span class="fa fa-calendar"></span> 3 hours ago</a>
                </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    <div class="container">
    <div class="row d-flex">
        <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry rounded shadow align-self-stretch">
            <a href="#" class="block-30 rounded" style="background-image: url({{ URL::asset('user/images/markt-img01.png')}});">
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
            <a href="#" class="block-30 rounded" style="background-image: url({{ URL::asset('user/images/markt-img02.png')}});">
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
            <a href="#" class="block-30 rounded" style="background-image: url({{ URL::asset('user/images/markt-img03.png')}});">
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
            <a href="#" class="block-30 rounded" style="background-image: url({{ URL::asset('user/images/markt-img04.png')}});">
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
            <a href="#" target="_blank"><img src="{{ URL::asset('user/images/middle-list-ads.jpg')}}" width="100%" alt="" class="img-fluid"></a>
        </div>
        </div>
        <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry rounded shadow align-self-stretch">
            <a href="#" class="block-30 rounded" style="background-image: url({{ URL::asset('user/images/markt-img02.png')}});">
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