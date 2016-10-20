<div id="manage" class="tab-pane">

	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
				<div class="checkboxer checkboxer-{{$PAGE['Header']['Color']}}">
					<input type="checkbox" value="" checked id="page_realtime_search">
					<label for="page_realtime_search">Realtime searching</label>
				</div>

				<small>Press enter to search if realtime is turned off. Press search to refresh with search results (URL BAR)</small>
			</div>

			<div class="panel-inputs inputer-{{$PAGE['Header']['Color']}}" style="width: 95%;margin-right: 10px">

				<div class="input-group">
					<input
							id="page_query_input"
							type="text"
							class="form-control input-circle-left"
							placeholder="Query..."
							value="{{$query or ''}}">
                    
                    <span class="input-group-btn">
                        <button style="padding: 0px 10px 0px 10px;"
                                type="button"
                                id="page_query_go"
                                class="btn btn-flat btn-{{$PAGE['Header']['Color']}} btn-ripple">Search</button>
                    </span>

				</div>
			</div>
		</div>
		<div class="panel-body without-padding">
			<ul class="list-material has-hidden" id="user_body">
				
			</ul>
		</div>
	</div>


	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-tabs borderless vertical">
				<li class="active"><a href="#manage_edit" data-toggle="tab">Information</a></li>
				<li class="active"><a href="#manage_rperms" data-toggle="tab">Roles and Permissions</a></li>
				<li><a href="#">Finish</a></li>
			</ul>
		</div><!--.col-md-3-->
		
		<div class="col-md-9">
			<div class="tab-content">

				<div class="tab-pane active" id="manage_edit">
					<div class="legend">Contact Information</div>
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

					<div class="legend">Basic Information</div>
					<div class="row">
						<div class="col-md-3">Birth Date</div><!--.col-md-3-->
						<div class="col-md-9">July 17</div><!--.col-md-9-->
					</div><!--.row-->
					<div class="row">
						<div class="col-md-3">Birth Year</div><!--.col-md-3-->
						<div class="col-md-9">2014</div><!--.col-md-9-->
					</div><!--.row-->
					<div class="row">
						<div class="col-md-3">Gender</div><!--.col-md-3-->
						<div class="col-md-9">Male</div><!--.col-md-9-->
					</div><!--.row-->
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