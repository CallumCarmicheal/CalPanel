<div class="modal scale fade" id="page_perms_areyousure" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure?</h4>
			</div>
			<div class="modal-body">
				You are about to edit permissions allowed to <div id="page_perms_areyousure_perminfo"></div> <br>
				<h1>This can lock you out!</h1> If you have disabled one of the following permissions <br>
				<pre>(admin.access, admin.ajax.access, admin.roles.access, admin.roles.edit, admin.roles.list)</pre>
				If you have disabled one of those permissions and you are currently in the role you are editing you maybe locked out <br/>
				BE WARY!
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-flat btn-default btn-ripple" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_perms_areyousure_btn">I understand</button>
			</div>
		</div>
	</div>
</div>

<div class="modal scale fade" id="page_perms_success" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Saved</h4>
			</div>
			<div class="modal-body">
				The permissions you have set have been saved. <br/>
				They have taken effect immediately, Do you want to refresh the page?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-flat btn-default btn-ripple" id="page_perms_success_dismiss" data-dismiss="modal">Continue Editing</button>
				<button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_perms_success_refresh">Refresh</button>
			</div>
		</div>
	</div>
</div>

<div class="modal scale fade" id="page_users_add_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add user</h4>
			</div>
			<div class="modal-body">
				<div class="checkboxer checkboxer-<?php echo e($PAGE['Header']['Color']); ?>">
					<input type="checkbox" checked id="page_users_modal_rts">
					<label for="page_users_modal_rts">Realtime searching</label>
				</div>

				<div class="panel-inputs inputer-<?php echo e($PAGE['Header']['Color']); ?>" style="width: 100%;">
					<div class="input-group" style="width: 100%;">
						<input
							id="page_users_modal_qry"
							type="text"
							class="form-control input-circle-left"
							placeholder="Query..."
							value="<?php echo e(isset($query) ? $query : ''); ?>">
					</div>
				</div>

				<ul class="list-material has-hidden" id="page_users_modal_lst">
					<!-- Filled once the modal is opened! -->
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-flat btn-primary btn-ripple" data-dismiss="modal">Close</button>
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

<div class="modal scale fade" id="page_yn_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_yn_modal_no" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_yn_modal_yes" data-dismiss="modal">Yes</button>
			</div>
		</div>
	</div>
</div>