<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Customer</title>
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
			<div class="wrap-login100 p-t-65 p-b-20" style="width: 60%">
               <form class="login100-form validate-form" action="{{ route('customer.add-customer') }}" method="POST">
                  @csrf
                  <span class="login100-form-title p-b-50">
                  Customer Profile
                  </span>
                    @if (\Session::has('error_msg'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('error_msg') !!}</li>
                            </ul>
                        </div>
                    @endif
                  	<div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input m-b-35" data-validate="Enter First Name">
			                     <input class="input100" type="text" name="first_name" id="first_name">
			                     <span class="focus-input100" data-placeholder="Enter First Name"></span>
			                     @if($errors->has('first_name'))
			                     <div class="error">{{ $errors->first('first_name') }}</div>
			                     @endif
		                  	</div>
		              	</div>
          			</div>
          			<div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input m-b-35" data-validate="Enter Middle Name">
			                     <input class="input100" type="text" name="middle_name" id="middle_name">
			                     <span class="focus-input100" data-placeholder="Enter Middle Name"></span>
			                     @if($errors->has('middle_name'))
			                     <div class="error">{{ $errors->first('middle_name') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input m-b-35" data-validate="Enter Last Name">
			                     <input class="input100" type="text" name="last_name" id="last_name">
			                     <span class="focus-input100" data-placeholder="Enter Last Name"></span>
			                     @if($errors->has('last_name'))
			                     <div class="error">{{ $errors->first('last_name') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input m-b-35" data-validate="Enter Date Of Birth">
			                     <input class="input100" type="text" name="date_of_birth" id="date_of_birth">
			                     <span class="focus-input100" data-placeholder="Enter Date Of Birth"></span>
			                     @if($errors->has('date_of_birth'))
			                     <div class="error">{{ $errors->first('date_of_birth') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input m-b-35" data-validate="Enter Place Of Birth">
			                     <input class="input100" type="text" name="place_of_birth" id="place_of_birth">
			                     <span class="focus-input100" data-placeholder="Enter Place Of Birth"></span>
			                     @if($errors->has('place_of_birth'))
			                     <div class="error">{{ $errors->first('place_of_birth') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input m-b-35" data-validate="Enter Social Security Number">
			                     <input class="input100" type="text" name="social_security_number" id="social_security_number">
			                     <span class="focus-input100" data-placeholder="Enter Social Security Number"></span>
			                     @if($errors->has('social_security_number'))
			                     <div class="error">{{ $errors->first('social_security_number') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
					<div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input m-b-35" data-validate="Enter Email">
			                     <input class="input100" type="email" name="email" id="email">
			                     <span class="focus-input100" data-placeholder="Enter Email"></span>
			                     @if($errors->has('email'))
			                     <div class="error">{{ $errors->first('email') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
                  	<div class="container-login100-form-btn">
	                     <button type="submit" name="btn_sign_up" class="login100-form-btn">
	                     Register
	                     </button>
                  	</div>
                  	<div class="login-more p-t-40" style="text-align: center;">
					    <span class="txt1">
					    Already have an account?
					    </span>
					    <a href="{{ route('common.login') }}" class="txt2">
					    Sign in
					    </a>
					    </div>
					</div>
               </form>
            </div>

		</div>
	</div>
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
