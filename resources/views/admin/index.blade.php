@extends('layouts.main')

@section('title') Dashboard @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
<div class="pagetitle">
  <h1>Dashboard</h1>
</div>
@endsection
<!-- ======= End Page Title ======= -->

<!-- ======= Body Section ======= -->
@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">TIM <span>Terdaftar</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$proposal->count()}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Proposal <span>Direview</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-earmark-break"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$proposal->where('status', 1)->count()}}</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Proposal <span>Selesai</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-earmark-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$proposal->where('status', 2)->count()}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Proposal <span>Didanai</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-earmark-arrow-up"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$proposal->where('status', 3)->count()}}</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Grafik keikut sertaan TIM</h5>

                            <!-- Line Chart -->
                            <div id="reportsChart"></div>
                        </div>

                    </div>
                </div><!-- End Reports -->
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Grafik TIM Lolos didanai</h5>

                            <!-- Line Chart -->
                            <div id="lolosChart"></div>
                        </div>

                    </div>
                </div><!-- End Reports -->
            </div>
        </div>
    </div> --}}
</section>
@endsection
<!-- ======= End Body Section ======= -->

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
    {{-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            $.ajax({
                url: `{{route('dashboard.ajax')}}`,
                success: function (response) {
                    let year = [];
                    let total = [];

                    response.map(function (item) {
                        year.push(item.year)
                        total.push(item.total)
                    })

                    generateChart('reportsChart', year, total)
                }
            })

            $.ajax({
                url: `{{route('dashboard.ajax-lolos')}}`,
                success: function (response) {
                    let year = [];
                    let total = [];

                    response.map(function (item) {
                        year.push(item.year)
                        total.push(item.total)
                    })

                    generateChart('lolosChart', year, total)
                }
            })
        });
    </script> --}}
@endsection
