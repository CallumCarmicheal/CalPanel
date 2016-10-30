<?php $iMS = 'style="color: #3e50b4;"'; ?>



<?php $__env->startSection('content'); ?>
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
				Managing role: <?php echo e($role->name); ?>

			</div>
		</div>
		<div class="panel-body without-padding">
			<div class="row">
				<div class="col-md-3">
					<ul class="nav nav-tabs borderless vertical">
						<li class="active"><a href="#manage_info" data-toggle="tab">Information</a></li>

						<?php if($role->slug != "admin"): ?>
						<li class=""><a href="#manage_perms" data-toggle="tab">Permissions</a></li>
						<?php endif; ?>
						
						<?php if($role->slug != "everyone"): ?>
						<li class=""><a href="#manage_users" data-toggle="tab">Users</a></li>
						<?php endif; ?>
						
						<?php if(($role->slug != "admin") && ($role->slug != "everyone")): ?>
						<li class=""><a href="#manage_delete" data-toggle="tab">Delete</a></li>
						<?php endif; ?>
					</ul>
				</div><!--.col-md-3-->

				<div class="col-md-9">
					<div class="tab-content">

						<div class="tab-pane active" id="manage_info">
							<!-- Protected -->
							<div class="legend">Protected</div>
								<!-- DB ID -->
									<div class="row">
										<div class="col-md-3 r">Database ID</div>
										<div class="col-md-9"><?php echo e($role->id); ?></div>
									</div>
								<!-- Slug  -->
									<div class="row">
										<div class="col-md-3 r">SLug</div>
										<div class="col-md-9"><?php echo e($role->slug); ?></div>
									</div>
								<!-- Level -->
									<div class="row">
										<div class="col-md-3 r">Level</div>
										<div class="col-md-9"><?php echo e($role->level); ?></div>
									</div>

								<!-- Date Created -->
									<div class="row">
										<div class="col-md-3 r">Date Created</div>
										<div class="col-md-9"><?php echo e($role->created_at); ?></div>
									</div>
		
								<!-- Date Updated -->
									<div class="row">
										<div class="col-md-3 r">Date Last Edited</div>
										<div class="col-md-9"><?php echo e($role->updated_at); ?></div>
									</div>
							
							<!-- Editable -->
							<div class="legend">Editable</div>
								<!-- Display Name -->
									<div class="row">
										<div class="col-md-3 r">Display Name</div>
										<div class="col-md-8"><?php echo e($role->name); ?></div>
										<div class="col-md-1"><a class="btn btn-<?php echo e($PAGE['Header']['Color']); ?> btn-ripple"><i class="ion-android-create"></i></a></div>
									</div>
								<!-- Description  -->
									<div class="row">
										<div class="col-md-3 r">Description</div>
										<div class="col-md-8"><?php echo e($role->description); ?></div>
										<div class="col-md-1"><a class="btn btn-<?php echo e($PAGE['Header']['Color']); ?> btn-ripple"><i class="ion-android-create"></i></a></div>
									</div>
						</div>

						<?php if($role->slug != "admin"): ?>
						<div class="tab-pane" id="manage_perms">
							<div class="legend">Permissions</div>
							<div class="btn-group">
								<button type="button" id="page_perms_btn_enall" class="btn btn-red btn-ripple">Enable all</button>
								<button type="button" id="page_perms_btn_toggle" class="btn btn-pink btn-ripple">Toggle all</button>
								<button type="button" id="page_perms_btn_dsall" class="btn btn-purple btn-ripple">Disable all</button>
							</div>
							
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Permission</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $rps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<tr>
												<td>
													<div class="checkboxer checkboxer-<?php echo e($PAGE['Header']['Color']); ?>">
														<input class="tog_perm" id="tog_perm_<?php echo e($rp->permission->id); ?>" pid="<?php echo e($rp->permission->id); ?>" type="checkbox" value="" <?php echo e($rp->isEnabled() ? "checked" : ''); ?>>
														<label for="tog_perm_<?php echo e($rp->permission->id); ?>"></label>
													</div>
												</td>
												
												<td><?php echo e($rp->permission->slug); ?></td>
												<td><?php echo e($rp->permission->description); ?></td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</tbody>
								</table>
							</div><!--.table-responsive-->
							
							<button type="button" id="page_submit_perms" class="btn btn-default btn-lg btn-block btn-ripple">Save permissions</button>
						</div>
						<?php endif; ?>
						
						<?php if($role->slug != "everyone"): ?>
						<div class="tab-pane" id="manage_users">
							<div class="legend">Options</div>
							<button type="button" id="page_users_btn_add" class="btn btn-<?php echo e($PAGE['Header']['Color']); ?> btn-ripple">Add User</button>

							<div class="legend">Currently in <?php echo e($role->name); ?></div>
							<ul class="list-material has-hidden" id="user_body">
								<?php $__currentLoopData = $role->usersInRole(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<li class="has-action-left page-edit-user-tab-rm" style="cursor: default; background-color: #F7F7F7;">
										<a class="hidden" style="cursor:pointer;">
											<i class="glyphicon glyphicon-trash page-user-btn-rm" user_id="<?php echo e($user->getID()); ?>"></i>
										</a>

										<a href="#" class="visible" style="background-color: #F7F7F7;">
											<div class="list-action-left">
												<img src="<?php echo e($user->getGravatar()); ?>" class="face-radius" alt="">
											</div>
											
											<div class="list-content" style="cursor: default">
								                <span class="title"
								                    <?php echo Auth::getUser()->getEmail() == $user->getEmail() ? $iMS : ''; ?>> 
									                <?php echo e($user->getName()); ?> 
								                </span>
													
												<span class="caption">ID: <?php echo e($user->getID()); ?> | Email: <?php echo e($user->getEmail()); ?></span>
											</div>
										</a>
									</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>

						
						<?php if(($role->slug != "admin") && ($role->slug != "everyone")): ?>
						<div class="tab-pane" id="manage_delete">
							<!-- Protected -->
							<div class="legend">Delete <?php echo e($role->name); ?></div>
							
							<button type="button" style="width:100%;" id="page_delete_role" class="btn btn-red btn-ripple">The big red button</button>
						</div>
						<?php endif; ?>

					</div><!--.tab-content-->

				</div><!--.col-md-9-->
			</div><!--.row-->
		</div>
	</div>

	<?php echo $__env->make('areas.admin.roles.res.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	
	<script src="/js/pages/admin/roles/view.js"></script>

	<script>
		Page.Role.Slug = "<?php echo e($role->slug); ?>";
		Page.Role.Name = "<?php echo e($role->name); ?>";
	</script>
	
	<style>
		.r {
			color: #999;
		}
	</style>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>