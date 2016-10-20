@foreach ($roles->all() as $role)
	
	<li class="has-action-left code_page-edit-user-tab" style="cursor: default; background-color: #F7F7F7;">
		<a class="hidden" style="cursor:pointer;">
			<i class="glyphicon glyphicon-pencil code_page-edit-user-btn" user_id="{{$role->slug}}"></i>
		</a>

		<a href="#" class="visible" style="background-color: #F7F7F7;">
			<div class="list-content" style="cursor: default">
                <span class="title"> {{ $role->name }} </span>
				<span class="caption">SLug: {{ $role->slug }} | Level: {{ $role->level }} | Desc: {{ $role->description }}</span>
			</div>
		</a>
	</li>

@endforeach