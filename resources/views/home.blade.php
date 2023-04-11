<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> {{ $configs->where('name', 'short')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'short')->first()->value }} | Polindra | @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" rel="icon">
  <link href="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('home/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

  <!-- Template Main CSS File -->
  <link href="{{asset('home/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/datatables/datatables.min.css')}}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo d-flex justify-content-center align-items-center">
            <img src="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" alt="">
            <h1 class="ms-2"><a>PKM | POLINDRA</a></h1>
        </div>

        <nav id="navbar" class="navbar">
         <ul>
          <li><a class="nav-link scrollto " href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#info">Informasi Kegiatan</a></li>
          <li><a class="nav-link scrollto" href="#template">Template Proposal PKM</a></li>
          <li><a class="nav-link scrollto" href="#berkas">Berkas Proposal PKM</a></li>
          <li><a class="nav-link scrollto " href="#berita">Berita Kegiatan</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
         </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
  </header>
  <!-- ======= End Header ======= -->

  {{-- ======= Beranda Section ======= --}}
  <section id="hero" class=" d-flex flex-column justify-content-end align-items-center">
    <div class="col-md-6 mt-5 gambar">
        <img src="{{ asset('home/assets/img/gedung.png')}}" alt="" class="animate__animated animate__fadeInDown gambarpolindra">
        <div class="isi">
            <div class="row mt-5 isi2" >
                <div class="col-md-6 mt-5">
                    {{-- <h2 class="animate__animated animate__fadeInDown">{{ $view_setting->name }}</h2>
                    <p class="mx-0 w-100 animate__animated animate__fadeInDown">{{ $view_setting->description }}</p> --}}
                    <h2 class="animate__animated animate__fadeInDown">{{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }} <br> Politeknik Negeri Indramayu</h2>
                    <p class="mx-0 w-100 animate__animated animate__fadeInDown">{{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }} Politeknik Negeri Indramayu merupakan sebuah aplikasi mengenai kegiatan Program Kreativitas Mahasiswa (PKM). PKM merupakan salah satu program yang dijalankan oleh Direktorat Penelitian dan Pengabdian kepada Masyarakat (Ditlitabmas) Direktorat Jenderal Pendidikan Tinggi (Ditjen DIKTI) Kemdikbud untuk meningkatkan mutu peserta didik (mahasiswa) di perguruan tinggi.</p>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- ======= End Beranda Section ======= -->

  <!-- ======= Main Section ======= -->
  <main id="main">

    <!-- ======= Informasi Kegiatan Section ======= -->
    @if(count($informations) > 0)
    <section class="about-lists" id="info">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Informasi Kegiatan</h2>
                <p>Timeline Kegiatan</p>
            </div>

            <div class="row no-gutters">
                @foreach($informations as $data)
                <div class="col-lg-4 col-md-6 content-item mt-3" data-aos="zoom-in">
                    <h4>{{$data->name}}</h4>
                    <p>{{$data->open_time}} - {{$data->close_time}}</p>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif
    <!-- ======= End Informasi Kegiatan Section ======= -->

    <!-- ======= Template Proposal PKM Section ======= -->
    @if(count($schemes) > 0)
    <section id="template" class="services">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
               <h2>Dokumen PKM</h2>
               <p>Template Proposal PKM</p>
            </div>

            <div class="row" style="text-align: justify">
                @php
                $icons = ['bi-briefcase', 'bi-book', 'bi-card-checklist', 'bi-binoculars', 'bi-globe', 'bi-clock'];
                $colors = ['#ff689b', '#e9bf06', '#3fcdc7', '#41cf2e', '#d6ff22', '#4680ff'];
                @endphp
                @foreach($schemes as $data)
                <div class="col-lg-4 col-md-4 mt-3">
                    <div class="icon-box" data-aos="zoom-in-left" data-aos-delay='100'>
                        <div class="icon"><i class="bi {{$icons[rand(0,5)]}}" style="color: {{$colors[rand(0,5)]}};"></i></div>
                        <h4 class="title"><a href="#">{{$data->short}}</a></h4>
                        <p class="description">{{$data->description}}</p>
                        <div class="text-center mt-5">
                            <a href="{{$data->file ? asset($data->file) : '#services'}}" target="{{$data->file ? '_blank' : '_self'}}" class="btn btn-{{$data->file ? 'primary' : 'warning'}}" style="position: absolute;bottom: 25px;left: 35%;">{{$data->file ? 'Download' : 'Coming Soon'}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif
    <!-- ======= End Template Proposal PKM Section ======= -->

    <!-- ======= Berkas Proposal PKM Section ======= -->
    <section id="berkas" class="services">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
               <h2>Dokumen PKM</h2>
               <p>Berkas Proposal PKM</p>
            </div>

            <div class="card">
                <div class="card-body pt-4">

            <div class="table-responsive">
                <!-- ======= Data Table ======= -->

                <table id="tab_dokumen" class="table table-striped datatable nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Mahasiswa</th>
                            <th class="text-center">Jurusan</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Skema</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!-- ======= End Data Table ======= -->
            </div>

        </div>
    </div>

        </div>
    </section>
    <!-- ======= End Template Proposal PKM Section ======= -->

    <!-- ======= Berita Kegiatan Section ======= -->
    @if(count($news) > 0)
    <section id="berita" class="portfolio">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
                <h2>Berita Kegiatan</h2>
                <p>Berita kegiatan Program Kreativitas Mahasiswa (PKM) di Politeknik Negeri Indramayu</p>
            </div>

            <ul id="portfolio-flters" class="d-flex justify-content-end d-none" data-aos="fade-up">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-app">App</li>
                <li data-filter=".filter-card">Card</li>
                <li data-filter=".filter-web">Web</li>
            </ul>

            <div class="row portfolio-container" data-aos="fade-up">
                @foreach($news as $data)
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img"><img src="{{asset($data->photo)}}" class="img-fluid" alt=""></div>
                    <div class="portfolio-info">
                        <h4>{{$data->title}}</h4>
                        {!! $data->description ? substr($data->description, 0, 50).' ...' : '-' !!}
                        <a href="{{route('home.detail', $data->id)}}" class="preview-link" title="{{$data->title}}"><i class="bx bx-detail"></i></a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif
    <!-- ======= End Berita Kegiatan Section ======= -->

    <!-- ======= Tentang Kami Section ======= -->
    <section id="about" class="features">
        <div class="container">

            <div class="section-title pb-0" data-aos="zoom-out">
                <h2>Tentang Kami</h2>
                <p>{{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }} Politeknik Negeri Indramayu</p>
            </div>

            <div class="tab-content" data-aos="fade-up">
                <div class="tab-pane active show" id="tab-1">
                    <div class="row">
                        <div class="col-lg-7 order-2 order-lg-1 mt-3 mt-lg-0" >
                            <p style="text-align: justify">
                                {{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }} merupakan sebuah aplikasi mengenai kegiatan Program Kreativitas Mahasiswa (PKM). PKM merupakan salah satu program yang dijalankan oleh Direktorat Penelitian dan Pengabdian kepada Masyarakat (Ditlitabmas) Direktorat Jenderal Pendidikan Tinggi (Ditjen DIKTI) Kemdikbud untuk meningkatkan mutu peserta didik (mahasiswa) di perguruan tinggi.
                            </p>
                            <p style="text-align: justify">
                                Politeknik Negeri Indramayu merupakan salah satu perguruan tinggi negeri
                                yang ikut serta dalam kegiatan Program Kreativitas Mahasiswa (PKM).
                            </p>
                            <p style="text-align: justify">
                                Terdapat beberapa jenis Program Kreativitas Mahasiswa (PKM) yang ditawarkan, yaitu
                            </p>
                            <ul>
                                @foreach($schemes as $data)
                                <li><i class="ri-check-double-line"></i> {{$data->name}}</li>
                                @endforeach
                            </ul>
                            <p style="text-align: justify">Seluruh bidang Program Kreativitas Mahasiswa (PKM) akan bermuara di Pekan Ilmiah Mahasiswa Nasional (PIMNAS).</p>
                        </div>
                        <div class="col-lg-5 order-1 order-lg-2 text-center" style="justify-content-right">
                            <img src="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ======= End Tentang Kami Section ======= -->

    </main>
    <!-- ======= End Main Section ======= -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
        <h4>{{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }} Politeknik Negeri Indramayu</h4>
        <div class="social-links">
            <a href="https://web.facebook.com/Politeknik.Negeri.Indramayu" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/politekniknegeriindramayu/" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCIuz_Wn_39fnHhLMIwlxQlA" class="youtube"><i class="bx bxl-youtube"></i></a>
        </div>
        <div class="copyright">
            &copy; Copyright <strong><span>{{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }} Politeknik Negeri Indramayu</span></strong>.
        </div>
    </div>
  </footer>
  <!-- ======= End Footer ======= -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('home/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('home/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('home/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('home/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('home/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery/jquery-3.6.1.min.js')}}"></script>
  <script src="{{asset('assets/datatables/datatables.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('home/assets/js/main.js')}}"></script>
  <script>
    $('#tab_dokumen').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        ajax: "{{ route('home') }}",
        columns: [
            {"width": "5%", data: 'DT_RowIndex', name: 'id'},
            {data: 'year', name: 'year'},
            {data: 'nama_mahasiswa', name: 'nama_mahasiswa'},
            {data: 'jurusan_mahasiswa', name: 'jurusan_mahasiswa'},
            {data: 'title', name: 'title'},
            {data: 'skema', name: 'skema'},
         
            // {"width": "12%", data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        "lengthMenu": [10, 20, 50, 100],
        "pageLength": 10
    });
</script>

</body>

</html>

