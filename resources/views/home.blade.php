<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> {{ $configs->where('name', 'short')->first() == null ? 'Program Kreativitas Mahasiswa' : $configs->where('name', 'short')->first()->value }} | Polindra | @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/kampus-merdeka.png' : $configs->where('name', 'logo')->first()->file) }}" rel="icon">
  <link href="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/.png' : $configs->where('name', 'logo')->first()->file) }}">

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
  <link href="{{asset('home/assets/css/stylee.css')}}" rel="stylesheet">
  <link href="{{asset('assets/datatables/datatables.min.css')}}" rel="stylesheet">
  <style type="text/css">
    
  </style>  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center " style="background-color: #23B6E4">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo d-flex justify-content-center align-items-center">
            <img src="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" alt="">
            <h1 class="ms-2"><a>PKM|POLINDRA</a></h1>
        </div>

        <nav id="navbar" class="navbar">
         <ul>
          <li><a class="nav-link scrollto " href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#info">Informasi Kegiatan</a></li>
          <li><a class="nav-link scrollto" href="#template">Jenis PKM</a></li>
          <li><a class="nav-link scrollto" href="#berita">Tahap Pendaftaran</a></li>
          <li><a class="nav-link scrollto" href="#berkas">Tim</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
         </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        
    </div>

  </header>
  <hr>
  <!-- ======= End Header ======= -->

  {{-- ======= Beranda Section ======= --}}
  <section id="hero" class=" d-flex flex-column justify-content-end align-items-center" style="background-color: #D9D9D9;">
    <div class="col-md-6 mt-5 gambar">
        <img src="{{ asset('home/assets/img/logo-pkm.png')}}" alt="" class="animate__animated animate__fadeInDown gambarpolindra">
        <div class="isi">
            <div class="row mt-5 isi2" >
                <div class="col-md-6 mt-5">
                    {{-- <h2 class="animate__animated animate__fadeInDown">{{ $view_setting->name }}</h2>
                    <p class="mx-0 w-100 animate__animated animate__fadeInDown">{{ $view_setting->description }}</p> --}}
                    <h2 class="animate__animated animate__fadeInDown" style="color:#fff">{{ $configs->where('name', 'name')->first() == null ? 'Apa itu PKM?' : $configs->where('name', 'name')->first()->value }} <br></h2>
                    <p class="mx-0 w-100 animate__animated animate__fadeInDown" style="color:#ffff">{{ $configs->where('name', 'name')->first() == null ? 'Program Kreatifitas Mahasiswa' : $configs->where('name', 'name')->first()->value }}  Program Kreativitas Mahasiswa adalah kegiatan untuk
                        meningkatkan mutu peserta didik (mahasiswa) di
                        perguruan tinggi agar kelak dapat menjadi anggota
                        masyarakat yang memiliki kemampuan akademik dan
                        profesional yang dapat menerapkan,mengembangkan, dan
                        menyebarluaskan ilmu pengetahuan, teknologi atau
                        kesenian serta memperkaya budaya nasional.</p>
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
    <section class="about-lists" id="info" style="background-color: #264E6B;">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2 style="color: #ffff;">Informasi Kegiatan</h2>
                <p style="color: #ffff;">Timeline Kegiatan</p>
            </div>

            <div class="row no-gutters" >
                @foreach($informations as $data)
                <div class="col-lg-4 col-md-6 content-item mt-3" data-aos="zoom-in">
                    <h4 style="color: #ffff;">{{$data->name}}</h4>
                    <p style="color: #ffff;">{{$data->open_time}} - {{$data->close_time}}</p>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif
    <!-- ======= End Informasi Kegiatan Section ======= -->

    <!-- ======= Jenis Proposal PKM Section ======= -->
    @if(count($news) > 0)
    <section id="template" class="services" style="background-color: #ffff">
    <div class="container py-5">
                <div class="mb-5">
                    <h4 class="text-center text-black"  >
                        JENIS PKM YANG DI LOMBAKAN
                    </h4>
                    <p class="text-center text-black">Terdapat Beberapa Bidang</p>
                </div>
                <div class="row">
                @foreach($news as $data)
                    <div class="col-md-6 col-lg-3 mb-4" >
                        <div class="card">
                            <div class="card-body text-center"style="background-color: #D9D9D9" >
                                <img src="{{asset($data->photo)}}" height="65" alt="" class="mb-2" />
                                <h5 class="mb-0">{{$data->title}}</h5>
                                <p class="mb-0"> {!! $data->description ? substr($data->description, 0, 50).'' : '-' !!}</p>
                                <a href="{{route('home.detail', $data->id)}}" class="preview-link" title="{{$data->title}}"><i class=""></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </section>
    @endif

     <!-- ======= Tahapan pkm ======= -->
    
     <section  id="berita" style="background-color: #264E6B">
     <div class="container py-5 my-5">
                <h4 class="text-center mb-5" style="color: #ffff;">TAHAPAN PENDAFTARAN</h4>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="">
                            <div class="text-center">
                                <img src="{{ asset('image/gambar-sosialiasi.png')}}" height="140" alt="" class="mb-2" />
                                <h5 class="mb-0" style="color: #ffff;" >1.Sosialiasi</h5>

                                <p class="mb-0" style="color: #ffff;">
                                    Sosialisasi yang dilakukan oleh TIM PKM
                                    Polindra
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="">
                            <div class="text-center">
                                <img src="{{ asset('image/gambar-pengajuan-judul.png')}}" height="140" alt=""
                                    class="mb-2" />
                                <h5 class="mb-0" style="color: #ffff;">2.Pengajuan Judul</h5>

                                <p class="mb-0" style="color: #ffff;">
                                    Pengajuan Judul Proposal Yang dilakuakan
                                    oleh Mahasiswa
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="">
                            <div class="text-center">
                                <img src="{{ asset('image/gambar-penilaian-judul.png')}}" height="140" alt=""
                                    class="mb-2" />
                                <h5 class="mb-0" style="color: #ffff;">3.Penilaian Judul</h5>

                                <p class="mb-0" style="color: #ffff;">
                                    Penilaian Judul Proposal Yang dilakuakan
                                    oleh Dosen Pembimbing dan Tim PKM
                                    Polindra
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="">
                            <div class="text-center">
                                <img src="{{ asset('image/gambar-pengajuan-proposal.png')}}" height="140" alt=""
                                    class="mb-2" />
                                <h5 class="mb-0" style="color: #ffff;">4.Pengajuan Proposal</h5>

                                <p class="mb-0" style="color: #ffff;">
                                    Apabila Judul Disetujui Mahasiswa daoat
                                    mengajukan Proposal PKM
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="">
                            <div class="text-center">
                                <img src="{{ asset('image/gambar-penilaian-judul.png')}}" height="140" alt=""
                                    class="mb-2" />
                                <h5 class="mb-0" style="color: #ffff;">5.Penilaian Proposal</h5>

                                <p class="mb-0" style="color: #ffff;">
                                    Penilaian Proposal Yang dilakukan Dosen
                                    Pembimbing dan Tim PKM Polindra
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="">
                            <div class="text-center">
                                <img src="{{ asset('image/gambar-penilaian-judul.png')}}" height="140" alt=""
                                    class="mb-2" />
                                <h5 class="mb-0" style="color: #ffff;">6.Revisi Proposal</h5>

                                <p class="mb-0" style="color: #ffff;">
                                    Revisi proposal yang dilakukan oleh mahasiswa 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="">
                            <div class="text-center">
                                <img src="{{ asset('image/proposal-disetujui.png')}}" height="140" alt="" class="mb-2" />
                                <h5 class="mb-0" style="color: #ffff;">
                                    6.Propsal PKM Disetujui
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
   
  
    <!-- ======= Akhir Tahapan PKM ======= -->

    <!-- ======= Berkas Proposal PKM Section ======= -->
    <section id="berkas" class="services" style="background-color: #D9D9D9;">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
               <h2>Ikut serta Mahasiswa </h2>
               <p>Mahasiswa yang mengikuti kegiatan PKM</p>
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
                            <th class="text-center">Ketua Tim</th>
                            <th class="text-center">Dosen Pembimbing</th>
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
    <!-- ======= Tentang Kami Section ======= -->
   
    <section id="about" class="features" style="background-color: #ffff;">
        <div class="container">

            <div class="section-title pb-0" data-aos="zoom-out">
                <h2>Tentang Kami</h2>
                <p>{{ $configs->where('name', 'name')->first() == null ? 'Program Kreatifitas Mahasiswa' : $configs->where('name', 'name')->first()->value }} Politeknik Negeri Indramayu</p>
            </div>

            <div class="tab-content" data-aos="fade-up">
                <div class="tab-pane active show" id="tab-1">
                    <div class="row">
                        <div class="col-lg-7 order-2 order-lg-1 mt-3 mt-lg-0" >
                            <p style="text-align: justify" >
                                {{ $configs->where('name', 'name')->first() == null ? 'Aplikasi ini' : $configs->where('name', 'name')->first()->value }} merupakan sebuah aplikasi mengenai kegiatan Program Kreativitas Mahasiswa (PKM). PKM merupakan salah satu program yang dijalankan oleh Direktorat Penelitian dan Pengabdian kepada Masyarakat (Ditlitabmas) Direktorat Jenderal Pendidikan Tinggi (Ditjen DIKTI) Kemdikbud untuk meningkatkan mutu peserta didik (mahasiswa) di perguruan tinggi.
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
  <footer id="footer" style="background-color: #23B6E4;">
    <div class="container">
        <h4>{{ $configs->where('name', 'name')->first() == null ? 'Program Kreatifitas Mahasiswa' : $configs->where('name', 'name')->first()->value }} Politeknik Negeri Indramayu</h4>
        <div class="social-links">
            <a href="https://web.facebook.com/Politeknik.Negeri.Indramayu" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/politekniknegeriindramayu/" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCIuz_Wn_39fnHhLMIwlxQlA" class="youtube"><i class="bx bxl-youtube"></i></a>
        </div>
        <div class="copyright">
            &copy; Copyright <strong><span>{{ $configs->where('name', 'name')->first() == null ? 'PKM ' : $configs->where('name', 'name')->first()->value }} POLINDRA</span></strong>.
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
            {data: 'lecturer', name: 'lecturer'},
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

