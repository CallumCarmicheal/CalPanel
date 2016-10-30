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
		
		<title><?php echo e($PAGE['Title']); ?> - <?php echo e(config('app.name', 'CalPanel')); ?></title>
		
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="_token" content="<?php echo e(csrf_token()); ?>">
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
			
			<?php if($PAGE['Type'] == \app\Libraries\PTYPE::$Dashboard): ?>
				<div class="nav-search">
					<span class="search"></span>
				</div>
				<div class="nav-user">
					<div class="user">
						<img src="<?php echo e(Auth::user()->getGravatar()); ?>" alt="">
						<?php if(Auth::user()->getNotificationCount() > 0): ?>
							<span class="badge"><?php echo e(Auth::user()->getNotificationCount()); ?></span>
						<?php endif; ?>
					</div>
					<div class="cross">
						<span class="line"></span>
						<span class="line"></span>
					</div>
				</div>
			<?php endif; ?>
			
			<div class="nav-bar-border"></div> <div class="overlay">
				<div class="starting-point"> <span></span> </div>
				<div class="logo"><?php echo e(config('app.name', 'CalPanel')); ?></div>
			</div> <div class="overlay-secondary"></div>
			
		</div>
		<div class="content">
			<?php if(!empty($PAGE['Header']['NoHead']) ? !$PAGE['Header']['NoHead'] : true): ?>
				<div class="page-header full-content <?php echo e(empty($PAGE['Header']['Color']) ? '' : 'bg-'.$PAGE['Header']['Color']); ?>">
					<div class="row">
						<div class="col-sm-6">
							<h1><?php echo e($PAGE['Header']['Text']); ?> <small><?php echo e($PAGE['Header']['Sub']); ?></small></h1>
						</div>
						<div class="col-sm-6">
							<?php if($PAGE['IsBCHome']): ?>
								<ol class="breadcrumb">
									<li><a href="#"><i class="ion-home"></i></a></li>
								</ol>
							<?php elseif(!empty($PAGE['Breadcrumbs'])): ?>
								<ol class="breadcrumb">
									<li><a href="/home"><i class="ion-home"></i></a></li>
									
									<?php $__currentLoopData = $PAGE['Breadcrumbs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<li><a href="<?php echo e($bc['Url']); ?>" class="<?php echo e($bc['Active'] ? 'active' : ''); ?>"><?php echo e($bc['Text']); ?></a></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									
								</ol>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<?php echo $__env->yieldContent('content'); ?>

			<div class="footer-links margin-top-40">
				<?php echo $__env->yieldContent('footer'); ?>
			</div>
		</div>
		
		<div class="layer-container">
			<?php if($PAGE['Type'] == \app\Libraries\PTYPE::$Dashboard): ?>
				<div class="menu-layer"><ul><?php echo $__env->make('layouts.dashboard.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></ul></div>
				<div class="search-layer"><?php echo $__env->make('layouts.dashboard.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
				<div class="user-layer"><?php echo $__env->make('layouts.dashboard.user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
			<?php else: ?>
				<div class="menu-layer"><ul><?php echo $__env->make('layouts.stripped.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></ul></div>
			<?php endif; ?>
		</div>
		
		<script src="/assets/globals/js/global-vendors.js"></script>
		<script src="/assets/globals/js/pleasure.js"></script>
		<script src="/assets/admin1/js/layout.js"></script>
		<script src="/js/app.js"></script>
		
		<script src="/js/vendor/jq_ac/jquery.autocomplete.min.js"></script>
		
		<script>
			
			$(document).ready(function () {
				Laravel.RootURL = "<?php echo e(url('/')); ?>/";
				
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
		
		<?php echo $__env->yieldContent('scripts'); ?>
	</body>
</html>