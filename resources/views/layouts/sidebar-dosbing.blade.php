<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- ======= Sidebar Dosbing ======= -->
        @if(Auth::user()->lecturer)
        <li class="nav-heading">Dosen Pembimbing</li>

        <!-- ======= Dashboard ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('lecturer.index')}}" href="{{route('lecturer.index')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- ======= End Dashboard ======= -->

        <!-- ======= Proposal PKM ======= -->
        <li class="nav-item">
            <a href="{{ route('lecturer.acc') }}" class="nav-link {{ sideBarRoute('lectuter.acc') }} ">
                <i class="bi bi-book"></i>
                <span>Bimbingan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('lecturer.proposal')}}" href="{{route('lecturer.proposal')}}">
                <i class="bi bi-book"></i>
                <span>Proposal PKM</span>
            </a>
        </li>
        <!-- ======= End Proposal PKM ======= -->
        <!-- ======= Forum ======= -->
        <li class="nav-item">
            <a class="nav-link collapsed {{sideBarRoute('forum.index')}}" href="{{route('forum.index')}}">
                <i class="bi bi-book"></i>
                <span>Forum</span>
            </a>
        </li>
        <!-- ======= Forum ======= -->
        <!-- ======= Simbelmawa ======= -->
        @if(Auth::user()->lecturer)
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('lecturer.simbelmawa')}}" href="{{route('lecturer.simbelmawa')}}">
                <i class="bi bi-person-badge"></i>
                <span>Akun Simbelmawa</span>
            </a>
        </li>
        @endif
        <!-- ======= End Simbelmawa ======= -->
        @endif
        <!-- ======= End Sidebar Dosbing ======= -->

        <!-- ======= Sidebar Reviewer ======= -->
        @if(Auth::user()->lecturer)
        <li class="nav-heading">Reviewer</li>

        <!-- ======= Dasboard ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('reviewer.index')}}" href="{{route('reviewer.index')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- ======= End Dashboard ======= -->

        <!-- ======= Review Proposal PKM ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('reviewer.proposal')}}" href="{{route('reviewer.proposal')}}">
                <i class="bi bi-book"></i>
                <span>Review Proposal PKM</span>
            </a>
        </li>
        <!-- ======= End Review Proposal PKM ======= -->
        @endif
        <!-- ======= End Sidebar Reviewer ======= -->

        <!-- ======= Logout ======= -->
        <li class="nav-heading">General</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
            </a>
        </li>
        <!-- ======= End Logout ======= -->
    </ul>

</aside>
<!-- ======= End Sidebar ======= -->