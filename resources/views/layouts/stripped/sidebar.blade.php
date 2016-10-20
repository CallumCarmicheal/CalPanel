<?php $p = $PAGE['PID']; ?>



<li> <a href="{{$p==0?'#':'/home'}}" {!!$p==0?'data-open-after="true"':''!!}>Dashboard</a> </li>


<li>
	<a href="javascript:;">Community</a>
	<ul class="child-menu">
		<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Staff Chat</a> </li>
		<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Todo List</a> </li>
	</ul>
</li>


<li>
	<a href="javascript:;">Stealth</a>
	<ul class="child-menu">
		<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Clients</a> </li>
		<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Tokens</a> </li>
		<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Statistics</a> </li>
	</ul>
</li>


@if (!Auth::guard($guard)->check())
	<li>
		<a href="javascript:;">Authentication</a>
		<ul class="child-menu">
			<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Login</a> </li>
			<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Register</a> </li>
			<li> <a href="{{$p==-1?'#':'/home'}}" {!!$p==-1?'data-open-after="true"':''!!}>(TODO) Forgot Password</a> </li>
		</ul>
	</li>
@endif