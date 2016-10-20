<!DOCTYPE html>
<!--[if lt IE 7]>      
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>         
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>         
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title>{{$PAGE['Title']}} - {{ config('app.name', 'CalPanel') }}</title>
		
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="_token" content="{{csrf_token()}}">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		
		<link rel="stylesheet" href="/assets/admin1/css/admin1.css">
		<link rel="stylesheet" href="/assets/globals/css/elements.css">
		<link rel="stylesheet" href="/assets/globals/css/plugins.css">
		<link rel="shortcut icon" href="/assets/globals/img/icons/favicon.ico">
		<link rel="apple-touch-icon" href="/assets/globals/img/icons/apple-touch-icon.png">
		<link rel="stylesheet" href="/css/dashboard.css">
		
		<script src="/assets/globals/plugins/modernizr/modernizr.min.js"></script>
	</head>
	<body>
		<div class="nav-bar-container">
			<div class="nav-menu">
				<div class="hamburger">
					<span class="patty"></span>
					<span class="patty"></span>
					<span class="patty"></span>
					<span class="patty"></span>
					<span class="patty"></span>
					<span class="patty"></span>
				</div>
			</div>
			
			@if ($PAGE['Type'] == \app\Libraries\PTYPE::$Dashboard)
				<div class="nav-search">
					<span class="search"></span>
				</div>
				<div class="nav-user">
					<div class="user">
						<img src="{{Auth::user()->getGravatar()}}" alt="">
						@if(Auth::user()->getNotificationCount() > 0)
							<span class="badge">{{Auth::user()->getNotificationCount()}}</span>
						@endif
					</div>
					<div class="cross">
						<span class="line"></span>
						<span class="line"></span>
					</div>
				</div>
			@endif
			
			<div class="nav-bar-border"></div> <div class="overlay">
				<div class="starting-point"> <span></span> </div>
				<div class="logo">{{ config('app.name', 'CalPanel') }}</div>
			</div> <div class="overlay-secondary"></div>
			
		</div>
		<div class="content">
			@if (!empty($PAGE['Header']['NoHead']) ? !$PAGE['Header']['NoHead'] : true)
				<div class="page-header full-content {{empty($PAGE['Header']['Color']) ? '' : 'bg-'.$PAGE['Header']['Color']}}">
					<div class="row">
						<div class="col-sm-6">
							<h1>{{$PAGE['Header']['Text']}} <small>{{$PAGE['Header']['Sub']}}</small></h1>
						</div>
						<div class="col-sm-6">
							@if ($PAGE['IsBCHome'])
								<ol class="breadcrumb">
									<li><a href="#"><i class="ion-home"></i></a></li>
								</ol>
							@elseif (!empty($PAGE['Breadcrumbs']))
								<ol class="breadcrumb">
									<li><a href="/home"><i class="ion-home"></i></a></li>
									
									@foreach ($PAGE['Breadcrumbs'] as $bc)
										<li><a href="{{$bc['Url']}}" class="{{$bc['Active'] ? 'active' : ''}}">{{$bc['Text']}}</a></li>
									@endforeach
									
								</ol>
							@endif
						</div>
					</div>
				</div>
			@endif
			
			@yield('content')

			<div class="footer-links margin-top-40">
				@yield('footer')
			</div>
		</div>
		
		<div class="layer-container">
			@if ($PAGE['Type'] == \app\Libraries\PTYPE::$Dashboard)
				<div class="menu-layer"><ul>@include ('layouts.dashboard.sidebar')</ul></div>
				<div class="search-layer">@include ('layouts.dashboard.search')</div>
				<div class="user-layer">@include ('layouts.dashboard.user')</div>
			@else
				<div class="menu-layer"><ul>@include ('layouts.stripped.sidebar')</ul></div>
			@endif
		</div>
		
		<script src="/assets/globals/js/global-vendors.js"></script>
		<script src="/assets/globals/js/pleasure.js"></script>
		<script src="/assets/admin1/js/layout.js"></script>
		<script src="/js/app.js"></script>
		
		<script src="/js/vendor/jq_ac/jquery.autocomplete.min.js"></script>
		
		<script>
			
			$(document).ready(function () {
				Laravel.RootURL = "{{ url('/') }}/";
				
				// Setup ajax for Laravel CSRF
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				
				Pleasure.init();
				Layout.init();
			});
		</script>

		<script src="/js/app.js"></script>
		
		@yield ('scripts')
	</body>
</html>