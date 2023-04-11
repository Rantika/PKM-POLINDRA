<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- ======= Dashboard ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('reviewer.dashboard')}}" href="{{route('reviewer.dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- ======= End Sidebar ======= -->

        <!-- ======= Proposal PKM ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('reviewer.proposal')}}" href="{{route('reviewer.proposal')}}">
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
