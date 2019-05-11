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
<link href="{{asset('css/style.css')}}" rel="stylesheet"/>
<link href="{{asset('css/fonts.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.slidertron-1.1.js')}}"></script>
</head>
<body>
<div id="wrapper">
	<div id="page" class="container">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="{{url('/')}}">Careers Jobs</a></h1>
			</div>
			<div id="menu">
				<ul>
					<li class="current_page_item"><a href="#" data-target="#myModal">Homepage</a></li>
					<li><a  data-target="#myModal">Blog</a></li>
					<li><a  data-target="#myModal">Photos</a></li>
					<li><a  data-target="#myModal">About</a></li>
				</ul>
			</div>
		</div>
		
		<div id="content">
			<div class="title">
				<br>
				<h2>{{$job_details->job_title}}</h2>
				<br>
				<div><?php echo $job_details->sub_header ?></div>
				<div style="float: right;"><b><img style="height: 15px;width: 15px;" src="{{asset('images/eye.jpg')}}"></b> {{($job_details->job_view->views)+($job_details->job_view->extra)}}</div>
				<div><i class="fa fa-building" aria-hidden="true"> </i><b>Company Name :</b> {{$job_details->company_name}}</div>
				@if(!empty($job_details->job_skill_map))
					<div><b>Skill :</b> 
						@foreach($job_details->job_skill_map as $k => $each_skill)
							@if(isset($each_skill->hasone_master_skill->skill_name))
								@if($k>0), @endif {{$each_skill->hasone_master_skill->skill_name}}
							@endif
						@endforeach
					</div>
				@endif
				@if(!empty($job_details->job_sector_map))
					<div><b>Sector :</b> 
						@foreach($job_details->job_sector_map as $k => $each_sector)
							@if(isset($each_sector->hasone_master_sector->sector_name))
								@if($k>0), @endif {{$each_sector->hasone_master_sector->sector_name}}
							@endif
						@endforeach
					</div>
				@endif

				@if(!empty($job_details->job_location_map))
					<div><b>Sector :</b> 
						@foreach($job_details->job_location_map as $k => $each_location)
							@if(isset($each_location->hasone_master_location->location_name))
								@if($k>0), @endif {{$each_location->hasone_master_location->location_name}}
							@endif
						@endforeach
					</div>
				@endif

				@if(!empty($job_details->job_qualification_map))
					<div><b>Qualification :</b> 
						@foreach($job_details->job_qualification_map as $k => $each_qualification)
							@if(isset($each_qualification->hasone_master_qualification->qualification_name))
								@if($k>0), @endif {{$each_qualification->hasone_master_qualification->qualification_name}}
							@endif
						@endforeach
					</div>
				@endif

				<br>
				<div><?php echo $job_details->up_body ?></div>
				<div><?php echo $job_details->sub_footer ?></div>
				<div><?php echo $job_details->down_body ?></div>
			
				
			{{-- </div> --}}
		</div>
		
	</div>
	<!-- end #page --> 
</div>
<div id="footer">
	<p>&copy; {{date('Y')}} All rights reserved.</p>
</div>
<!-- end #footer -->
</body>
</html>
