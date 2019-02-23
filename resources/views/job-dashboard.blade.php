<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : StylePrecision 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130720

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Careers Jobs</title>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css' />
<link href="{{asset('public/css/style.css')}}" rel="stylesheet"/>
<link href="{{asset('public/css/fonts.css')}}" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.slidertron-1.1.js')}}"></script>
</head>
<body>
<div id="wrapper">
	<div id="page" class="container">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Careers Jobs</a></h1>
			</div>
			<div id="menu">
				<ul>
					<li class="current_page_item"><a href="#" data-target="#myModal">Homepage</a></li>
					<li><a  data-target="#myModal">Blog</a></li>
					<li><a  data-target="#myModal">Photos</a></li>
					<li><a  data-target="#myModal">About</a></li>
					<li><a  data-target="#myModal">Contact</a></li>
				</ul>
			</div>
		</div>
		<div id="banner">
			<div id="slider">
				<div class="viewer">
					<div class="reel">
						<div class="slide"> <img src="{{asset('public/images/banner/job_banner_1.jpg')}}" alt="job_banner_1"  style="height: 300px; width: 1100px" /> </div>
						<div class="slide"> <img src="{{asset('public/images/banner/job_banner_2.jpg')}}" alt="job_banner_2" style="height: 300px; width: 1100px" /> </div>
						{{--<div class="slide"> <img src="{{asset('public/images/banner/job_banner_3.jpg')}}" alt="job_banner_3" style="height: 300px; width: 1100px" /> </div>--}}
						<div class="slide"> <img src="{{asset('public/images/banner/job_banner_4.jpg')}}" alt="job_banner_4" style="height: 300px; width: 1100px" /> </div>
						<div class="slide"> <img src="{{asset('public/images/banner/job_banner_5.jpg')}}" alt="job_banner_5" style="height: 300px; width: 1100px" /> </div>
						<div class="slide"> <img src="{{asset('public/images/banner/job_banner_6.jpg')}}" alt="job_banner_6" style="height: 300px; width: 1100px" /> </div>
						
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$('#slider').slidertron({
					viewerSelector: '.viewer',
					reelSelector: '.viewer .reel',
					slidesSelector: '.viewer .reel .slide',
					advanceDelay: 3000,
					speed: 'slow'
				});
			</script> 
		</div>
		<div id="content">
			<div class="title">
				<h2>Find your dream job</h2>
				{{--<span class="byline">Phasellus nec erat sit amet nibh pellentesque congue</span> </div>
			<p>This is <strong>StylePrecision</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>--}}
			<div id="two-column">
				<div id="tbox1">
					<div class="title">
						<h2>Fusce fringilla</h2>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac quam risus, at tempus justo. Sed dictum rutrum massa eu volutpat. Quisque vitae hendrerit sem.</p>
					<a href="#" class="">Read More</a> 
				</div>
				<div id="tbox2">
					<div class="title">
						<h2>Maecenas luctus</h2>
					</div>
					<p>Etiam non felis. Donec ut ante. In id eros. Sed dictum rutrum massa eu volutpat. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
					<a href="#" class="">Read More</a> 
				</div>

				<div id="tbox2">
					<div class="title">
						<h2>Maecenas luctus</h2>
					</div>
					<p>Etiam non felis. Donec ut ante. In id eros. Sed dictum rutrum massa eu volutpat. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
					<a href="#" class="">Read More</a> 
				</div>
				<div id="tbox2">
					<div class="title">
						<h2>Maecenas luctus</h2>
					</div>
					<p>Etiam non felis. Donec ut ante. In id eros. Sed dictum rutrum massa eu volutpat. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
					<a href="#" class="">Read More</a> 
				</div>
				<div id="tbox2">
					<div class="title">
						<h2>Maecenas luctus</h2>
					</div>
					<p>Etiam non felis. Donec ut ante. In id eros. Sed dictum rutrum massa eu volutpat. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
					<a href="#" class="">Read More</a> 
				</div>

			</div>
		</div>
		{{--<div id="sidebar">
			<div class="box1">
				<div class="title">
					<h2>Mauris vulputate</h2>
				</div>
				<ul class="style2">
					<li><a href="#">Semper mod quis eget mi dolore</a></li>
					<li><a href="#">Quam turpis feugiat sit dolor</a></li>
					<li><a href="#">Amet ornare in hendrerit in lectus</a></li>
					<li><a href="#">Consequat etiam lorem phasellus</a></li>
					<li><a href="#">Semper mod quis eget mi dolore</a></li>
					<li><a href="#">Amet turpis, feugiat et sit amet</a></li>
					<li><a href="#">Semper mod quisturpis nisi</a></li>
				</ul>
			</div>
			<div class="box2">
				<div class="title">
					<h2>Integer gravida</h2>
				</div>
				<ul class="style2">
					<li><a href="#">Amet turpis, feugiat et sit amet</a></li>
					<li><a href="#">Ornare in hendrerit in lectus</a></li>
					<li><a href="#">Semper mod quis eget mi dolore</a></li>
					<li><a href="#">Quam turpis feugiat sit dolor</a></li>
					<li><a href="#">Amet ornare in hendrerit in lectus</a></li>
					<li><a href="#">Semper mod quisturpis nisi</a></li>
					<li><a href="#">Consequat etiam lorem phasellus</a></li>
				</ul>
					<a href="#" class="icon icon-file-alt button">Read More</a> </div>
			</div>
		</div>--}}
	</div>
	<!-- end #page --> 
</div>
<div id="footer">
	<p>&copy; {{date('Y')}} All rights reserved.</p>
</div>
<!-- end #footer -->
</body>
</html>
