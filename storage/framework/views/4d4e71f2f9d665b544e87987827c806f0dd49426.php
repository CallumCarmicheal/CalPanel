<?php $__currentLoopData = $roles->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	
	<li class="has-action-left code_page-edit-user-tab" style="cursor: default; background-color: #F7F7F7;">
		<a class="hidden" style="cursor:pointer;">
			<i class="glyphicon glyphicon-pencil code_page-edit-user-btn" user_id="<?php echo e($role->slug); ?>"></i>
		</a>

		<a href="#" class="visible" style="background-color: #F7F7F7;">
			<div class="list-content" style="cursor: default">
                <span class="title"> <?php echo e($role->name); ?> </span>
				<span class="caption">SLug: <?php echo e($role->slug); ?> | Level: <?php echo e($role->level); ?> | Desc: <?php echo e($role->description); ?></span>
			</div>
		</a>
	</li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>