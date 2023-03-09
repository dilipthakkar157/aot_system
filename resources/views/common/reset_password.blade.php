<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset Password</title>
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
@if (\Session::has('msg'))
<div class="alert alert-danger">
    <ul>
        <li>{!! \Session::get('msg') !!}</li>
    </ul>
</div>
@endif
<form class="login100-form validate-form" action="{{route('common.update-password')}}" method="POST">
<input type="hidden" name="token" value="{{ $token }}">
<input type="hidden" name="type" value="{{ $type }}">
@csrf
<span class="login100-form-title p-b-50">
Reset Password
</span>

<div class="wrap-input100 validate-input m-t-20 m-b-35" data-validate="Enter 3LC">
<input class="input100" type="text" name="three_latter_code" id="three_latter_code">
<span class="focus-input100" data-placeholder="Enter 3LC"></span>
@if($errors->has('three_latter_code'))
  <div class="error">{{ $errors->first('three_latter_code') }}</div>
@endif
</div>

<div class="wrap-input100 validate-input m-t-20 m-b-35" data-validate="Enter Email">
<input class="input100" type="email" name="email" id="email">
<span class="focus-input100" data-placeholder="Enter Email"></span>
@if($errors->has('email'))
  <div class="error">{{ $errors->first('email') }}</div>
@endif
</div>

<div class="wrap-input100 validate-input m-t-20 m-b-35" data-validate="Enter New Password">
<input class="input100" type="password" name="new_password" id="new_password">
<span class="focus-input100" data-placeholder="Enter New Password"></span>
@if($errors->has('new_password'))
  <div class="error">{{ $errors->first('new_password') }}</div>
@endif
</div>
<div class="wrap-input100 validate-input m-b-50" data-validate="Enter Confirm New Password">
<input class="input100" type="password" name="confirm_new_password" id="confirm_new_password">
<span class="focus-input100" data-placeholder="Enter Confirm New Password"></span>
@if($errors->has('confirm_new_password'))
  <div class="error">{{ $errors->first('confirm_new_password') }}</div>
@endif
</div>
<div class="container-login100-form-btn">
<button type="submit" name="btnReset" class="login100-form-btn">
Reset
</button>
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
