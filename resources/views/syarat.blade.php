<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PKM | Polindra</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('home/assets/img/logo.png')}}" rel="icon">
  <link href="{{asset('home/assets/img/logo.png')}}">

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

  <!-- Template Main CSS File -->
  <link href="{{asset('home/assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo d-flex justify-content-center align-items-center">
            <img src="http://pojok.test/Selecao/assets/img/polindra.png" alt="">
            <h1 class="ms-2"><a>PKM | POLINDRA</a></h1>
        </div>

        <nav id="navbar" class="navbar">
         <ul>
          <li><a class="nav-link scrollto " href="/#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="/#info">Informasi Kegiatan</a></li>
          <li><a class="nav-link scrollto" href="/#template">Template Proposal PKM</a></li>
          <li><a class="nav-link scrollto" href="#berkas">Berkas Proposal PKM</a></li>
          <li><a class="nav-link scrollto " href="/#berita">Berita Kegiatan</a></li>
          <li><a class="nav-link scrollto" href="/#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
         </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- ======= End Header ======= -->

  <!-- ======= Main ======= -->
  <main id="main">

    <!-- ======= Syarat Section ======= -->
    <section id="template" class="features mt-5">
        <div class="container">
                <a class="btn tombol-kembali" href="/#template">
                    <i class="bi bi-box-arrow-right text-kembali">
                    <span>Kembali</span>
                    </i>
                </a>

            <div class="section-title pb-0 mt-4" data-aos="zoom-out">
                <p>{{$schemes->short}}</p>
            </div>

              <div class="tab-content" data-aos="fade-up">
                <div class="tab-pane active show" id="tab-1">
                    <div class="row" style="text-align: justify">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" >
                            {!! $schemes->description !!}
                        </div>
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" >
                            {!! $schemes->condition !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- ======= End Syarat Section ======= -->

  </main>
  <!-- ======= End Main ======= -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
        <h4>Pojok Kemahasiswaan Politeknik Negeri Indramayu</h4>
        <div class="social-links">
            <a href="https://web.facebook.com/Politeknik.Negeri.Indramayu" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/politekniknegeriindramayu/" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCIuz_Wn_39fnHhLMIwlxQlA" class="youtube"><i class="bx bxl-youtube"></i></a>
        </div>
        <div class="copyright">
            &copy; Copyright <strong><span>Pojok Kemahasiswaan Politeknik Negeri Indramayu</span></strong>.
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

  <!-- Template Main JS File -->
  <script src="{{asset('home/assets/js/main.js')}}"></script>

</body>

</html>
