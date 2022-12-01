<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Popup Title</title>
    <!-- <link rel="manifest" href="manifest.json"> //-->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}" />

    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" href="{{ URL::asset('images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="white">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="NSPL">
    <meta name="msapplication-TileImage" content="images/logo.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2.min.css') }}" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/alert2@7.12.15/dist/sweetalert2.min.css'>
</head>
<body>
    <div class="container">
        <div class="main my-0">
            <div class="row mt-3 mx-0">
                <div class="col-md-6 ml-3">
                    <h3>News Detail.</h3>
                </div>
                <div class="col-md-5 text-right">
                    &nbsp;
                </div>
            </div>
            <div class="cuisinemenu p-3 m-3">
                <table class="webforms sttbl mt-0">
                    <tr>
                        <td>Short Description</td>
                        <td>{{ $news->shortDescription }}</td>
                    </tr>
                    <tr>
                        <td>Full Description</td>
                        <td>{!! $news->fullDescription !!}</td>
                    </tr>
                    <tr>
                        <td>Video URL</td>
                        <td>{{ $news->videoURL }}</td>
                    </tr>
                    @php
                    $dateArray = json_decode(@$news->newsType,true);
                    @endphp
                    @if(@$dateArray['featured'] != '')
                    <tr>
                        <td>Featured</td>
                        <td>{{ $dateArray['featured'] }}</td>
                    </tr>
                    @endif
                    @if(@$dateArray['latest'] != '')
                    <tr>
                        <td>Latest News</td>
                        <td>{{ $dateArray['featured'] }}</td>
                    </tr>
                    @endif
                    @if(@$dateArray['video'] != '')
                    <tr>
                        <td>Video</td>
                        <td>{{ $dateArray['featured'] }}</td>
                    </tr>
                    @endif
                    @if(@$dateArray['press'] != '')
                    <tr>
                        <td>Press Releases</td>
                        <td>{{ $dateArray['featured'] }}</td>
                    </tr>
                    @endif
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
    <div class="clearfix"></div>
</body>
</html>