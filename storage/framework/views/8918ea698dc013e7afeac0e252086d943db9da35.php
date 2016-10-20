    
<?php
    $h_u_m_defaultIcon = "https://s.gravatar.com/avatar/23463b99b62a72f26ed677cc556c44e8?s=128";
    $iMS = 'style="color: #3e50b4;"';
?>

<?php $__env->startSection('content'); ?>
    <div class="page-header full-content parallax" style="height: 600px; overflow: hidden">
        <div class="parallax-bg" style="background: url('<?php echo e($user->getBackgroundURL()); ?>') 50% 50%; background-size: cover; width: 100%; height: 100%; position: absolute; left: 0; top: 0;">
        </div>

        <div class="profile-info">
            <div class="profile-photo">
                <img src="<?php echo e($user->getGravatar()); ?>" alt="">
            </div><!--.profile-photo-->
	        
            <div class="profile-text light">
                <?php echo e($user->getName()); ?>

                <span class="caption"><?php echo e($user->getRoles()->count() == 0 ? $user->getTitle() : $user->getHighestRole()->name); ?></span>
            </div><!--.profile-text-->
        </div><!--.profile-info-->

        <div class="row">
            <div class="col-sm-6">
                <h1>User Profile <small><?php echo e($user->getName()); ?></small></h1>
            </div><!--.col-->
            <div class="col-sm-6">
                <ol class="breadcrumb">
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
                </ol>
            </div><!--.col-->
        </div><!--.row-->

        <div class="header-tabs scrollable-tabs sticky">
            <ul class="nav nav-tabs tabs-active-text-white tabs-active-border-yellow">
                <li class="active"><a href="#timeline" data-toggle="tab" class="btn-ripple">Timeline</a></li>
                <li><a href="#about" data-toggle="tab" class="btn-ripple">About</a></li>
                <li><a href="#manage" data-toggle="tab" class="btn-ripple">Manage</a></li>
            </ul>
        </div>

    </div><!--.page-header-->
    <div class="row user-profile">
	    <div class="col-md-12">
		    <div class="tab-content without-border">


			    <?php echo $__env->make('areas.admin.users.tabs.timeline', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			    <?php echo $__env->make('areas.admin.users.tabs.about', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			    <?php echo $__env->make('areas.admin.users.tabs.manage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			    
			    
		    </div><!--.tab-content-->
	    </div><!--.col-->
    </div><!--.row-->


<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
    <script src="/js/pages/admin/users/home.js"></script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>