<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <title>@yield('title')</title>
  <!-- <link rel="manifest" href="manifest.json"> //-->
    
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/owl.carousel.min.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/nice-select.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/magnific-popup.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/slicknav.min.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/animate.css') }}"/>
    
  <link rel="icon" href="{{ URL::asset('assets/favicon.ico') }}" type="image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="apple-touch-icon" href="{{ URL::asset('assets/images/logo.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="white">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="NSPL">
  <meta name="msapplication-TileImage" content="images/logo.png">
  <meta name="msapplication-TileColor" content="#FFFFFF">
  
  <!-- Add jQuery library -->
  <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.10.2.min.js') }}"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/select2.min.css') }}" />
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/alert2@7.12.15/dist/sweetalert2.min.css'>

  <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-extended.css')}}">
  <script src="{{ URL::asset('assets/js/vendors.min.js')}}"></script>

  <style>
    .fill-a
    {
      text-decoration: none;
      display: block;
      width: 100%;
      height: 100%;
    }
    li.active {
      background: #fbfbfb;
    }
  </style>
  
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			
			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					type : 'iframe',
					padding : 0
				});
			});

		});
	</script>
  
</head>

<body class="m-0">
  <div class="container mr-0 p-0">
    <!-- Header Section -->
     <div class="m-auto">
        <div class="header-info border-dark">
	        <a href="#" class="d-block d-sm-block d-md-none mt-2">WEBSITE NAME</a>
        	 <div class="p-0 d-sm-none">
                <a href="{{route('logout')}}" class="topright-bx"><span class="usrnam ml-0">Welcome {{ Auth::user()->name }}!</span><span class="fa fa-power-off btn"></span></a>
             </div>
              <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
              <label for="openSidebarMenu" class="sidebarIconToggle">
                <div class="spinner diagonal part-1"></div>
                <div class="spinner horizontal"></div>
                <div class="spinner diagonal part-2"></div>
              </label>
              <div id="sidebarMenu">
                <ul class="sidebarMenuInner">
                  <li class="logo d-sm-none border-bottom bg-light border-dark"><a href="#"><h4 class="mb-0 mt-1">The NFT Markets</h4></a></li>
                  <li class="{{ Request::segment(2) == 'category' || Request::segment(2) == 'add_category' || Request::segment(2) == 'filter_category' ? 'active' : '' }}"><span class="material-icons">list</span><a class="fill-a" href="{{route('category')}}">Category</a></li>
                  <li class="{{ Request::segment(2) == 'news' || Request::segment(2) == 'add_news' || Request::segment(2) == 'filter_news' ? 'active' : '' }}"><span class="material-icons">newspaper</span><a class="fill-a" href="{{route('news')}}">News</a></li>
                  <li class="{{ Request::segment(2) == 'videos' || Request::segment(2) == 'add_video' || Request::segment(2) == 'filter_video' ? 'active' : '' }}"><span class="material-icons">movie</span><a class="fill-a" href="{{route('videos')}}">Videos</a></li>
                  <li class="{{ Request::segment(2) == 'cryptoJournal' || Request::segment(2) == 'add_crypto' || Request::segment(2) == 'filter_crypto' ? 'active' : '' }}"><span class="material-icons">money</span><a class="fill-a" href="{{route('cryptoJournal')}}">Crypto Journal</a></li>
                  <li class="{{ Request::segment(2) == 'author' || Request::segment(2) == 'add_author' || Request::segment(2) == 'filter_author' ? 'active' : '' }}"><span class="material-icons">account_circle</span><a class="fill-a" href="{{route('author')}}">Author</a></li>
                  <li class="{{ Request::segment(2) == 'banner' || Request::segment(2) == 'add_banner' || Request::segment(2) == 'filter_banner' ? 'active' : '' }}"><span class="material-icons">image</span><a class="fill-a" href="{{route('banner')}}">Banner</a></li>
                  <li class="{{ Request::segment(2) == 'dropManagement' || Request::segment(2) == 'add_dropManagement' || Request::segment(2) == 'filter_dropManagement' ? 'active' : '' }}"><span class="material-icons">euro</span><a class="fill-a" href="{{route('dropManagement')}}">NFT Drops</a></li>
                  <li class="{{ Request::segment(2) == 'pressRelease' || Request::segment(2) == 'add_pressRelease' || Request::segment(2) == 'filter_pressRelease' ? 'active' : '' }}"><span class="material-icons">handshake</span><a class="fill-a" href="{{route('pressRelease')}}">Press Release</a></li>
                  <li class="{{ Request::segment(2) == 'guide_category' || Request::segment(2) == 'add_guide_category' || Request::segment(2) == 'filter_guide_category' ? 'active' : '' }}"><span class="material-icons">category</span><a class="fill-a" href="{{route('guide_category')}}">Guide Category</a></li>
                  <li class="{{ Request::segment(2) == 'guide' || Request::segment(2) == 'add_guide' || Request::segment(2) == 'filter_guide' ? 'active' : '' }}"><span class="material-icons">quiz</span><a class="fill-a" href="{{route('guide')}}">Guide</a></li>
                  <li class="{{ Request::segment(2) == 'media' || Request::segment(2) == 'add_media' || Request::segment(2) == 'filter_media' ? 'active' : '' }}"><span class="material-icons">camera</span><a class="fill-a" href="{{route('media')}}">Media</a></li>
  
                  <li class="{{ Route::is('managePages') ? 'active' : '' }}"><span class="material-icons">assignment</span><a class="fill-a" href="{{route('managePages')}}">Manage Pages</a></li>
                  <li class="{{ Request::segment(2) == 'subscribersList' ? 'active' : '' }}"><span class="material-icons">add</span><a class="fill-a" href="{{ route('subscribersList') }}">Subscribers</a></li>
                  <li class="{{ Request::segment(2) == 'contactList' ? 'active' : '' }}"><span class="material-icons">call</span><a class="fill-a" href="{{ route('contactList') }}">Contact</a></li>
                  <li class="{{ Route::is('changePassword') ? 'active' : '' }}"><span class="material-icons">password</span><a class="fill-a" href="{{ route('changePassword') }}">Change Password</a></li>
                  <li class="{{ Route::is('settings') ? 'active' : '' }}"><span class="material-icons">engineering</span><a class="fill-a" href="{{ route('settings') }}">Settings</a></li>
                  <li><span class="material-icons">logout</span><a class="fill-a" href="{{ route('logout') }}">Logout</a></li>
              
                </ul>
              </div>
        </div>
      </div><?php /**PATH /opt/lampp/htdocs/admin/resources/views/layouts/header.blade.php ENDPATH**/ ?>