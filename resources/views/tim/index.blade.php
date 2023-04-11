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
    @php
        if ($proposal->status == 0) {
            if ($proposal->file != null) $status = 'Belum direview';
            else $status = 'Belum Upload Proposal';

            $statusColor = 'danger';
        }
        if ($proposal->status == 1){
            $status = 'Revisi';
            $statusColor = 'warning';
        }
        if ($proposal->status == 2){
            $status = 'Selesai';
            $statusColor = 'primary';
        }
        if ($proposal->status == 3){
            $status = 'Lolos Didanai';
            $statusColor = 'success';
        }
    @endphp

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
                                    <input name="fullName" type="text" class="form-control" id="fullName" value="{{$proposal->student->name}}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="about" class="col-md-4 col-lg-3 col-form-label">NIM</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="nim" type="text" class="form-control" id="nim" value="{{$proposal->student->nim}}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Job" class="col-md-4 col-lg-3 col-form-label">Jurusan</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="job" type="text" class="form-control" id="Job" value="{{$proposal->student->prody->name}}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Country" class="col-md-4 col-lg-3 col-form-label">No Hp</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="phone_number" type="text" class="form-control" id="Country" value="{{$proposal->student->phone_number}}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email" value="{{$proposal->student->user->email}}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="company" class="col-md-4 col-lg-3 col-form-label">Judul</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="title" type="text" class="form-control" id="company" value="{{$proposal->title}}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="company" class="col-md-4 col-lg-3 col-form-label">Deskripsi Singkat</label>
                                <div class="col-md-8 col-lg-9">
                                    <textarea name="description" class="form-control" id="about" style="height: 100px" disabled>{{$proposal->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-3 ">
                        <div class="profile-overview">
                        <h5 class="card-title">{{$proposal->title}}</h5>
                        <p class="small fst-italic">{{$proposal->description ?? 'Belum ada deskripsi'}}</p>

                        <h5 class="card-title">Detail Proposal</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Skema</div>
                            <div class="col-lg-9 col-md-8">{{$proposal->scheme->name}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Reviewer</div>
                            <div class="col-lg-9 col-md-8">{{optional($proposal->reviewer)->lecturer->name ?? '-'}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Status Proposal</div>
                            <div class="col-lg-9 col-md-8">
                                <span class="badge bg-{{$statusColor}}">{{ucfirst($status)}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Status Bimbingan</div>
                            <div class="col-lg-9 col-md-8">
                                <span class="badge bg-{{$proposal->is_confirmed ? 'success' : 'danger'}}">
                                    {{$proposal->is_confirmed ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi Pembimbing'}}
                                </span>
                            </div>
                        </div>
                    </div>
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
