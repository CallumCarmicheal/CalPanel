@extends('layouts.dashboard')

@section('content')
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
				Could not find the requested Role
			</div>
		</div>
		<div class="panel-body without-padding">
			<p>
				The requested role (slug:{{$slug}}) could not be found.
			</p>
			<p>
				The role may of been deleted between the time you have typed, clicked or viewed this page.
			</p>
			<p>
				The role may of never existed and the slug:{{$slug}} maybe mis-typed or incorrect please revise over it.
			</p>
			<br/>

			
		</div>
	</div>
@endsection


@section('footer')
@endsection

@section('scripts')

	<script>
		$(function() {
			$('#page_goback').on('click', function() {
				
				var url = Laravel.RootURL + "admin/roles";
				window.location = url;
								
			});
		});
	</script>
	
@endsection