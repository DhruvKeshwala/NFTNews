@php
$settings = \App\Models\Settings::first();
@endphp

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="{{ URL::asset('assets/user/css/animate.css') }}">
    
    <link rel="stylesheet" href="{{ URL::asset('assets/user/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/user/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/user/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('assets/user/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/user/css/style.css')}}">
    
    <link rel="stylesheet" href="{{ URL::asset('assets/user/css/flexslider.css')}}" type="text/css" media="screen" />
    
    <meta name="description" content="{{(@$newsDetail->description != null) ? @$newsDetail->description : ((@$page->description != null) ? @$page->description : ((@$nftDropDetail != null) ? @$nftDropDetail->description : ((@$videoDetail->description != null) ? @$videoDetail->description : ((@$cryptoDetail->description != null) ? @$cryptoDetail->description : ((@$pressDetail->description != null) ? @$pressDetail->description : 'Meta Description')))))  }}">

    <meta name="keywords" content="{{(@$newsDetail->keywords != null) ? @$newsDetail->keywords : ((@$page->keywords != null) ? @$page->keywords : ((@$nftDropDetail != null) ? @$nftDropDetail->keywords : ((@$videoDetail->keywords != null) ? @$videoDetail->keywords : ((@$cryptoDetail->keywords != null) ? @$cryptoDetail->keywords : ((@$pressDetail->keywords != null) ? @$pressDetail->keywords : 'Meta Keywords')))))  }}">

    <meta property="og:type" content="website" >

    <meta property="og:locale" content="en_in" >

    <meta property="og:url" content="{{URL::current()}}" >

    <meta property="og:title" content="{{(@$newsDetail->metaTitle != null) ? @$newsDetail->metaTitle : ((@$page->metaTitle != null) ? @$page->metaTitle : ((@$nftDropDetail != null) ? @$nftDropDetail->metaTitle : ((@$videoDetail->metaTitle != null) ? @$videoDetail->metaTitle : ((@$cryptoDetail->metaTitle != null) ? @$cryptoDetail->metaTitle : ((@$pressDetail->metaTitle != null) ? @$pressDetail->metaTitle : 'Meta Title')))))  }}" >

    <meta property="og:description" content="{{(@$newsDetail->description != null) ? @$newsDetail->description : ((@$page->description != null) ? @$page->description : ((@$nftDropDetail != null) ? @$nftDropDetail->description : ((@$videoDetail->description != null) ? @$videoDetail->description : ((@$cryptoDetail->description != null) ? @$cryptoDetail->description : ((@$pressDetail->description != null) ? @$pressDetail->description : 'Meta Description')))))  }}" >

    <meta property="og:image" content="{{URL::asset('images/logo.png')}}" >

    <meta property="og:image:type" content="image/jpg" >

    <meta property="og:site_name" content="NFT Markets" >
    @if(@$settings->twitter != null || @$settings->twitter != '')
      <meta property="og:see_also" content="{{$settings->twitter}}" >
    @endif
    @if(@$settings->facebook != null || @$settings->facebook != '')
      <meta property="og:see_also" content="{{$settings->facebook}}" >
    @endif
    <meta name="twitter:card" content="summary">

    <meta name="twitter:site" content="[TWITTER_USERNAME_WITH_@]">
    <meta name="twitter:title" content="{{(@$newsDetail->metaTitle != null) ? @$newsDetail->metaTitle : ((@$page->metaTitle != null) ? @$page->metaTitle : ((@$nftDropDetail != null) ? @$nftDropDetail->metaTitle : ((@$videoDetail->metaTitle != null) ? @$videoDetail->metaTitle : ((@$cryptoDetail->metaTitle != null) ? @$cryptoDetail->metaTitle : ((@$pressDetail->metaTitle != null) ? @$pressDetail->metaTitle : 'Meta Title')))))  }}" >

    <meta name="twitter:description" content="{{(@$newsDetail->description != null) ? @$newsDetail->description : ((@$page->description != null) ? @$page->description : ((@$nftDropDetail != null) ? @$nftDropDetail->description : ((@$videoDetail->description != null) ? @$videoDetail->description : ((@$cryptoDetail->description != null) ? @$cryptoDetail->description : ((@$pressDetail->description != null) ? @$pressDetail->description : 'Meta Description')))))  }}" >

    <meta name="twitter:image" content="{{URL::asset('images/Twitter_Logo.png')}}" >

    {!! $settings->googleAnalytics !!}
  </head>
  <body>

  <div class="bg-info-gradient-2 pt-1 pb-3">
    <div class="wrap mb-2">
        <div class="container">
            <div class="d-flex justify-content-between">
                    <div class="subnav text-right ml-auto mr-4">
                        <a href="{{route('user.services')}}">SERVICES</a> <a href="{{route('user.pressRelease')}}">PRESS</a> <a href="{{route('user.featuredNews')}}">FEATURED</a> <a href="{{route('user.advertise')}}">ADVERTISE</a> <a href="{{route('user.guide')}}">GUIDES</a> <a href="{{ route('user.education') }}">EDUCATION</a> <a href="{{route('user.partners')}}">PARTNERS</a> <a href="{{route('user.contact')}}">CONTACT</a>
                    </div>
                    <div class="d-flex justify-content-end">
                       <div class="search-container">
                          <form action="{{route('user.filter_news')}}" method="post">
                            @csrf
                            <input class="search expandright" id="searchright" type="search" name="homeSearch" placeholder="Search" value="<?php if (!empty($_POST['homeSearch'])) {
                    $q = $_POST['homeSearch'];
                    echo $q;
                }?>">
                            <label class="button searchbutton" for="searchright"><span class="mglass">&#9906;</span></label>
                          </form>
                       </div>
                       <div class="py-1">
                          <select class="w-50 border-0 text-light bg-transparent" id="lang" name="lang">
                                <option value="">EN</option>
                                <option value="">Deutsch</option>
                                <option value="">Français</option>
                                <option value="">Русский</option>
                                <option value="">Türkçe</option>
                                <option value="">Nederlands</option>
                                <option value="">Italiano</option>
                                <option value="">العربية</option>
                                <option value="">فارسی</option>
                                <option value="">中文</option>
                                <option value="">Español</option>
                                <option value="">Português</option>
                           </select>
                       </div>
                    </div>
            </div>
        </div>
    </div>

   	<nav class="navbar navbar-expand-lg navbar-dark pb-2 ftco_navbar ftco-navbar-light" id="ftco-navbar">
         
     <div class="container">
       <a class="navbar-brand" href="{{route('user.home')}}"><img src="{{ URL::asset('assets/user/images/nft-logo.svg')}}" alt="NFTNews" width="210" height="35" alt=""></a>
        <div class="searchform order-sm-start order-lg-last">
          <a href="#" class="btn text-uppercase btn-outline-light-gradient border pt-2 px-3 pb-1" data-toggle="modal" data-target="#myModalSubscribe">Subscribe</a>
          @if (@$settings->twitter)
            <a href="{{ @$settings->twitter }}" target="_blank" class="btn-lg pt-3 pb-1" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter text-light"></i></a>
          @endif
        </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
          </button>
          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
             <li class="nav-item {{ Request::segment(1) == 'news' ? 'active' : ''}}"><a href="{{route('user.news')}}" class="nav-link">Latest News</a></li>
             <li class="nav-item {{ Request::segment(1) == 'markets' ? 'active' : ''}}"><a href="{{route('user.markets')}}" class="nav-link">Markets</a></li>
             <li class="nav-item {{ Request::segment(1) == 'listNFTDrop' ? 'active' : ''}}"><a href="{{route('user.list_nftDrops')}}" class="nav-link">NFT Drops</a></li>
             <li class="nav-item {{ Request::segment(1) == 'videos' ? 'active' : ''}}"><a href="{{route('user.videos')}}" class="nav-link">Videos</a></li>
             <li class="nav-item {{ Request::segment(1) == 'cryptoJournals' ? 'active' : ''}}"><a href="{{route('user.cryptoJournals')}}" class="nav-link">Crypto Journal</a></li>
             <li class="nav-item"><a href="https://www.thenftmarkets.com/" target="_blank" class="nav-link">MarketPlace</a></li>  
            </ul>
          </div>
         </div>
            
	  </nav>
      <!-- END nav -->
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @yield('content')
    {{-- Add contents here --}}
    
  
    <!-- Modal -->
    <div class="modal fade" id="myModalSubscribe" role="dialog" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">  
          <!-- Modal content-->     
          <div class="modal-content">

            <div class="modal-body">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <div class="row py-4">
                <div class="col-md-6"><img src="{{ URL::asset('user/images/newsletter-popup-image-1.jpg') }}" alt="NFTNews" width="100%" height="auto" alt=""></div>
                <div class="col-md-6">
                    <h5 class="modal-title">THE MOST POPULAR</h5>
                    <h3 class="modal-title mb-3">NFTs IN THE MARKET</h3>
                    
                    <p>Looking for the latest NFTs collection that will launch soon? You're in the right place. Stay upto date on the latest NFTs trends, giveaways &amp; competitions!</p>
                    
                    <!-- SUBSCRIBE FORM -->
                    <form action="{{ route('sendMailForSubscribe') }}" method="POST" id="subscribe_form" class="form-consultation">
                      @csrf
                      <div class="form-group">
                        <input type="text" name="email" id="subscribeemail" class="form-control" placeholder="Email">
                        <div id="subscribeemailError"></div>
                        <input type="hidden" name="subscriberId" value="5050">
                      </div>
                    </form>
                    <button type="submit" onclick="submitSubscribeForm()" class="btn btn-primary mb-2 bt-mdl">
                       Subscribe <i class="fa fa-paper-plane"></i>
                    </button>
                    
                    <h5>“*Dont forget to follow us on our socials, Stay connected!"</h5>
                    <p>By entering your email, you agree to our <a href="{{route('user.termsOfService')}}">Terms of Service</a> and <a href="{{route('user.privacyPolicy')}}">Privacy Policy</a>.</p>
                    
               </div>
             </div>
              
            </div>
            
          </div>
          
        </div>
       </div>

    <footer class="footer">
      <div class="container">
      	<div class="row border-top pt-3 pb-2 border-bottom px-3">
          <div class="col-md-4 align-items-center text-md-left text-center mb-4 mb-md-2">
            <img src="{{ URL::asset('images/logo.png')}}" alt="NFTNews" width="210" height="35" alt="" />
          </div>
          <div class="col-md-4 text-center pt-md-1 text-light">ADVERTISE WITH US? <a href="{{route('user.contact')}}" class="btn-outline-light-gradient text-light btn border py-1 align-middle ml-md-5 btn-sm px-3">ENQUIRE</a></div>
          <div class="col-md-4 text-md-right text-center">
            {{-- <ul class="ftco-social m-0 pl-0">
              <li class="ftco-animate fadeInUp ftco-animated mt-1 border-left pl-4"><a href="https://www.twitter.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa fa-twitter text-light fa-2x"></span></a></li>
            </ul> --}}
            <ul class="ftco-footer-social m-0">
              @if (@$settings->facebook)
                <li class="ftco-animate"><a href="{{ @$settings->facebook }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="fa fa-facebook"></span></a></li>
              @endif
              @if (@$settings->twitter)
                <li class="ftco-animate"><a href="{{ @$settings->twitter }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa fa-twitter"></span></a></li>
              @endif
              @if (@$settings->instagram)
                <li class="ftco-animate"><a href="{{ @$settings->instagram }}" data-toggle="tooltip" target="_blank" data-placement="top" title="Instagram"><span class="fa fa-instagram"></span></a></li>
              @endif
              @if (@$settings->linkedin)
                <li class="ftco-animate"><a href="{{ @$settings->linkedin }}" target="_blank" data-toggle="tooltip" data-placement="top" title="LinkedIn"><span class="fa fa-linkedin"></span></a></li>
              @endif
              @if (@$settings->youtube)
                <li class="ftco-animate"><a href="{{ @$settings->youtube }}" data-toggle="tooltip" target="_blank" data-placement="top" title="youtube"><span class="fa fa-youtube-play"></span></a></li>
              @endif
            </ul>
          </div>
		</div>
        
        <div class="row py-5">
        	<div class="col-md-9 row">
              <div class="col-md-3">
            	<ul class="list-unstyled text-dark">
                	<li><a href="{{route('user.news')}}" class="nav-link">Latest News</a></li>
                    <li><a href="{{route('user.markets')}}" class="nav-link">Markets News</a></li>
                    <li><a href="{{route('user.featuredNews')}}" class="nav-link">Featured</a></li>
                    <li><a href="{{route('user.list_nftDrops')}}" class="nav-link">NFT Drops</a></li>
                    <li><a href="{{route('user.videos')}}" class="nav-link">Videos</a></li>
                    <li><a href="{{route('user.guide')}}" class="nav-link">Help</a></li>
                </ul>
               </div>
               <div class="col-md-3">
                <ul class="list-unstyled">
                	<li><a href="{{route('user.pressRelease')}}" class="nav-link">Press Releases</a></li>
                    <li><a href="{{route('user.cryptoJournals')}}" class="nav-link">Weekly Journal</a></li>
                    <li><a href="https://www.thenftmarkets.com/" target="_blank" class="nav-link">Marketplace</a></li>
                    <li><a href="{{route('user.about')}}" class="nav-link">About Us</a></li>
                    <li><a href="{{route('user.services')}}" class="nav-link">Our Services</a></li>
                    <li><a href="{{route('user.advertise')}}" class="nav-link">Advertise</a></li>
                </ul>
               </div>
               <div class="col-md-3">
                <ul class="list-unstyled">
                	<li><a href="{{route('user.guide')}}" class="nav-link">Guides &amp; Support</a></li>
                    <li><a href="{{route('user.education')}}" class="nav-link">Education Academy</a></li>
                    <li><a href="{{route('user.partners')}}" class="nav-link">Our Partners</a></li>
                    <li><a href="{{route('user.mediaEnquiries')}}" class="nav-link">Media Enquiries</a></li>
                    <li><a href="{{route('user.investmentAndFunding')}}" class="nav-link">Investment &amp; Funding</a></li>
                    <li><a href="{{route('user.careers')}}" class="nav-link">Careers</a></li>
                </ul>
               </div>
               <div class="col-md-3">
               	<h2 class="footer-heading mb-0 py-2">NEWSLETTER</h2>
                <p>Keep upto date with all the latest news &amp; insights</p>
                <a href="{{route('user.subscribe')}}" class="btn-outline-light-gradient btn border py-2 btn-sm px-3">SUBSCRIBE</a>
                
               </div>
            </div>
            <div class="col-md-3">
                <h4 class="footer-heading mb-0 py-2">ARTICLES &amp; LISTINGS</h4>
                <p>If you wish to list your project or article then contact us</p>
                <a href="{{route('user.contact')}}" class="btn-primary btn btn-sm py-2 px-3">GET IN TOUCH</a>
                
			</div>
        </div>
      </div>
      
      <div class="container border-top  text-center py-md-4">
      	<div class="d-inline text-center">
        	<a href="{{route('user.privacyPolicy')}}" class="mr-2 ftlinks">Privacy Policy</a> <span class="text-secondary">|</span> <a href="{{route('user.termsAndConditions')}}" class="mx-2 ftlinks">Terms &amp; Conditions</a> <span class="text-secondary">|</span> <a href="{{route('user.gdpr')}}" class="mx-2 ftlinks">GDPR</a> <span class="text-secondary">|</span> <a href="{{route('user.termsOfService')}}" class="mx-2 ftlinks">Terms of Service</a>
        </div>
        
        
        
        <div class="clearfix">&nbsp;</div>
        <small>© 2022 <strong>NFT Markets</strong>. All rights reserved.</small><br>
        <small>The NFT Markets does not provide financial or investment advise or recommend you purchase ant NFTs. The NFT Markets is intended for information and educational purposes only. Users may not rely on rarity scores, news, insights, rankings or other information provided on this site for financial, investment or any other purpose.</small>
        <div class="clearfix">&nbsp;</div>
        <span class="text-dark">The NFT Markets and it’s parent company ANSG does not guarantee nor endorse any of the listed projects.</span>
      </div>
      
	</footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  @php
  $routename = Request::route()->getName();
  @endphp
  <script src="{{ URL::asset('assets/user/js/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/popper.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/bootstrap.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/jquery.stellar.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/owl.carousel.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/scrollax.min.js')}}"></script>
  <script src="{{ URL::asset('assets/user/js/main.js')}}"></script>
  

  <script>
  	var img = document.querySelector('.play');
	function meow (){
	  alert('');
	}
	img.addEventListener('click', false);
  </script>
 
  <!-- jQuery -->
  @if($routename != 'user.crypto_detail')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>
  @endif

  <!-- FlexSlider -->
  <script defer src="{{ URL::asset('assets/user/js/jquery.flexslider.js') }}"></script>

  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
 
  </script>
  @yield('script')  
  </body>
</html>
<script>
  
  function filterMarketNews(value)
  {
    $('#filterValue').val(value);
    var form = document.getElementById("form-id");
    form.submit();
  }
  function filterForNFTDrops(value)
  {
    if(value != 'category')
    {
      $('#filterValue').val(value);
    }
    // $('#filternftcategoryValue').val(categoryId);
    var form = document.getElementById("nft_form");
    form.submit();
  }

  function filterForMarkets(value)
  {
    if(value != 'category')
    {
      $('#filterValue').val(value);
    }
    // $('#filternftcategoryValue').val(categoryId);
    var form = document.getElementById("market_form");
    form.submit();
  }

  function filterForVideos(value)
  {
    if(value != 'category')
    {
      $('#filterValue').val(value);
    }
    // $('#filternftcategoryValue').val(categoryId);
    var form = document.getElementById("video_form");
    form.submit();
  }

  function filterForCrypto(value)
  {
    $('#filterValue').val(value);
    var form = document.getElementById("crypto_form");
    form.submit();
  }

  function filterForPress(value)
  {
    if(value != 'category')
    {
      $('#filterValue').val(value);
    }
    var form = document.getElementById("press_form");
    form.submit();
  }
  function submitSubscribeForm(){
    var subscribeemail = $("#subscribeemail").val();
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(subscribeemail == '')
    {
      $("#subscribeemailError").html('<span style="color:red;">Email required</span>');
    }
    else if (!subscribeemail.match(validRegex)) {
      $("#subscribeemailError").html('<span style="color:red;">Invalid Email</span>');
    }
    else{
      var form = document.getElementById("subscribe_form");
      form.submit();
    }
  }
</script>