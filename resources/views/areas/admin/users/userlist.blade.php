<?php $iMS = 'style="color: #3e50b4;"'; ?>

@foreach ($users->all() as $user)

	<li class="has-action-left code_page-edit-user-tab" style="cursor: default; background-color: #F7F7F7;">
		<a class="hidden" style="cursor:pointer;">
			<i class="glyphicon glyphicon-pencil code_page-edit-user-btn" user_id="{{$user->getID()}}"></i>
		</a>

		<a href="#" class="visible" style="background-color: #F7F7F7;">
			<div class="list-action-left">
				<img src="{{ $user->getGravatar() }}" class="face-radius" alt="">
			</div>
			<div class="list-content" style="cursor: default">
                <span
                    class="title"
	                {!! Auth::getUser()->getEmail() == $user->getEmail() ? $iMS : '' !!}
                > {{ $user->getName() }} </span>
				<span class="caption">ID: {{ $user->getID() }} | Email: {{ $user->getEmail() }}</span>
			</div>
		</a>
	</li>

@endforeach