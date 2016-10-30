<?php $iMS = 'style="color: #3e50b4;"'; ?>

@extends('layouts.dashboard')

@section('content')
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
				Managing role: {{$role->name}}
			</div>
		</div>
		<div class="panel-body without-padding">
			<div class="row">
				<div class="col-md-3">
					<ul class="nav nav-tabs borderless vertical">
						<li class="active"><a href="#manage_info" data-toggle="tab">Information</a></li>

						@if ($role->slug != "admin")
						<li class=""><a href="#manage_perms" data-toggle="tab">Permissions</a></li>
						@endif
						
						@if ($role->slug != "everyone")
						<li class=""><a href="#manage_users" data-toggle="tab">Users</a></li>
						@endif
						
						@if (($role->slug != "admin") && ($role->slug != "everyone"))
						<li class=""><a href="#manage_delete" data-toggle="tab">Delete</a></li>
						@endif
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
										<div class="col-md-9">{{$role->id}}</div>
									</div>
								<!-- Slug  -->
									<div class="row">
										<div class="col-md-3 r">SLug</div>
										<div class="col-md-9">{{$role->slug}}</div>
									</div>
								<!-- Level -->
									<div class="row">
										<div class="col-md-3 r">Level</div>
										<div class="col-md-9">{{$role->level}}</div>
									</div>

								<!-- Date Created -->
									<div class="row">
										<div class="col-md-3 r">Date Created</div>
										<div class="col-md-9">{{$role->created_at}}</div>
									</div>
		
								<!-- Date Updated -->
									<div class="row">
										<div class="col-md-3 r">Date Last Edited</div>
										<div class="col-md-9">{{$role->updated_at}}</div>
									</div>
							
							<!-- Editable -->
							<div class="legend">Editable</div>
								<!-- Display Name -->
									<div class="row">
										<div class="col-md-3 r">Display Name</div>
										<div class="col-md-8">{{$role->name}}</div>
										<div class="col-md-1"><a class="btn btn-{{$PAGE['Header']['Color']}} btn-ripple"><i class="ion-android-create"></i></a></div>
									</div>
								<!-- Description  -->
									<div class="row">
										<div class="col-md-3 r">Description</div>
										<div class="col-md-8">{{$role->description}}</div>
										<div class="col-md-1"><a class="btn btn-{{$PAGE['Header']['Color']}} btn-ripple"><i class="ion-android-create"></i></a></div>
									</div>
						</div>

						@if ($role->slug != "admin")
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
										@foreach($rps as $rp)
											<tr>
												<td>
													<div class="checkboxer checkboxer-{{$PAGE['Header']['Color']}}">
														<input class="tog_perm" id="tog_perm_{{$rp->permission->id}}" pid="{{$rp->permission->id}}" type="checkbox" value="" {{$rp->isEnabled() ? "checked" : ''}}>
														<label for="tog_perm_{{$rp->permission->id}}"></label>
													</div>
												</td>
												
												<td>{{$rp->permission->slug}}</td>
												<td>{{$rp->permission->description}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div><!--.table-responsive-->
							
							<button type="button" id="page_submit_perms" class="btn btn-default btn-lg btn-block btn-ripple">Save permissions</button>
						</div>
						@endif
						
						@if ($role->slug != "everyone")
						<div class="tab-pane" id="manage_users">
							<div class="legend">Add User</div>
							<div class="inputer inputer-{{$PAGE['Header']['Color']}}">
								<div class="input-wrapper">
									<input type="text" id="page_users_add" class="form-control" placeholder="Enter user's email or name...">
								</div>
							</div>
							
							<button type="button" id="page_add_user" class="btn btn-default btn-md btn-block btn-ripple">Add</button>
							
							<div class="legend">Currently in {{$role->name}}</div>
							<ul class="list-material has-hidden" id="user_body">
								@foreach ($role->usersInRole() as $user)
									<li class="has-action-left page-edit-user-tab" style="cursor: default; background-color: #F7F7F7;">
										<a class="hidden" style="cursor:pointer;">
											<i class="glyphicon glyphicon-trash page-user-btn" user_id="{{$user->getID()}}"></i>
										</a>

										<a href="#" class="visible" style="background-color: #F7F7F7;">
											<div class="list-action-left">
												<img src="{{ $user->getGravatar() }}" class="face-radius" alt="">
											</div>
											
											<div class="list-content" style="cursor: default">
								                <span class="title"
								                    {!! Auth::getUser()->getEmail() == $user->getEmail() ? $iMS : '' !!}> 
									                {{ $user->getName() }} 
								                </span>
													
												<span class="caption">ID: {{ $user->getID() }} | Email: {{ $user->getEmail() }}</span>
											</div>
										</a>
									</li>
								@endforeach
							</ul>
						</div>
						@endif

						{{-- You cannot delete the default roles (admin, everyone) --}}
						@if (($role->slug != "admin") && ($role->slug != "everyone"))
						<div class="tab-pane" id="manage_delete">
							<!-- Protected -->
							<div class="legend">Delete {{$role->name}}</div>
							
							<button type="button" style="width:100%;" id="page_delete_role" class="btn btn-red btn-ripple">The big red button</button>
						</div>
						@endif

					</div><!--.tab-content-->

				</div><!--.col-md-9-->
			</div><!--.row-->
		</div>
	</div>

	@include ('areas.admin.roles.res.modals')
@endsection


@section('footer')
@endsection

@section('scripts')
	
	<script src="/js/pages/admin/roles/view.js"></script>

	<script>
		Page.Role.Slug = "{{$role->slug}}";
		Page.Role.Name = "{{$role->name}}";
	</script>
	
	<style>
		.r {
			color: #999;
		}
	</style>
	
@endsection