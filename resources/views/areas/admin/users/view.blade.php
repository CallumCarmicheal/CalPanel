@extends('layouts.dashboard')
    
<?php
    $h_u_m_defaultIcon = "https://s.gravatar.com/avatar/23463b99b62a72f26ed677cc556c44e8?s=128";
    $iMS = 'style="color: #3e50b4;"';
?>

@section('content')
    <div class="page-header full-content parallax" style="height: 600px; overflow: hidden">
        <div class="parallax-bg" style="background: url('{{$user->getBackgroundImage()}}') 50% 50%; background-size: cover; width: 100%; height: 100%; position: absolute; left: 0; top: 0;">
        </div>

        <div class="profile-info">
            <div class="profile-photo">
                <img src="{{$user->getGravatar()}}" alt="">
            </div><!--.profile-photo-->
	        
            <div class="profile-text light">
                {{$user->getName()}}
                <span class="caption">{{$user->getRoles()->count() == 0 ? $user->getTitle() : $user->getHighestRole()->name }}</span>
            </div><!--.profile-text-->
        </div><!--.profile-info-->

        <div class="row">
            <div class="col-sm-6">
                <h1>User Profile <small>{{$user->getName()}}</small></h1>
            </div><!--.col-->
            <div class="col-sm-6">
                <ol class="breadcrumb">
	                @if ($PAGE['IsBCHome'])
		                <ol class="breadcrumb">
			                <li><a href="#"><i class="ion-home"></i></a></li>
		                </ol>
	                @elseif (!empty($PAGE['Breadcrumbs']))
		                <ol class="breadcrumb">
			                <li><a href="/home"><i class="ion-home"></i></a></li>

			                @foreach ($PAGE['Breadcrumbs'] as $bc)
				                <li><a href="{{$bc['Url']}}" class="{{$bc['Active'] ? 'active' : ''}}">{{$bc['Text']}}</a></li>
			                @endforeach

		                </ol>
	                @endif
                </ol>
            </div><!--.col-->
        </div><!--.row-->

        <div class="header-tabs scrollable-tabs sticky">
            <ul class="nav nav-tabs tabs-active-text-white tabs-active-border-yellow">
                <li class="active"><a href="#timeline" data-toggle="tab" class="btn-ripple">Timeline</a></li>
                <li><a href="#about" data-toggle="tab" class="btn-ripple">About</a></li>
                <li><a href="#manage" data-toggle="tab" class="btn-ripple">Manage</a></li>
            </ul>
        </div>

    </div><!--.page-header-->
    <div class="row user-profile">
	    <div class="col-md-12">
		    <div class="tab-content without-border">

				
			    @include ('areas.admin.users.tabs.timeline')
			    @include ('areas.admin.users.tabs.about')
			    @include ('areas.admin.users.tabs.manage')
			    
			    
		    </div><!--.tab-content-->
	    </div><!--.col-->
    </div><!--.row-->


@endsection


@section('footer')
@endsection

@section('scripts')
    
    <script src="/js/pages/admin/users/home.js"></script>
    
@endsection