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

        <!-- ======= Bimbingan ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('student.bimbingan.index')}}" href="{{route('student.bimbingan.index')}}">
                <i class="bi bi-calendar4"></i>
                <span>Bimbingan</span>
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

        <!-- ======= Forum ======= -->
        <li class="nav-item">
                    <a class="nav-link collapsed {{sideBarRoute('forum.index')}}" href="{{route('forum.index')}}" >
                        <i class="bi bi-book"></i>
                        <span>Forum</span>
                    </a>
                </li>
                <!-- ======= Forum ======= -->


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
