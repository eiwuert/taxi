     @include('frontend.includes.head')
     <header class="head-section">
        <div class="navbar navbar-static-top" id="nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" page-scroll data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="../images/logo.png" alt="Logo">
                </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right social hidden-xs hidden-sm " style="float: left !important;">
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
                    <ul class="nav navbar-nav navbar-right links-to-collaps" style="float: right;">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                            aria-haspopup="true" aria-expanded="false"><img src="../images/en.png">
                                <span class="hidden-sm hidden-md hidden-lg">Language</span></a>
                            <ul class="dropdown-menu">
                                <li class="lang">
                                <a class="active" href="{{ url('/') }}" title="فارسی"><img src="../../images/fa.png"> فارسی</a>
                            </li>
                            <li class="lang">
                                <a class="" href="{{ url('en/global') }}" title="English"><img src="../../images/en.png"> English</a>
                            </li>
                            </ul>
                        </li>
                        <li class="menu-link"><a class="page-scroll" href="#sequence">فلیپ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
@include('frontend.includes.404')
 <script src="{{ elixir('js/fa.js') }}"></script>   