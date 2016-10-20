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
