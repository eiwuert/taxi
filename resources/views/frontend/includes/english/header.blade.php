<header class="masthead">
<!-- Fixed navbar -->
<div class="navbar navbar-static-top" id="nav" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i>
			</button>
			<a class="navbar-brand" href="{{ url('en/global') }}">
				<img src="../../images/logo.png" alt="Logo">
			</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right social hidden-xs hidden-sm">
				<li>
					<a href="https://twitter.com/flipapp96" target="_blank">
						<i class="fa fa-twitter fa-lg"></i>
					</a>
				</li>
				<li>
					<a href="https://www.linkedin.com/in/flip-application-63abb5141" target="_blank">
						<i class="fa fa-linkedin fa-lg"></i>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/profile.php?id=100016712433417" target="_blank">
						<i class="fa fa-facebook fa-lg"></i>
					</a>
				</li>
				<li>
					<a href="https://t.me/flipapp" target="_blank">
						<i class="fa fa-paper-plane"></i>
					</a>
				</li>
				<li>
					<a href="flipapp96@gmail.com" target="_blank">
						<i class="fa fa-google-plus"></i>
					</a>
				</li>
				<li>
					<a href="https://www.instagram.com/flipapplication/" target="_blank">
						<i class="fa fa-instagram"></i>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav links-to-collaps">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="../../images/en.png"> <span class="hidden-sm hidden-md hidden-lg">Language</span></a>
					<ul class="dropdown-menu">
						<li class="lang">
							<a class="" href="{{ url('/') }}" title="فارسی"><img src="../../images/fa.png"> فارسی</a>
						</li>
						<li class="lang">
							<a class="active" href="{{ url('en/global') }}" title="English"><img src="../../images/en.png"> English</a>
						</li>
					</ul>
				</li>
				<li class="menu-link"><a href="#slider">Flip</a></li>
				<li class="menu-link"><a href="#help">How it works</a></li>
				<li class="menu-link"><a href="#features">Features</a></li>
				<li class="menu-link"><a href="#download">Download</a></li>
				<li class="menu-link"><a href="#contact">Contact us</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="slider-container" id="slider" style="height: 896px;">
	<div class="container">
		<div class="row mh-container" style="height: 896px;">
			<div class="slider-caption">
				<h1>
				<span class="slider-header">Flip</span>
				</h1>
				<div class="row">
				<div class="col-md-6">
					<img class="img-wrapper pull-left" src="../../images/icon-faster.png">
					<h2 class="slider-headerContent first-caption">Move</h2>
					<div class="slider-textContent">Enjoy a seamless app &amp; top-notch service. Effortless payment through your phone.</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<img class="img-wrapper pull-left" src="../../images/icon-seamless.png">
					<h2 class="slider-headerContent second-caption">Anywhere / Anytime</h2>
					<div class="slider-textContent">Find anywhere and anytime the available drivers and book online easily with the tap
					of a button, all on a single screen.</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<img class="img-wrapper pull-left" src="../../images/icon-safer.png">
					<h2 class="slider-headerContent third-caption">Safe</h2>
					<div class="slider-textContent">Track your drivers identity and cab info on the go. Only verified drivers.</div>
				</div>
				</div>
				</div><!-- .slider-caption -->
				<div class="col-md-10 col-md-push-6 mh-slider col-xs-12">
					<div class="row">
						<div class="col-md-6 hidden-sm hidden-xs carousel-container">
							<div id="carousel-slider" class="carousel slide" data-ride="carousel">
								<img src="../../images/flip-phone.png" class="phone-mask" alt="Phone mask">
								<!-- Wrapper for slides -->
								<div class="carousel-inner">
									<div class="item active">
										<img src="../../images/me1.jpg" alt="flip screenshot" class="img-responsive">
									</div>
									<div class="item">
										<img src="../../images/me2.jpg" alt="flip screenshot" class="img-responsive">
									</div>
									<div class="item">
										<img src="../../images/me3.jpg" alt="flip screenshot" class="img-responsive">
									</div>
									<div class="item">
										<img src="../../images/me4.jpg" alt="flip screenshot" class="img-responsive">
									</div>
									{{-- <div class="item">
										<img src="../../images/me5.jpg" alt="flip screenshot" class="img-responsive">
									</div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>