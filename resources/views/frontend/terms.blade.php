@include('frontend.includes.head')
		<div id="wrap">
			<header class="masthead">
				<!-- Fixed navbar -->
				<div class="navbar navbar-static-top" id="nav" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i>
							</button>
							<a class="navbar-brand" href="{{ url('/') }}">
								{{ HTML::image('images/logo.png') }}
							</a>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav social hidden-xs hidden-sm">
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
							<ul class="nav navbar-nav navbar-right links-to-collaps">
								<li class="dropdown">
									<a href="{{ route('faHome') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ HTML::image('images/fa.png') }} <span class="hidden-sm hidden-md hidden-lg">زبان</span></a>
									<ul class="dropdown-menu">
										<li class="lang">
											<a class="active" href="{{ route('faTerms') }}" title="فارسی">{{ HTML::image('images/fa.png') }} فارسی</a>
										</li>
										<li class="lang">
											<a class="" href="{{ route('enTerms') }}" title="English">{{ HTML::image('images/en.png') }} English</a>
										</li>
									</ul>
								</li>
								<li class="menu-link"><a href="{{ url('/') }}"> فلیپ </a></li>
							</ul>
						</div>
					</div>
				</div>
			</header>
			<div class="container">
				<div class="col-sm-12 trans-blk">
					<link rel="stylesheet" href="./css/moreRtl.css">
					<h2>قوانین و مقررات </h2>
					<hr>
					<p>به نام خدا</p>
					<br>
					<p>
						شرایط و قوانین حاضر در خصوص استفاده از اپلیکشن موبایل فلیپ
						و مجوز کاربر نهایی٬ توافقی است فیمابین شما کاربر گرامی و شرکت ارايه
						دهنده فلیپ. این توافق بر استفاده شما از اپلیکشن نرم افزار فلیپ
						(شامل مستندات٬ اپلیشکشن و نرم افزار آن) حاکمیت دارد. استفاده از
						این سرویس توسط شما٬ به منزله آگاهی کامل شما از شرایط و ضوابط و پذیرش
					شرایط خدمات ارایه شده در فلیپ و سیاست های این شرکت می باشد.</p>
					<p>
						در صورت انتخاب دکمه چک باکس «پذیرش شرایط و ضوابط» اقرار می
						نمایید که شرایط توافقنامه را خوانده و درک کرده اید٬ توافقنامه را
					پذیرفته اید و خود را مقید به موارد مذکور در آن می دانید.</p>
					<p>
						در صورت عدم پذیرش شرایط و ضوابط مندرج در این صفحه٬ لطفا اپلیکشن فلیپ
						را نصب و استفاده ننماید.
					</p>
					<p>جهت دسترسی و استفاده از اپلیکشن و سرویس فلیپ:</p>
					<p>
						- اقرار و موافقت می فرمایید که نام و نام خانوادگی٬ شماره تلفن
						موبایل٬ آدرس پست الکترونیکی و نشانی محل سکونت شما می بایست در اختیار
					فلیپ قرار گیرد.</p>
					<p>
						- در صورت هر گونه استفاده غیر مجاز از موبایل شما به واسطه فلیپ
						٬ می بایست بلافاصله فلیپ را مطلع فرمایید. گرچه فلیپ هیچ
						نوع مسیولیتی در قبال ضرر و زیان های ناشی از استفاده غیر مجاز از تلفن
						همراه شما نخواهد داشت٬ اما شما در قبال استفاده غیر مجاز سایر افراد از
						فلیپ از طریق تلفن همراه خود٬ در قبال ف مسیولیت خواهید
					داشت و موظف به جبران ضرر و زیان های مرتبه خواهید بود.</p>
					<p>
						- اقرار و موافقت می فرمایید که جهت ارایه سرویس٬ اپلیکشن فلیپ
						محل درخواست شما را شناسایی کرده و راننده را به محل مورد نظر ارسال
					نماید.</p>
					<p>
						- اقرار و موافقت می فرمایید که شماره موبایل ارایه شده یک شماره
					تلفن معتبر و دقیق است.</p>
					<p>
						- طراحی سرویس فلیپ به همراه متون٬ نوشته ها٬ گرافیک٬ ویژگی های
						تعاملی٬ علامت تجاری٬ نشان خدمات و لوگوی آن تحت مالکیت و بهره برداری
						فلیپ است و کلیه حقوق مالکیت معنوی آن صرفا متعلق به فلیپ است.
					</p>
					<p>
						- اقرار و موافقت می فرمایید کلیه مسیولیت استفاده از اپلیکشن فلیپ با
						کاربر است و فلیپ و هیچیک از افراد مرتبط با آن هیچگونه مسیولیتی در
						قبال دسترسی اشخاص ثالث به اطلاعات فردی و مالی شما٬ ویروس ها٬ تروجان و
						باگ های تلفن همراه و یا سیستم شما نخواهد داشت.
					</p>
					<p>
						- فلیپ هیچگونه مسیولیتی در قبال شرکت ها و یا کالاهایی که از طریق این
						سیستم آگهی و تبلیغات می شوند را نخواهد داشت.
					</p>
				</div>
			</div>
			<script src="./images/bootstrap.min.js"></script>
			@include('frontend.includes.contact')
		</div>
		@include('frontend.includes.footer')
		<script>$(document).ready(function(){appMaster.preLoader();});</script>
	</body>
</html>