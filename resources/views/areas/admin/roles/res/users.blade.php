<?php $iMS = 'style="color: #3e50b4;"'; ?>

@foreach ($users as $user)

	<li class="has-action-left code_page-users-tab" style="cursor: default;">
		<a class="hidden" style="cursor:pointer;">
			<i class="glyphicon glyphicon-plus code_page-users-add" user_id="{{$user->getID()}}"></i>
		</a>

		<a href="#" class="visible" style="">
			<div class="list-action-left">
				<img src="{{ $user->getGravatar() }}" class="face-radius" alt="">
			</div>
			<div class="list-content" style="cursor: default">
                <span
                    class="title"
	                {!! Auth::getUser()->getEmail() == $user->getEmail() ? $iMS : '' !!}
                > {{ $user->getName() }} </span>
				<span class="caption">ID: {{ $user->getID() }} | Highest Role: {{ $user->getHighestRole()->slug }} | Email: {{ $user->getEmail() }}</span>
			</div>
		</a>
	</li>

@endforeach