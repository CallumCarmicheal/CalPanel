<ul class="nav nav-tabs nav-justified" role="tablist">
	<li class="active"><a href="#messages" data-toggle="tab">Messages</a></li>
	<li>
		<a href="#notifications" data-toggle="tab">
			Notifications 
			{!! Auth::user()->getNotificationCount() > 0 ? 
				'<span class="badge">'. 
					Auth::user()->getNotificationCount(). 
				'</span>' : '' !!}
		</a>
	</li>
	<li><a href="#settings" data-toggle="tab">Settings</a></li>
</ul>

<div class="row" style="text-align: center;">
	<span style="
		font-size: 14px;
    	text-transform: uppercase;
    	color: rgba(255, 255, 255, 0.3);">
    	{{Auth::user()->getName()}}
	</span>
</div>

<div class="row no-gutters tab-content">
	@include ('layouts.dashboard.user.messages')
	@include ('layouts.dashboard.user.notifications')
	@include ('layouts.dashboard.user.settings')
</div>