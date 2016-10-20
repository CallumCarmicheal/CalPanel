<?php $p = $PAGE['PID']; ?>

<!-- Add permissions -->

<li> <a href="{{$p==\app\Libraries\PID::$HOME_Index?'#':'/home'}}" {!!$p==\app\Libraries\PID::$HOME_Index?'data-open-after="true"':''!!}>Dashboard</a> </li>


@permission('community.access')
<li>
	<a href="javascript:;">Community</a>
	<ul class="child-menu">
		@permission('community.chat.access')
		<li> <a href="{{$p==\app\Libraries\PID::$INVALID?'#':'/'}}" {!!$p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''!!}>Community Chat</a> </li>
		@endpermission

		@permission('community.todo.access')
		<li> <a href="{{$p==\app\Libraries\PID::$INVALID?'#':'/'}}" {!!$p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''!!}>Todo List</a> </li>
		@endpermission
		
	</ul>
</li>
@endpermission


@permission('stealth.access')
<li>
	<a href="javascript:;">Stealth</a>
	<ul class="child-menu">
		@permission('stealth.clients.access')
		<li> <a href="{{$p==\app\Libraries\PID::$INVALID?'#':'/'}}" {!!$p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''!!}>Client Manager</a> </li>
		@endpermission

		@permission('stealth.tokens.access')
		<li> <a href="{{$p==\app\Libraries\PID::$INVALID?'#':'/'}}" {!!$p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''!!}>Token Manager</a> </li>
		@endpermission

		@permission('stealth.planner.access')
		<li> <a href="{{$p==\app\Libraries\PID::$INVALID?'#':'/'}}" {!!$p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''!!}>Server Logs</a> </li>
		@endpermission
		
		@permission('stealth.stats.access')
		<li> <a href="{{$p==\app\Libraries\PID::$INVALID?'#':'/'}}" {!!$p==\app\Libraries\PID::$INVALID?'data-open-after="true"':''!!}>Statistics / Analytics</a> </li>
		@endpermission
	</ul>
</li>
@endpermission


@permission('admin.access')
	<li>
		<a href="javascript:;">Administration</a>
		<ul class="child-menu">

			@permission('admin.users.access')
			<li> <a href="{{$p==\app\Libraries\PID::$ADMIN_Users?'#':'/admin/users'}}" {!!$p==\app\Libraries\PID::$ADMIN_Users?'data-open-after="true"':''!!}>Manage Users</a> </li>
			@endpermission

			@permission('admin.roles.access')
			<li> <a href="{{$p==\app\Libraries\PID::$ADMIN_Roles?'#':'/admin/roles'}}" {!!$p==\app\Libraries\PID::$ADMIN_Roles?'data-open-after="true"':''!!}>Manage Roles</a> </li>
			@endpermission

		</ul>
	</li>
@endpermission