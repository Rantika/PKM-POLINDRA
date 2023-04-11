<!DOCTYPE html>
<html lang="en">
  @php
    $configs = initConfig();
  @endphp
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> {{ $configs->where('name', 'short')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'short')->first()->value }} | Polindra | @yield('title')</title>
  <meta name="_token" content="{{csrf_token()}}" />
  
  <!-- Favicons -->
  <link href="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" rel="icon">
  <link href="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/simple-datatables/datatable.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/loading.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <style>
      .img-table{
         border-radius: 5px;
         max-width: 60px;
      }
  </style>
  @yield('css')
</head>

<body>
<div class="loading"></div>
  <!-- ======= Header ======= -->
    @include('layouts.navbar')
  <!-- ======= End Header ======= -->

  <!-- ======= Sidebar ======= -->
  @if(Auth::user()->role === 'admin')
      @include('layouts.sidebar')
  @elseif(Auth::user()->role === 'student')
      @include('layouts.sidebar-tim')
  @elseif(Auth::user()->role === 'reviewer')
      @include('layouts.sidebar-reviewer')
  @elseif(Auth::user()->role === 'lecturer')
      @include('layouts.sidebar-dosbing')
  @endif
  <!-- ======= End Sidebar ======= -->

  <!-- ======= Main ======= -->
  <main id="main" class="main">

      @yield('breadcumb')

      @yield('content')

  </main>
  <!-- ======= End Main ======= -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>{{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }} Politeknik Negeri indramayu.</span></strong>
    </div>
  </footer>
  <!-- ======= End Footer ======= -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
  <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/datatable.min.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/datatable.bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{asset('assets/js/moment.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script>
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      function fadeIn() {
          $('.loaded').addClass('loading')
          $('.loaded').removeClass('loaded')
      }

      function fadeOut() {
          $('.loading').addClass('loaded')
          $('.loading').removeClass('loading')
      }

      function generateChart(id, year, total, ) {
          new ApexCharts(document.querySelector(`#${id}`), {
              series: [{
                  name: 'Peserta',
                  data: total
              }],
              xaxis: {
                  type: 'category',
                  categories: year
              },
              chart: {
                  height: 350,
                  type: 'area',
                  toolbar: {
                      show: false
                  },
              },
              markers: {
                  size: 4
              },
              colors: ['#4154f1'],
              fill: {
                  type: "gradient",
                  gradient: {
                      shadeIntensity: 1,
                      opacityFrom: 0.3,
                      opacityTo: 0.4,
                      stops: [0, 90, 100]
                  }
              },
              dataLabels: {
                  enabled: false
              },
              stroke: {
                  curve: 'straight',
              }
          }).render();
      }

      function fetchdata(){
          $.ajax({
              url: `{{route('get.notif', Auth::user()->id)}}`,
              success: function(response){
                  $('#notif').html('');

                  $('#notif').append(`
                    <li class="dropdown-header" id="notif-header">
                        You have ${response.new} new notifications
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                  `);

                  response.data.map(function (item) {
                      $('#notif').append(`
                        <li class="notification-item" style="${item.is_read ? '' : 'background: aliceblue'}">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>${item.title}</h4>
                                <p>${item.body}</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                      `)

                  });
                  $('#notif').append(`
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>
                  `)

                  if(response.new){
                      $('#new-data').removeClass('d-none')
                      $('#new-data').html(response.new)
                  }else{
                      $('#new-data').addClass('d-none')
                  }
              },
              complete:function(data){
                  setTimeout(fetchdata,5000);
              }
          });
      }

      $(document).ready(function () {
          fadeOut()
          setTimeout(fetchdata,100);

          $('#notif-button').on('click', function () {
              $.ajax({
                  url: `{{route('update.notif', Auth::user()->id)}}`,
                  success: function(response){
                      $('#new-data').addClass('d-none')
                  },
              });
          })
      })
  </script>
  @yield('js')

</body>

</html>
