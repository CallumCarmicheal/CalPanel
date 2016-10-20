<ul class="nav nav-tabs nav-justified" role="tablist">
	<li class="active"><a href="#messages" data-toggle="tab">Messages</a></li>
	<li>
		<a href="#notifications" data-toggle="tab">
			Notifications 
			<?php echo Auth::user()->getNotificationCount() > 0 ? 
				'<span class="badge">'. 
					Auth::user()->getNotificationCount(). 
				'</span>' : ''; ?>

		</a>
	</li>
	<li><a href="#settings" data-toggle="tab">Settings</a></li>
</ul>

<div class="row" style="text-align: center;">
	<span style="
		font-size: 14px;
    	text-transform: uppercase;
    	color: rgba(255, 255, 255, 0.3);">
    	<?php echo e(Auth::user()->getName()); ?>

	</span>
</div>

<div class="row no-gutters tab-content">
	<?php echo $__env->make('layouts.dashboard.user.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('layouts.dashboard.user.notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('layouts.dashboard.user.settings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>