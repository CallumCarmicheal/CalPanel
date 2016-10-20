<?php $p = $PAGE['PID']; ?>

<!-- Add permissions -->

<li> <a href="<?php echo e($p==\app\Libraries\PID::$HOME_Index?'#':'/home'); ?>" <?php echo $p==\app\Libraries\PID::$HOME_Index?'data-open-after="true"':''; ?>>Dashboard</a> </li>


<?php if (Auth::check() && Auth::user()->can('community.access')): ?>
<li>
	<a href="javascript:;">Community</a>
	<ul class="child-menu">
		<?php if (Auth::check() && Auth::user()->can('community.chat.access')): ?>
		<li> <a href="<?php echo e($p==\app\Libraries\PID::$INVALID?'#':'/'); ?>" <?php echo $p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''; ?>>Community Chat</a> </li>
		<?php endif; ?>

		<?php if (Auth::check() && Auth::user()->can('community.todo.access')): ?>
		<li> <a href="<?php echo e($p==\app\Libraries\PID::$INVALID?'#':'/'); ?>" <?php echo $p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''; ?>>Todo List</a> </li>
		<?php endif; ?>
		
	</ul>
</li>
<?php endif; ?>


<?php if (Auth::check() && Auth::user()->can('stealth.access')): ?>
<li>
	<a href="javascript:;">Stealth</a>
	<ul class="child-menu">
		<?php if (Auth::check() && Auth::user()->can('stealth.clients.access')): ?>
		<li> <a href="<?php echo e($p==\app\Libraries\PID::$INVALID?'#':'/'); ?>" <?php echo $p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''; ?>>Client Manager</a> </li>
		<?php endif; ?>

		<?php if (Auth::check() && Auth::user()->can('stealth.tokens.access')): ?>
		<li> <a href="<?php echo e($p==\app\Libraries\PID::$INVALID?'#':'/'); ?>" <?php echo $p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''; ?>>Token Manager</a> </li>
		<?php endif; ?>

		<?php if (Auth::check() && Auth::user()->can('stealth.planner.access')): ?>
		<li> <a href="<?php echo e($p==\app\Libraries\PID::$INVALID?'#':'/'); ?>" <?php echo $p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''; ?>>Server Logs</a> </li>
		<?php endif; ?>
		
		<?php if (Auth::check() && Auth::user()->can('stealth.stats.access')): ?>
		<li> <a href="<?php echo e($p==\app\Libraries\PID::$INVALID?'#':'/'); ?>" <?php echo $p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''; ?>>Statistics / Analytics</a> </li>
		<?php endif; ?>
	</ul>
</li>
<?php endif; ?>


<?php if (Auth::check() && Auth::user()->can('admin.access')): ?>
	<li>
		<a href="javascript:;">Administration</a>
		<ul class="child-menu">

			<?php if (Auth::check() && Auth::user()->can('admin.users.access')): ?>
			<li> <a href="<?php echo e($p==\app\Libraries\PID::$ADMIN_Users?'#':'/admin/users'); ?>" <?php echo $p==\app\Libraries\PID::$ADMIN_Users?'data-open-after="true"':''; ?>>Manage Users</a> </li>
			<?php endif; ?>

			<?php if (Auth::check() && Auth::user()->can('admin.roles.access')): ?>
			<li> <a href="<?php echo e($p==\app\Libraries\PID::$ADMIN_Roles?'#':'/admin/roles'); ?>" <?php echo $p==\app\Libraries\PID::$ADMIN_Roles?'data-open-after="true"':''; ?>>Manage Roles</a> </li>
			<?php endif; ?>

		</ul>
	</li>
<?php endif; ?>