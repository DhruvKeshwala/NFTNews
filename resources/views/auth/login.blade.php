<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Admin Module</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/animate.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ URL::asset('assets/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ URL::asset('assets/images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="bA46ADbkKbltRj9QAos8kSJXjcOZl98GpPXVc7M5" />
    <meta name="theme-color" content="white">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="NSPL">
    <meta name="msapplication-TileImage" content="images/logo.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

</head>

<body>

    <div class="ftco-section pb-5 mb-4">
        <div class="row mx-0 my-4 px-0">
            <div class="col-md-12 col-12 mb-5 m-auto col-lg-4">
                <div class="bg-white rounded shadow px-4 border border-dark py-3">
                    <form action="{{ route('login.post') }}" onsubmit="return validateForm()" method="POST" class="p-3 bg-white m-auto">
                        @if(session()->has('error') )
                        <div class="alert alert-danger">
                        {{ session()->get('error')  }}
                        </div>
                        @endif
                        @csrf
                        <!-- <h4 class="mb-4 text-center"><strong>Administrator Login</strong></h4> -->
                        <h4 class="mb-4 text-center"><strong><img src="{{ URL(asset('assets/images/logo.png')) }}"></strong></h4>
                        
                        <div class="row form-group">
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-normal" for="fullname">E-Mail Address</label>
                                <input type="text" id="email_address" name="email" class="form-control" placeholder="">
                                <div id="emailError"></div>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-normal" for="fullname">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="">
                                <div id="passwordError"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <input type="submit" value="Submit" class="btn btn-secondary py-2 px-5">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="clearfix"></div>
    <footer>
        © 2022, The NFT Markets
    </footer>
    </div>
    <div class="clearfix"></div>

    <!-- <script src="js/main.js"></script> //-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
    function validateForm() 
    {
        $(".loginError").remove();
        var email_address = $("#email_address").val();
        var password = $("#password").val();
        if (email_address == "") 
        {
            $("#emailError").html('<span class="loginError" style="color:red;">Email Required</span>');
            return false;
        }
        if (password == "") 
        {
            $("#passwordError").html('<span class="loginError" style="color:red;">Password Required</span>');
            return false;
        }
    }
    </script>

</body>

</html>