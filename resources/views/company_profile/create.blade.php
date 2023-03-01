<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Company</title>
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
               <form class="login100-form validate-form" action="" method="POST">
                  @csrf
                  <span class="login100-form-title p-b-50">
                  Company Profile
                  </span>
                  	<div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input" data-validate="Enter Company Name">
			                     <input class="input100" type="text" name="company_name" id="company_name">
			                     <span class="focus-input100" data-placeholder="Enter Company Name"></span>
			                     @if($errors->has('company_name'))
			                     <div class="error">{{ $errors->first('company_name') }}</div>
			                     @endif
		                  	</div>
		              	</div>
          			</div>
          			<div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input" data-validate="Enter Company Correspondence Email">
			                     <input class="input100" type="text" name="company_correspondence_email" id="company_correspondence_email">
			                     <span class="focus-input100" data-placeholder="Enter Company Correspondence Email"></span>
			                     @if($errors->has('company_correspondence_email'))
			                     <div class="error">{{ $errors->first('company_correspondence_email') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input" data-validate="Enter Company Correspondence Telephone">
			                     <input class="input100" type="text" name="company_correspondence_telephone" id="company_correspondence_telephone">
			                     <span class="focus-input100" data-placeholder="Enter Company Correspondence Telephone"></span>
			                     @if($errors->has('company_correspondence_telephone'))
			                     <div class="error">{{ $errors->first('company_correspondence_telephone') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input" data-validate="Enter Company Registration Number">
			                     <input class="input100" type="text" name="company_registration_number" id="company_registration_number">
			                     <span class="focus-input100" data-placeholder="Enter Company Registration Number"></span>
			                     @if($errors->has('company_registration_number'))
			                     <div class="error">{{ $errors->first('company_registration_number') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input" data-validate="Enter Tax Registration Number">
			                     <input class="input100" type="text" name="tax_registration_number" id="tax_registration_number">
			                     <span class="focus-input100" data-placeholder="Enter Tax Registration Number"></span>
			                     @if($errors->has('tax_registration_number'))
			                     <div class="error">{{ $errors->first('tax_registration_number') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>
		            <div class="col-md-6">
				   		<div class="form-group">
		                  	<div class="wrap-input100 validate-input" data-validate="Enter Vat Number">
			                     <input class="input100" type="text" name="vat_number" id="vat_number">
			                     <span class="focus-input100" data-placeholder="Enter Vat Number"></span>
			                     @if($errors->has('vat_number'))
			                     <div class="error">{{ $errors->first('vat_number') }}</div>
			                     @endif
		                  	</div>
		                </div>
		            </div>    
                  	<div class="container-login100-form-btn">
	                     <button type="submit" name="btn_sign_up" class="login100-form-btn">
	                     Register
	                     </button>
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
