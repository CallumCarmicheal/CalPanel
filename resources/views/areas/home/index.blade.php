@extends('layouts.dashboard')

@section('content')

	<div class="display-animation"> <div class="row image-row">
			<div class="material-animate material-animated" style="animation-delay: 0.35s;">
				
				@if (Auth::user()->hasRoles())
					Your current rank is: {{Auth::user()->getHighestRole()->name}} <br>

					All users with that role are: <br>
					
					@foreach (Auth::user()->getHighestRole()->usersInRole() as $user) 
						<p> {{$user->name}} </p>
					@endforeach
				@else
					<p> You have not been assigned a role yet! </p>
				@endif
				
				<p>
					Skype: {{$user->Contact()->getSkype()}}
				</p>
				
				{{-- 
					Okay i need to check if a role has a permission attached to it...
					Oh boy time to dig through docs and if its not there make them :)
				--}}
				
				<br>
				<Br>
				<br>
			</div>
		</div>
	</div>
	
@endsection


@section('footer')
@endsection