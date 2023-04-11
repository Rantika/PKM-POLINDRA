@extends('layouts.main')

@section('title') Akun Simbelmawa @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
<div class="pagetitle">
  <h1>Akun Simbelmawa</h1>
</div>
@endsection
<!-- ======= End Page Title ======= -->

<!-- ======= Body Section ======= -->
@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card d-flex align-items-center">
                    <div class="social-links mt-2">
                        <img src="{{asset('assets/img/simbelmawa.png')}}" alt="Profile" class="rounded-circle" style="max-width: 100% !important;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-4">
                    <div class="row p-4">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Usename Simbelmawa</label>
                        <div class="col-md-8 col-lg-9">
                            <input class="form-control" value="{{$lecturer->username_simbelmawa}}" disabled="">
                        </div>
                    </div>
                    <div class="row p-4">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Password Simbelmawa</label>
                        <div class="col-md-8 col-lg-9">
                            <input class="form-control" value="{{$lecturer->password_simbelmawa}}" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- ======= End Body Section ======= -->

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection
