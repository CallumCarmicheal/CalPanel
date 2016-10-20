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

    <!--
        id          -> RO -> # ID
        name        -> RW -> Full Name
        email       -> RW -> Email Address
        password    -> OP -> [Set Password, Set to temporary pass & email to user]
        created_at  -> RO -> Date Created
        updated_at  -> RO -> Last time updated @
        roles
     -->
    
</div>
@endsection