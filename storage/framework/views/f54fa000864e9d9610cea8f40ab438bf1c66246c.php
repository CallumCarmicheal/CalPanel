<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-6">
			<button type="button" id="page_reorder" class="btn btn-<?php echo e($PAGE['Header']['Color']); ?> btn-lg btn-block btn-ripple">Reorder Roles</button>
		</div>

		<div class="col-md-6">
			<button type="button" id="page_addrole" class="btn btn-<?php echo e($PAGE['Header']['Color']); ?> btn-lg btn-block btn-ripple">New Role</button>
		</div>
	</div>
	
	<br>
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
				
				<div class="checkboxer checkboxer-<?php echo e($PAGE['Header']['Color']); ?>">
					<input type="checkbox" value="" checked id="page_realtime_search">
					<label for="page_realtime_search">Realtime searching</label>
				</div>

				<small>Press enter to search if realtime is turned off. Press search to refresh with search results (URL BAR)</small>
			</div>

			<div class="panel-inputs inputer-<?php echo e($PAGE['Header']['Color']); ?>" style="width: 95%;margin-right: 10px">

				<div class="input-group">
					<input
							id="page_query_input"
							type="text"
							class="form-control input-circle-left"
							placeholder="Query..."
							value="<?php echo e(isset($query) ? $query : ''); ?>">
                    
                    <span class="input-group-btn">
                        <button style="padding: 0px 10px 0px 10px;"
                                type="button"
                                id="page_query_go"
                                class="btn btn-flat btn-<?php echo e($PAGE['Header']['Color']); ?> btn-ripple">Search</button>
                    </span>

				</div>
			</div>
		</div>
		<div class="panel-body without-padding">
			<ul class="list-material has-hidden" id="user_body">
				<?php echo $__env->make('areas.admin.roles.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</ul>
		</div>
	</div>
	
	<div class="modal scale fade" id="page_edituser_areyousure" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Are you sure?</h4>
				</div>
				<div class="modal-body">
					You are about to edit the role "<span id="page_edituser_name"></span>" with the slug:<span id="page_edituser_id"></span>. <br>
					This will redirect you!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-flat btn-default btn-ripple" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_edit_mobile_accept">Edit Role</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal scale fade" id="page_make_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Make role</h4>
				</div>
				<div class="modal-body">
					<div class="panel-inputs inputer-<?php echo e($PAGE['Header']['Color']); ?>" style="width: 100%;margin-right: 10px">
						<div class="input-group" style="width: 100%;">
							<input id="page_make_role_slug"
							       type="text"
							       class="form-control input-circle-left"
							       placeholder="Role ID/Slug (No spaces/SChars $£! etc)">
						</div>

						<div class="input-group" style="width: 100%;">
							<input id="page_make_role_name"
							       type="text"
							       class="form-control input-circle-left"
							       placeholder="Role name">
						</div>

						<div class="input-group" style="width: 100%;">
							<input id="page_make_role_desc"
							       type="text"
							       class="form-control input-circle-left"
							       placeholder="Role description">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-flat btn-default btn-ripple" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_make_accept">Make Role</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal scale fade" id="page_simple_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_simple_modal_ok" data-dismiss="modal">Okay</button>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script src="/js/pages/admin/roles/home.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>