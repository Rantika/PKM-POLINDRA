<ul class="sidebar-nav" id="sidebar-nav">

        <!-- ======= Dashboard ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('dashboard')}}" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- ======= End Dashboard ======= -->

        <!-- ======= Master Data ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('meta.*', true)}}" data-bs-target="#meta-nav" data-bs-toggle="collapse" href="">
                <i class="bi bi-journal-text"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="meta-nav" class="nav-content {{sideBarRoute('meta.*', true, true)}}" data-bs-parent="#sidebar-nav">
                <!-- ======= Jurusan ======= -->
                <li>
                    <a href="{{route('meta.group.index')}}" class="{{sideBarRoute('meta.group.index')}}">
                        <i class="bi bi-circle"></i><span>Jurusan</span>
                    </a>
                </li>
                <!-- ======= End Jurusan ======= -->

                <!-- ======= Prodi ======= -->
                <li>
                    <a href="{{route('meta.prody.index')}}" class="{{sideBarRoute('meta.prody.index')}}">
                        <i class="bi bi-circle"></i><span>Prodi</span>
                    </a>
                </li>
                <!-- ======= End Prodi ======= -->

                <!-- ======= Skema PKM ======= -->
                <li>
                    <a href="{{route('meta.scheme.index')}}" class="{{sideBarRoute('meta.scheme.index')}}">
                        <i class="bi bi-circle"></i><span>Skema PKM</span>
                    </a>
                </li>
                <!-- ======= End Skema PKM ======= -->

                <!-- ======= Plotting Reviewer ======= -->
                <li>
                    <a href="{{route('meta.reviewer.index')}}" class="{{sideBarRoute('meta.reviewer.index')}}">
                        <i class="bi bi-circle"></i><span>Plotting Reviewer</span>
                    </a>
                </li>
                <!-- ======= End Plotting Reviewer ======= -->
            </ul>
        </li>
        <!-- ======= End Master Data ======= -->

        <!-- ======= Data Akun ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('account.*', true)}}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="">
                <i class="bi bi-journal-text"></i><span>Data Akun</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content {{sideBarRoute('account.*', true, true)}}" data-bs-parent="#sidebar-nav">
                <!-- ======= Data Akun Admin ======= -->
                <li>
                    <a href="{{route('account.admin.index')}}" class="{{sideBarRoute('account.admin.index')}}">
                        <i class="bi bi-circle"></i><span>Data Akun Admin</span>
                    </a>
                </li>
                <!-- ======= End Data Akun Admin ======= -->

                <!-- ======= Data Akun Dosen ======= -->
                <li>
                    <a href="{{route('account.lecturer.index')}}" class="{{sideBarRoute('account.lecturer.index')}}">
                        <i class="bi bi-circle"></i><span>Data Akun Dosen</span>
                    </a>
                </li>
                <!-- ======= End Data Akun Dosen ======= -->

                <!-- ======= Data Akun Tim PKM ======= -->
                <li>
                    <a href="{{route('account.student.index')}}" class="{{sideBarRoute('account.student.index')}}">
                        <i class="bi bi-circle"></i><span>Data Akun Tim PKM</span>
                    </a>
                </li>
                <!-- ======= End Data Akun PKM ======= -->
            </ul>
        </li>
        <!-- ======= End Data Akun ======= -->

        <!-- ======= Data Proposal Tim PKM ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('proposal.index')}}" href="{{route('proposal.index')}}">
                <i class="bi bi-book"></i>
                <span>Data Proposal Tim PKM</span>
            </a>
        </li>
        <!-- ======= End Data Proposal Tim PKM ======= -->

        <!-- ======= Informasi Kegiatan PKM ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('information.index')}}" href="{{route('information.index')}}">
                <i class="bi bi-calendar4"></i>
                <span>Informasi Kegiatan PKM</span>
            </a>
        </li>
        <!-- ======= End Informasi Kegiatan PKM ======= -->

        <!-- ======= Berita Kegiatan PKM ======= -->
        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('news.index')}}" href="{{route('news.index')}}">
                <i class="bi bi-collection-play"></i>
                <span>Jenis Kegiatan PKM</span>
            </a>
        </li>
        <!-- ======= End Berita Kegiatan PKM ======= -->

        <li class="nav-item">
            <a class="nav-link {{sideBarRoute('setting.*', true)}}" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="">
                <i class="bi bi-gear"></i><span>Setting</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="setting-nav" class="nav-content {{sideBarRoute('setting.*', true, true)}}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('setting.view.index')}}" class="{{sideBarRoute('setting.view.index')}}">
                        <i class="bi bi-circle"></i><span>Tampilan</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('setting.period.index')}}" class="{{sideBarRoute('setting.period.index')}}">
                        <i class="bi bi-circle"></i><span>Periode</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('setting.pengaturan.index')}}" class="{{sideBarRoute('setting.pengaturan.index')}}">
                        <i class="bi bi-circle"></i><span>Waktu Upload</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('setting.waktu-review.index')}}" class="{{sideBarRoute('setting.waktu-review.index')}}">
                        <i class="bi bi-circle"></i><span>Waktu Review</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('setting.upload-revisi.index')}}" class="{{sideBarRoute('setting.upload-revisi.index')}}">
                        <i class="bi bi-circle"></i><span>Setting Upload Revisi</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
            </a>
        </li>
    </ul>