<header id="header" class="header fixed-top d-flex align-items-center">

    <!-- ======= Title ======= -->
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
            <img src="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" alt="">
            <span class="d-none d-lg-block">PKM | Polindra</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- ======= End Title ======= -->

    <!-- ======= Navbar ======= -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <!-- ======= Notifikasi ======= -->
            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="" data-bs-toggle="dropdown" id="notif-button">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-danger badge-number" id="new-data"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="width: 350px !important;" id="notif"></ul>

            </li>
            <!-- ======= End Notifikasi ======= -->

            <!-- ======= Profil  ======= -->
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{asset('assets/img/user-icon.png')}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        @if(Auth::user()->usersrole->role == "Admin")
                            {{ Auth::user()->admin->name }}
                        @elseif(Auth::user()->usersrole->role == "Dosen Pembimbing")
                            {{ Auth::user()->lecturer->name }}
                        @elseif(Auth::user()->usersrole->role == "Student")
                            {{ Auth::user()->student->name }}
                        @endif
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                        @if(Auth::user()->usersrole->role == "Admin")
                            {{ Auth::user()->admin->name }}
                        @elseif(Auth::user()->usersrole->role == "Dosen Pembimbing")
                            {{ Auth::user()->lecturer->name }}
                        @elseif(Auth::user()->usersrole->role == "Student")
                            {{ Auth::user()->student->name }}
                        @endif
                        </h6>
                        <span>
                        @if(Auth::user()->usersrole->role == "Admin")
                            {{ Auth::user()->usersrole->role }}
                        @elseif(Auth::user()->usersrole->role == "Dosen Pembimbing")
                            {{ Auth::user()->usersrole->role }}
                        @elseif(Auth::user()->usersrole->role == "Student")
                            {{ Auth::user()->usersrole->role }}
                        @endif
                        </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>

            </li>
            <!-- ======= End Profil ======= -->

        </ul>
    </nav>
    <!-- ======= End Navbar ======= -->

</header>
