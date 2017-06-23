<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!--  image retrieved from http://publicdomainvectors.org/id/bebas-vektor/Robot-pengiriman-kotak-dengan-barang-barang-rapuh-vektor-ilustrasi/20886.html  -->
	<link rel="icon" type="image/ico" href="/images/icon.ico"  />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=rm98-xe29-me92-fj45" /><script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=rm98-xe29-me92-fj45"></script>

    <!-- Styles -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/summonapp.css" rel="stylesheet">
    <link href="/css/viewOrder.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="fontawesome-stars.css">
	<link rel="stylesheet" href="{{ URL::asset('css/jquery.datetimepicker.min.css') }}">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
	<script type="text/javascript"  src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.datetimepicker.full.js') }}"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
	<div class="wrapper">
  <nav class="navbar navbar-default navbar-static-top navcolor">
            <div class="container-fluid" >
                <div class="navbar-header" style="padding-left: 6%; ">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" style="background-color: white;" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" style="color: black;" href="{{ url('/home') }}"> Summon Me</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="margin-top: 0.50%;">
                    <ul class="nav navbar-nav navbar-right" style="padding-right: 2%; ">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
							<li><button class="btn navButton" onclick="window.location.href='/about'">About Us</button></li>
                            <li ><button class="btn navButton" onclick="window.location.href='{{ route('login') }}'" >Login</button></li>
                            <li><button class="btn navButton" onclick="window.location.href='{{ route('register') }}'">Register</button></li>

                        @elseif (Auth::user()->admin == false)

							<li>
								<div class="dropdown">
								  <button class="btn dropdown-toggle navButton" type="button" id="dropdownJob" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> All Job Postings
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownJob">
									<li><a href="/allads" class="navdropdownJob">View Postings</a></li>
									<li><a href="/ads/create" class="navdropdownJob">Create Job</a></li>
								  </ul>
								</div>
							</li>

							<li>
								<div class="dropdown">
								  <button class="btn dropdown-toggle navButton" type="button" id="dropdownMe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> My Account
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMe">
									<li><a href="/profile" class="navdropdown">My Profile</a></li>
									<li><a href="/ads" class="navdropdown">My Job Postings</a></li>
									<li><a  href="/orders" class="navdropdown">Orders</a></li>
								  </ul>
								</div>
							</li>
						 	<li><button class="btn navButton" onclick="window.location.href='/about'">About Us</button></li>

							<li>
                            	<button class="btn navButton" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</button>
 								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                	{{ csrf_field() }}
                                </form>
                      		</li>

                        @else


							<li>
									<div class="dropdown">
										  <button class="btn dropdown-toggle navButton" type="button" id="adminDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Admin Users
											<span class="caret"></span>
										  </button>
										  <ul class="dropdown-menu no-collapse dropdown-menu-left" aria-labelledby="adminDrop">
											<li><a href="/addAdmin">Add</a></li>
											 <li><a href="/disableAdmin">Make Regular User</a></li>
											<li><a href="/alladmins">View</a></li>
										  </ul>
										</div>
								</li>

								<li>
									<div class="dropdown">
										  <button class="btn dropdown-toggle navButton" type="button" id="dropReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Reported
											<span class="caret"></span>
										  </button>
										  <ul class="dropdown-menu no-collapse dropdown-menu-left" aria-labelledby="dropReport">
												<li><a onclick="window.location.href='/viewDisabledUser'">Disabled Users</a></li>
												<li><a onclick="window.location.href='/viewReport'">Report File</a></li>
											  	<li><a  onclick="window.location.href='/report/allReportResolution'">Reported Resolution</a></li>
										  </ul>
										</div>
									</li>
								<li><button class="btn navButton" onclick="window.location.href='/profile'">My Profile</button></li>
								<li>
                        		<button class="btn navButton" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</button>
 								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                	{{ csrf_field() }}
                                </form>
                      		</li>
                        @endif

						<li></li>
                    </ul>
                </div>
            </div>
        </nav>

        @if ($flash = session('message'))
            <div class ="alert alert-success" role="alert">
                {{ $flash }}
            </div>
        @endif
        @yield('content')
	</div>
	 <div class="footer">
		 <p class="footerP">&copy;2017 Summon Me&nbsp;|&nbsp;<a class="footerA" href="/contact">Contact Us</a>&nbsp;|&nbsp;<a class="footerA" href="/tip">Tip Jar&#9786;</a>&nbsp;|&nbsp;<a class="footerA" href="/privacy">Privacy Policy</a>&nbsp;|&nbsp;<a class="footerA" href="/user">Terms of Service</a></p>
	</div>

</body>
</html>
