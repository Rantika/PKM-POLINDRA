<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    @if(Auth::user()->usersrole->role == "Admin")
        @include("layouts.sidebar-admin")
    @elseif(Auth::user()->lecturer)
        @include("layouts.sidebar-dosbing")
    @elseif(Auth::user()->student)
        @include("layouts.sidebar-tim")
    @endif

</aside>
<!-- ======= End Sidebar ======= -->
