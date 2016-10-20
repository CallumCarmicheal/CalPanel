@extends ('layouts.admin_bootstrap')

{{-- Per page navbar --}}
@section ('navbar')
@endsection

{{-- Per page scripts --}}
@section ('scripts')
<script src="/js/pages/admin/users/home.js"></script>
@endsection

{{-- Per page style sheets --}}
@section ('styles')
@endsection

{{-- Page content --}}
@section ('content')
<div class="container">

    <div class="checkbox">
        <label> <input type="checkbox" id="chkb_rts"> Realtime search </label>
    </div>
    <small>Press enter to search, Enable realtime searching or Press go to open reload the page with the query.</small>
    <div class="input-group">
        <input id="query_input" type="text" class="form-control" placeholder="Search for..." value="{{$query or ''}}">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="query_go">Go!</button>
        </span>
    </div><!-- /input-group -->

    <br/>

    <span>Table Key:</span><br>
    <ind/><small># = User ID, Name = User's Name, Email = User's Email Address, </small><br/>
    <ind/><small>Date Join = Date the user joined, Last Edited = Date the user was last modifed</small> <br/>
    <br/><br/>

    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date Joined</th>
            <th>Last Edited</th>
            <th></th>
        </thead>

        <tbody id="user_body">
            <!-- 
                Loop through all our users
                and print their passwords in plain
                text for l33t h4x0rs to see!

                How does one do this T_T
             -->

            @foreach ($users->all() as $user) 
                <tr id="user_row_{{$user->getID()}}">
                    <td>{{$user->getID()}}</td>
                    <td>{{$user->getName()}}</td>
                    <td>{{$user->getEmail()}}</td>
                    <td>{{$user->getDateCreated()}}</td>
                    <td>{{$user->getDateUpdated()}}</td>
                    <td>
                        <!-- Make glyths/icons with options --> 
                        <a href="{{ url('/admin/user') }}/{{ $user->getID() }}">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>

                        <a href="#" onclick="Page.API.DeleteUser({{$user->getID()}}, '{{$user->getName()}}');">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection