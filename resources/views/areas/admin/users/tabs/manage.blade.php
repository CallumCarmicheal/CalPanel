<div id="manage" class="tab-pane">

	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-tabs borderless vertical">
				<li class="active"><a href="#manage_edit" data-toggle="tab">Information</a></li>
				<li class=""><a href="#manage_roles" data-toggle="tab">Roles</a></li>
				<li class=""><a href="#manage_options" data-toggle="tab">Options</a></li>
			</ul>
		</div><!--.col-md-3-->
		
		<div class="col-md-9">
			<div class="tab-content">
				<div class="tab-pane active" id="manage_edit">
					<div class="legend">General</div>
					<!-- User ID -->
						<div class="row">
							<div class="col-md-3">User ID</div><!--.col-md-3-->
							<div class="col-md-9">{{$user->getID()}}</div><!--.col-md-9-->
						</div>
					<!-- Name -->
						<div class="row">
							<div class="col-md-3">Name</div><!--.col-md-3-->
							<div class="col-md-9">{{$user->getName()}}</div><!--.col-md-9-->
						</div>
					<!-- Email -->
						<div class="row">
							<div class="col-md-3">Email</div><!--.col-md-3-->
							<div class="col-md-9">{{$user->getEmail()}}</div><!--.col-md-9-->
						</div>

					<div class="legend">Contact</div>
					<!-- skype -->
						<div class="row">
							<div class="col-md-3">Skype</div><!--.col-md-3-->
							<div class="col-md-9">{{$user->Contact()->getSkype()}}</div><!--.col-md-9-->
						</div>
					<!-- aim -->
						<div class="row">
							<div class="col-md-3">Aim</div><!--.col-md-3-->
							<div class="col-md-9">{{$user->Contact()->getAim()}}</div><!--.col-md-9-->
						</div>
					<!-- discord -->
						<div class="row">
							<div class="col-md-3">Discord</div><!--.col-md-3-->
							<div class="col-md-9">{{$user->Contact()->getDiscord()}}</div><!--.col-md-9-->
						</div>
					<!-- facebook -->
						<div class="row">
							<div class="col-md-3">Facebook</div><!--.col-md-3-->
							<div class="col-md-9">{{$user->Contact()->getFacebook()}}</div><!--.col-md-9-->
						</div>
					
					
					<div class="legend">Customization</div>
					<!-- image_background   -->
						<div class="row">
							<div class="col-md-3">Profile BG Image</div><!--.col-md-3-->
							<div class="col-md-9"><a href="{{$user->getBackgroundImage()}}">Url</a></div><!--.col-md-9-->
						</div>
					
					<br><br><br>
					<button type="button" id="manage_info_edit" class="btn btn-default btn-lg btn-block btn-ripple">Manage User Information</button>
				</div><!--#about_overview.tab-pane-->
				
				<div class="tab-pane" id="manage_roles">
					<div class="legend">Add</div>
					
					
					<div class="legend">Currently In</div>
					<ul class="list-material has-hidden" id="user_body">
						@foreach ($user->getRoles()->all() as $role)

							<li class="has-action-left code_page-edit-user-tab" style="cursor: default; background-color: #F7F7F7;">
								@if ($role->slug != "everyone")
									<a class="hidden" style="cursor:pointer;">
										<i class="glyphicon glyphicon-trash code_page-edit-user-btn" user_id="{{$role->slug}}"></i>
									</a>
								@endif
									
								<a href="#" class="visible" style="background-color: #F7F7F7;">
									<div class="list-content" style="cursor: default">
										<span class="title"> {{ $role->name }} </span>
										<span class="caption">SLug: {{ $role->slug }} | Level: {{ $role->level }} | Desc: {{ $role->description }}</span>
									</div>
								</a>
							</li>

						@endforeach
					</ul>
					
				</div>
				
				<div class="tab-pane" id="manage_options">
					Some optiony things!
				</div>

			</div><!--.tab-content-->

		</div><!--.col-md-9-->
	</div><!--.row-->
</div> <!--#timeline.tab-pane-->