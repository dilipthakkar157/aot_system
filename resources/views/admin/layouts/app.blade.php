<!DOCTYPE html>
<html>
<head>
	<title>{{ $pageTitle }}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="baseUrl" content="{{ url('') }}">
  	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel='shortcut icon' type='image/x-icon' href="assets/favicon.ico" />

	<link href="{{url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" defer>
	<link href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
	<link href="{{url('assets/build/css/custom.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/custom.css')}}" rel="stylesheet">

	
	<link rel="stylesheet" type="text/css" href="{{url('assets/css/flag-icon.min.css')}}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@xz/fonts@1/serve/plus-jakarta-display.min.css"> 
	<script src="{{url('assets/vendors/jquery/dist/jquery.min.js')}}"></script>

	<!-- Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- jQuery UI -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>
	<body class="nav-sm">
		<div class="container body" id="main">
			<div class="main_container">
				<div class="col-md-3 left_col" style="height: 2000px;">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<!-- <img src="{{url('assets/images/logo.svg')}}" alt="" class="img-responsive header-logo big-size"> -->
							<h1 style="
							    display: block;
							    width: 100%;
							    text-align: center;
							    color: white;
							">ATO</h1>
							<!-- <img src="{{url('assets/images/EXC.png')}}" alt="" class="img-responsive header-logo low-size"> -->
						</div>
						<div class="clearfix"></div>
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
							<ul class="nav side-menu">

							<li>
								<a class="margin_l9" href="{{ route('admin.dashboard') }}"><img src="{{url('assets/images/dash_white.png')}}" class="icon_padding"> <span class="hide_big">Dashboard</span></a>
							</li>

							<li class="mt-50">
								<a class="margin_l9" href="{{ route('admin.staff-role-permission') }}"><img src="{{url('assets/images/profile-2user_white.png')}}" class="icon_padding"> <span class="hide_big">Staff Role </span></a>
							</li>

							<li class="mt-50">
								<a class="margin_l9" href="{{ route('admin.company-profile') }}"><img src="{{url('assets/images/book_white.png')}}" class="icon_padding"> <span class="hide_big">Company Profile </span></a>
							</li>
							
							</ul>
							</div>
							</div>
						<!-- /sidebar menu -->
					</div>
				</div>
				<style>
					.search-box{
					  background: #E8E8E4;
				    position: absolute;
				    /* top: 54px; */
				    right: 49.7%;
				    width: auto;
				    height: 100%;
				    line-height: 60px;
				    box-shadow: 0 0 10px rgb(0 0 0 / 50%);
				    border-top: 4px solid #1d244c;
				    display: none;
					}

					.search-box:before{
					  content: "";
					  position: absolute;
					  top: -32px;
					  right: 13px;
					  border-left: 12px solid transparent;
					  border-right: 12px solid transparent;
					  border-top: 14px solid transparent;
					  border-bottom: 14px solid #2b3257;
					}

					.search-box input[type="text"]{
					      /* width: 200px; */
						    padding: 5px 10px;
						    /* margin-left: 23px; */
						    border: 1px solid #2b3257;
						    outline: none;
						    /* margin-top: -7px; */
						    height: inherit;
					}

					.search-box input[type="button"]{
					  width: 80px;
				    /* padding: 5px 0; */
				    background: #2b3257;
				    color: #fff;
				    /* margin-left: -6px; */
				    border: 1px solid #2b3257;
				    outline: none;
				    margin-top: -9px;
				    cursor: pointer;
					}
				</style>
				<script>
					$(document).ready(function() {
				    $(".fa-search").click(function() {
				       $(".search-box").toggle();
				       $("input[type='text']").focus();
				    });
 					});
				</script>
				<div class="top_nav">
					<div class="nav_menu">
					    <div class="nav toggle">
					    	<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					    </div>
					    <nav class="nav navbar-nav">
					    	<ul class=" navbar-right">
					    		<li class="nav-item dropdown open" style="padding-left: 15px;margin-top: 20px;">
<!-- 
					    		  <a href="javascript:;" class="dropdown-toggle mr-26">
					    		  <img src="{{url('assets/images/Examiner_club.svg')}}" alt="" class="img-responsive header-logo h-70">
										</a>
 -->
					    			<a href="javascript:;" id="show-search-box" class="user-profile dropdown-toggle mr-26">
					    				<i class="fa fa-search"></i>

					    				<div class="search-box">
								    		<input type="text" placeholder="Search EXAM ID / Name Surname" id="skill_inputs" />
								    		<input type="button" value="Search"/>
								  		</div>
					    		  </a>
					    			<a href="javascript:;" style="position: relative;" class="user-profile dropdown-toggle">
					    		   	<i class="fa fa-bell"></i>
					    		   	<span class="button__badge">.</span>
					    		    </a>

					    		    <a href="javascript:;" class="user-profile dropdown-toggle" style="background: none;border: none;" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
					    		    <img src="{{ url('assets/images/dummy.jpeg') }}" alt="">
					    		    </a>
					    		    <div class="dropdown-menu dropdown-usermenu pull-right profile-popup" aria-labelledby="navbarDropdown">

					    		    	<div class="d-flexx">
					    		    		<div class="popup-profile-head">Profile</div>
					    		    		<div class="popup-profile-right"><a href="">Detail Profile</a></div>
					    		    	</div>

					    		    	<div class="border-profile"></div>
					    		    	

					    		    	<div class="d-flexx mt-24">
					    		    		<div class=""> <img class="profile-img" height="50" width="50" src="{{ url('assets/images/dummy.jpeg') }}" alt=""></div>
					    		    		<div class="profile-name"></div>
					    		    	</div>
					    		    		<hr>
					    		    		<a class="dropdown-item" data-toggle="modal" data-target="#exampleModalLongSSS_changepwd" href="#"> Change password</a>
					    		    		<a class="dropdown-item" href="#"> My subscription</a>
					    		    		<a class="dropdown-item" href=""> My public profile</a>
					    		    		<a class="dropdown-item" href=""> My documents</a>
					    		    		<a class="dropdown-item" href=""> My profile</a>
					    		    		<a class="dropdown-item" href="#"> My Merch</a>
					    		        <a class="btn-other-orange orange-w mt-24" href="{{ route('admin.logout') }}">Log Out</a>
					    		    

					    		    </div>
					    		</li>
					    	</ul>
					    </nav>
					</div>
				</div>
				<div class="right_col" role="main">
					@yield('content')
				</div>
				<!-- footer content -->
				<footer>
				    <div class="pull-right">
				    	
				    </div>
				    <div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>
		<script src="{{url('assets/vendors/validator/multifield.js')}}"></script>
		<script src="{{url('assets/vendors/validator/validator.js')}}"></script>
		<script src="{{url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{url('assets/vendors/nprogress/nprogress.js')}}"></script>
		<script src="{{url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
		<script src="{{url('assets/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{url('assets/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
		<script src="{{url('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
		<script src="{{url('assets/vendors/jszip/dist/jszip.min.js')}}"></script>
		<script src="{{url('assets/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
		<script src="{{url('assets/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
		<script src="{{url('assets/build/js/custom.min.js')}}"></script>
	</body>
</html>	