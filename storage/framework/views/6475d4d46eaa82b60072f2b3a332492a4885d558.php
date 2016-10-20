<?php $iMS = 'style="color: #3e50b4;"'; ?>

<?php $__currentLoopData = $users->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

	<li class="has-action-left code_page-edit-user-tab" style="cursor: default; background-color: #F7F7F7;">
		<a class="hidden" style="cursor:pointer;">
			<i class="glyphicon glyphicon-pencil code_page-edit-user-btn" user_id="<?php echo e($user->getID()); ?>"></i>
		</a>

		<a href="#" class="visible" style="background-color: #F7F7F7;">
			<div class="list-action-left">
				<img src="<?php echo e($user->getGravatar()); ?>" class="face-radius" alt="">
			</div>
			<div class="list-content" style="cursor: default">
                <span
                    class="title"
	                <?php echo Auth::getUser()->getEmail() == $user->getEmail() ? $iMS : ''; ?>

                > <?php echo e($user->getName()); ?> </span>
				<span class="caption">ID: <?php echo e($user->getID()); ?> | Email: <?php echo e($user->getEmail()); ?></span>
			</div>
		</a>
	</li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>