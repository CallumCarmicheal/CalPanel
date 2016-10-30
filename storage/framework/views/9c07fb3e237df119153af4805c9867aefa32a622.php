<?php $iMS = 'style="color: #3e50b4;"'; ?>

<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

	<li class="has-action-left code_page-users-tab" style="cursor: default;">
		<a class="hidden" style="cursor:pointer;">
			<i class="glyphicon glyphicon-plus code_page-users-add" user_id="<?php echo e($user->getID()); ?>"></i>
		</a>

		<a href="#" class="visible" style="">
			<div class="list-action-left">
				<img src="<?php echo e($user->getGravatar()); ?>" class="face-radius" alt="">
			</div>
			<div class="list-content" style="cursor: default">
                <span
                    class="title"
	                <?php echo Auth::getUser()->getEmail() == $user->getEmail() ? $iMS : ''; ?>

                > <?php echo e($user->getName()); ?> </span>
				<span class="caption">ID: <?php echo e($user->getID()); ?> | Highest Role: <?php echo e($user->getHighestRole()->slug); ?> | Email: <?php echo e($user->getEmail()); ?></span>
			</div>
		</a>
	</li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>