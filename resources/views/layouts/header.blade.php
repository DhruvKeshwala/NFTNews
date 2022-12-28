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

  <style>
    .fill-a
    {
      text-decoration: none;
      display: block;
      width: 100%;
      height: 100%;
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
                  <li><span class="material-icons">list</span><a class="fill-a" href="@if(Request::segment(1) == 'category') {{'#'}} @else {{route('category')}} @endif">Category</a></li>
                  <li><span class="material-icons">newspaper</span><a class="fill-a" href="@if(Request::segment(1) == 'news') {{'#'}} @else {{route('news')}} @endif">News</a></li>
                  <li><span class="material-icons">newspaper</span><a class="fill-a" href="@if(Request::segment(1) == 'videos') {{'#'}} @else {{route('videos')}} @endif">Videos</a></li>
                  <li><span class="material-icons">account_circle</span><a class="fill-a" href="@if(Request::segment(1) == 'author') {{'#'}} @else {{route('author')}} @endif">Author</a></li>
                  <li><span class="material-icons">image</span><a class="fill-a" href="@if(Request::segment(1) == 'banner') {{'#'}} @else {{route('banner')}} @endif">Banner</a></li>
                  <li><span class="material-icons">euro</span><a class="fill-a" href="@if(Request::segment(1) == 'dropManagement') {{'#'}} @else {{route('dropManagement')}} @endif">NFT Drops</a></li>
                  <li><span class="material-icons">handshake</span><a class="fill-a" href="{{route('pressRelease')}}">Press Release</a></li>
                  <li><span class="material-icons">logout</span><a class="fill-a" href="{{ route('logout') }}">Logout</a></li>
                </ul>
              </div>
        </div>
      </div><?php /**PATH /opt/lampp/htdocs/admin/resources/views/layouts/header.blade.php ENDPATH**/ ?>