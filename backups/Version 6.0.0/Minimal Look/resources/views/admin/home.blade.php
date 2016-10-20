@extends ('layouts.admin_minimal')

@section ('content')

<div class="content">
    <div class="title m-b-md"> CPv6 <small>Admin</small> </div>

    <div class="links">
        <a href="{{ url('/admin/users') }}">Users</a>
        <a href="#">Site Administration</a>
       	<a href="#">Logs</a>
        <br><br>
        <a href="#">??</a>
        <a href="#">??</a>
        <a href="#">??</a>
        <a href="#">??</a> 
    </div>
</div>

@endsection