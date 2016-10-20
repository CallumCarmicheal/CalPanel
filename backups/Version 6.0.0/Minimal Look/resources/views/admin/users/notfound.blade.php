@extends ('layouts.admin_minimal')

@section ('content')

<div class="content">
    <div class="title m-b-md"> User not found <small>{{$id}}</small> </div>
    
    <div class="links">
        <a href="{{ url('/admin/users') }}">Back to User list</a>
    </div>
</div>

@endsection