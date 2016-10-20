<div id="manage" class="tab-pane">

	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-tabs borderless vertical">
				<li class="active"><a href="#manage_edit" data-toggle="tab">Information</a></li>
				<li class=""><a href="#manage_rperms" data-toggle="tab">Roles and Permissions</a></li>
			</ul>
		</div><!--.col-md-3-->
		
		<div class="col-md-9">
			<div class="tab-content">

				<div class="tab-pane active" id="manage_edit">
					<div class="legend">Database Information</div>
					
					<div class="legend">Contact Information</div>
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
					
					<div class="row">
						<div class="col-md-3">Mobile Phones</div><!--.col-md-3-->
						<div class="col-md-9">+1-202-555-0173</div><!--.col-md-9-->
					</div>
					
				</div><!--#about_overview.tab-pane-->
				
				<div class="tab-pane" id="manage_rperms">
					<div class="legend">Currently Active</div>
					<div class="row">
						<div class="col-md-3">Mobile Phones</div><!--.col-md-3-->
						<div class="col-md-9">+1-202-555-0173</div><!--.col-md-9-->
					</div><!--.row-->
					<div class="row">
						<div class="col-md-3">Address</div><!--.col-md-3-->
						<div class="col-md-9">2002 Holcombe Boulevard<br>Houston, TX 77030 </div><!--.col-md-9-->
					</div><!--.row-->
					<div class="row">
						<div class="col-md-3">Website</div><!--.col-md-3-->
						<div class="col-md-9">http://www.teamfox.co</div><!--.col-md-9-->
					</div><!--.row-->
					<div class="row">
						<div class="col-md-3">Email</div><!--.col-md-3-->
						<div class="col-md-9">info@teamfox.com</div><!--.col-md-9-->
					</div><!--.row-->
					<div class="row">
						<div class="col-md-3">Facebook</div><!--.col-md-3-->
						<div class="col-md-9">fb.com/teamfoxco</div><!--.col-md-9-->
					</div><!--.row-->
					<div class="row">
						<div class="col-md-3">Twitter</div><!--.col-md-3-->
						<div class="col-md-9">twitter.com/teamfox</div><!--.col-md-9-->
					</div><!--.row-->

					<div class="legend">Add Role</div>
					<div class="legend">Add Permission</div>
				</div><!--#about_overview.tab-pane-->

			</div><!--.tab-content-->

		</div><!--.col-md-9-->
	</div><!--.row-->
</div> <!--#timeline.tab-pane-->