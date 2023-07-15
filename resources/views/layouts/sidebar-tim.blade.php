<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- ======= Dashboard ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('student.index')}}" href="{{route('student.index')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- ======= End Dashboard ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('student.tim.index')}}" href="{{route('student.tim.index')}}">
                <i class="bi bi-calendar4"></i>
                <span>Anggota Tim</span>
            </a>
        </li>
        <!-- ======= End Bimbingan ======= -->
        
        <!-- ======= Proposal PKM ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('student.proposal')}}" href="{{route('student.proposal')}}">
                <i class="bi bi-book"></i>
                <span>Proposal PKM</span>
            </a>
        </li>
        <!-- ======= End Proposal PKM ======= -->
        
        <!-- Fitur Komentar Proposal -->
        <li class="nav-item">
            <a class="nav-link  {{sideBarRoute('team.komentar-proposal')}}" href="{{ url('/team/komentar-proposal') }}">
                <i class="bi bi-book"></i>
                <span>Komentar Proposal</span>
            </a>
        </li>
        <!-- Komentar Proposal -->

        <!-- ======= Logout ======= -->
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
