<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="{{url('assets/images/icons/favicon.ico')}}" />

<link rel="stylesheet" type="text/css" href="{{url('assets/vendor_login/bootstrap/bootstrap.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/fonts_login/font-awesome.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/fonts_login/material-design-iconic-font.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendor_login/animate/animate.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendor_login/css-hamburgers/hamburgers.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendor_login/animsition/animsition.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendor_login/select2/select2.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendor_login/daterangepicker/daterangepicker.css')}}">

<!-- Bootstrap -->
<link href="{{url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<!-- NProgress -->
<link href="{{url('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
<!-- Animate.css -->
<link href="{{url('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{url('assets/build/css/custom.min.css')}}" rel="stylesheet">

<link href="{{url('assets/css/custom.css')}}" rel="stylesheet">
<script src="{{url('assets/vendors/jquery/dist/jquery.min.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{url('assets/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/main.css')}}">

<meta name="robots" content="noindex, follow">
</head>
<body>
<div class="limiter">
<div class="container-login100">
<div class="wrap-login100 p-t-65 p-b-20">
<form class="login100-form validate-form" action="{{ route('common.do-login') }}" method="POST">
@csrf
<span class="login100-form-title p-b-50">
Welcome
</span>
<span class="">
  <h1 style="
                  display: block;
                  width: 100%;
                  text-align: center;
                  /*color: white;*/
              ">ATO Login</h1>
<!-- <img src="{{url('assets/images/FlightExaminer-black.png')}}" height="70" width="80" alt="Examiner"> -->
</span>
@if (\Session::has('msg'))
<div class="alert alert-danger">
    <ul>
        <li>{!! \Session::get('msg') !!}</li>
    </ul>
</div>
@endif
@if (\Session::has('success_msg'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success_msg') !!}</li>
    </ul>
</div>
@endif

@if (\Session::has('error_msg'))
<div class="alert alert-danger">
    <ul>
        <li>{!! \Session::get('error_msg') !!}</li>
    </ul>
</div>
@endif
<div class="wrap-input100 validate-input m-t-20 m-b-35" data-validate="Enter 3LC">
<input class="input100" type="text" name="username" id="username">
<span class="focus-input100" data-placeholder="Enter 3LC"></span>
@if($errors->has('username'))
  <div class="error">{{ $errors->first('username') }}</div>
@endif
</div>
<div class="wrap-input100 validate-input m-b-50" data-validate="Enter Password">
<input class="input100" type="password" name="password" id="password">
<span class="focus-input100" data-placeholder="Password"></span>
@if($errors->has('password'))
  <div class="error">{{ $errors->first('password') }}</div>
@endif
</div>
<div class="container-login100-form-btn">
<button type="submit" name="btn_sign_in" class="login100-form-btn">
Login
</button>
</div>

<div class="login-more p-t-40" style="text-align: center;">
    <div class="m-b-8">
    <a href="javascript:void(0);" class="txt2">
    Forgot Password?
    </a>
    </div>
    <div>
    <span class="txt1">
    Don’t have an account?
    </span>
    <a href="{{ route('company') }}" class="txt2">
    Sign up
    </a>
    </div>
</div>

</form>
</div>
</div>
</div>
<div id="dropDownSelect1"></div>

<script src="{{url('assets/vendor_login/jquery/jquery-3.2.1.min.js') }}"></script>

<script src="{{url('assets/vendor_login/animsition/animsition.min.js') }}"></script>

<script src="{{url('assets/vendor_login/bootstrap/popper.js') }}"></script>
<script src="{{url('assets/vendor_login/bootstrap/bootstrap.min.js') }}"></script>

<script src="{{url('assets/vendor_login/select2/select2.min.js') }}"></script>

<script src="{{url('assets/vendor_login/daterangepicker/moment.min.js') }}"></script>
<script src="{{url('assets/vendor_login/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{url('assets/vendor_login/countdowntime/countdowntime.js') }}"></script>

<script src="{{url('assets/js/main.js') }}"></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"70e6bd488b43861a","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.12.0","si":100}' crossorigin="anonymous"></script>
</body>
</html>
