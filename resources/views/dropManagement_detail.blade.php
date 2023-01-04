<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Popup Title</title>
    <!-- <link rel="manifest" href="manifest.json"> //-->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/animate.css') }}" />

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
</head>
<body>
    <div class="container">
        <div class="main my-0">
            <div class="row mt-3 mx-0">
                <div class="col-md-6 ml-3">
                    <h3>NFT Drop Detail</h3>
                </div>
                <div class="col-md-5 text-right">
                    &nbsp;
                </div>
            </div>
            <div class="cuisinemenu p-3 m-3">
                <table class="webforms sttbl mt-0">
                    <tr>
                        <td><b>Image 1</b></td>
                        <td><img src="@if($dropManagement->image != null) {{asset('uploads/').'/'.$dropManagement->image}} @else {{asset('images/default-image-1.png')}} @endif" width="100"></td>
                    </tr>
                    <tr>
                        <td><b>Image 2</b></td>
                        <td><img src="@if($dropManagement->image2 != null) {{asset('uploads/').'/'.$dropManagement->image2}} @else {{asset('images/default-image-2.png')}} @endif" width="100"></td>
                    </tr>
                    <tr>
                        <td><b>NFT Logo</b></td>
                        <td><img src="@if($dropManagement->logo != null) {{asset('uploads/').'/'.$dropManagement->logo}} @else {{asset('images/default-logo.png')}} @endif" width="100"></td>
                    </tr>
                    <tr>
                        <td><b>Token</b></td>
                        <td>@if($dropManagement->token != null) {{@$dropManagement->token}} @else Token Unavailable.. @endif</td>
                    </tr>
                    <tr>
                        <td><b>Block Chain</b></td>
                        <td>@if($dropManagement->blockChain != null) {{@$dropManagement->blockChain}} @else Block Chain Unavailable.. @endif</td>
                    </tr>
                    <tr>
                        <td><b>Price Of Sale</b></td>
                        <td>@if($dropManagement->priceOfSale != null) {{@$dropManagement->priceOfSale}} @else Price is Unavailable.. @endif</td>
                    </tr>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
    <div class="clearfix"></div>
</body>
</html>