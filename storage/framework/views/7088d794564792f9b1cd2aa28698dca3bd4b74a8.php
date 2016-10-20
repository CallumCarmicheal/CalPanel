<?php $__env->startSection('content'); ?>

	<div class="display-animation"> <div class="row image-row">
			<div class="material-animate material-animated" style="animation-delay: 0.35s;">
				
				<?php if(Auth::user()->hasRoles()): ?>
					Your current rank is: <?php echo e(Auth::user()->getHighestRole()->name); ?> <br>

					All users with that role are: <br>
					
					<?php $__currentLoopData = Auth::user()->getHighestRole()->usersInRole(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 
						<p> <?php echo e($user->name); ?> </p>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				<?php else: ?>
					<p> You have not been assigned a role yet! </p>
				<?php endif; ?>
				
				<p>
					Skype: <?php echo e($user->Contact()->getSkype()); ?>

				</p>
				
				
				
				<br>
				<Br>
				<br>
			</div>
		</div>
	</div>
	
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>