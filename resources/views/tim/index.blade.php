@extends('layouts.main')

@section('title') Dashboard @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title Section ======= -->
@section('breadcumb')
<div class="pagetitle">
    <h1>Dashboard</h1>
</div>
@endsection
<!-- ======= End Page Title Section ======= -->

<!-- ======= Body Section ======= -->
@section('content')


<section class="section profile">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3 ">
                    <div class="profile-overview">
                        <h5 class="card-title">Profil Tim</h5>
                        <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Pengusul</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="fullName" type="text" class="form-control" id="fullName" value="{{Auth::user()->student->name}}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="about" class="col-md-4 col-lg-3 col-form-label">NIM</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="nim" type="text" class="form-control" id="nim" value="{{Auth::user()->student->nim}}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Jurusan</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="job" type="text" class="form-control" id="Job" value="{{Auth::user()->student->prody->group->name}}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">No Hp</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="phone_number" type="text" class="form-control" id="Country" value="{{Auth::user()->student->phone_number}}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="Email" value="{{Auth::user()->email}}" disabled>
                            </div>
                        </div>
    
                        @if(empty($tim)) 

                        @else
                        @if($tim["nama_tim"] == null)
                        <form action="{{ route('student.store-tim') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Nama Tim</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" name="nama_tim" class="form-control" id="nama_tim" placeholder="Masukkan Nama Tim Anda">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="row mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Nama Tim</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" name="nama_tim" class="form-control" id="nama_tim" placeholder="Masukkan Nama Tim Anda" value="{{ $tim['nama_tim'] }}" disabled>
                                </div>
                            </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Anggota TIM
                    </strong>
                </div>
                <div class="card-body pt-3">
                    @if(!empty($tim_student))
                    <ol>
                    @forelse($tim_student as $tim)
                    <li>{{ $tim->student->id }}</li>
                    <li>{{ $tim->student->name }}</li>
                    @empty
                    <div class="alert alert-danger">
                        Data Tidak Ada
                    </div>
                    @endforelse
                    </ol>
                    @else
                    Nama Tim Belum Ada
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- ======= End Page Body Section ======= -->

@section('js')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection