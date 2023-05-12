@extends('layouts.main')

@section('title') Proposal PKM @endsection

@section('css')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title Section ======= -->
@section('breadcumb')
    <div class="pagetitle">
        <h1>Proposal PKM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="#"></a></li>
                <li class="breadcrumb-item active"><a href="\team">Dashboard</a></li>
            </ol>
        </nav>
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
        if ($proposal->approved == 1) {
            $status = "Tunggu Konfirmasi";
            $statusColor = "warning";
        } else {
            $status = 'Selesai';
            $statusColor = 'primary';
        }
    }
    if ($proposal->status == 3){
        $status = 'Lolos Didanai';
        $statusColor = 'success';
    }
    @endphp

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card d-flex align-items-center">
                        <div class="card-body profile-card pt-4 d-flex flex-column">
                            <center><img src="{{asset($proposal->lecturer->photo)}}" width="300px" height="120px" alt="Profile" class="rounded-circle" ></center>
                            <div class="social-links mt-2" style="text-align: center"><h2>{{$proposal->lecturer->name}}</h2></div>
                            <div class="social-links mt-1" style="text-align: center"><h2>{{$proposal->lecturer->nip}}</h2></div>
                            <div class="social-links mt-1" style="text-align: center"><h3>{{$proposal->lecturer->prody->name}}</h3></div>
                            <div class="social-links mt-2" style="text-align: center">
                                <i class="bi bi-phone"></i> {{formatHp($proposal->lecturer->phone_number)}}
                            </div>
                        </div>
                    </div>
                </div>

                @if($proposal->status == 1 && $proposal->file_review)
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <i class="bi bi-file-pdf rounded-circle" style="font-size: 65px"></i>
                        <h2>Hasil Review {{$proposal->title}}</h2>
                        <div class="social-links mt-2">
                            <a href="{{asset($proposal->file_review ?? '#')}}" class="twitter" target="{{$proposal->file_review ? '_blank' : '_self'}}">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- ======= Bordered Tabs ======= -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            @if($proposal->status != 0)
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#komentar">Catatan Proposal</button>
                                </li>
                            @endif

                            @if($proposal->student->username_simbelmawa)
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#simbelmawa">Akun Simbelmawa</button>
                                </li>
                            @endif

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil Tim</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Password</button>
                            </li>

                        </ul>
                        <!-- ======= End Bordered Tabs ======= -->

                        <!-- ======= Content Tabs ======= -->
                        <div class="tab-content pt-2">

                            <!-- ======= Overview Tabs ======= -->
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <form action="{{$proposal->status == 0 ? route('student.upload-proposal') : route('student.upload-proposal-done')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
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
                                        <div class="col-lg-3 col-md-4 label">Proposal</div>
                                        <div class="col-lg-9 col-md-8">
                                            @if(!$proposal->file)
                                            <input name="file" type="file" class="form-control" id="floatingFoto" placeholder="File Proposal">
                                            <label>Max Size : 5MB</label>
                                            @else
                                            <a href="{{asset($proposal->file)}}" target="_blank">
                                                <span class="badge border-primary border-1 text-primary">{{explode('/', $proposal->file)[1]}}</span>
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Status Proposal</div>
                                        <div class="col-lg-9 col-md-8">
                                            <span class="badge bg-{{$statusColor}}">{{ucfirst($status)}}</span>
                                        </div>
                                    </div>

                                    @if($proposal->status == 1 || $proposal->status == 2)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Upload Proposal Revisi</div>
                                        <div class="col-lg-9 col-md-8">
                                            @if($proposal->status == 2 && $proposal->approved == 1) 
                                            <div class="alert alert-danger">
                                                <small class="text-danger">
                                                    Data Sedang Dalam Pengecekan
                                                </small>
                                            </div>
                                            @else
                                            <input name="file" type="file" class="form-control" id="floatingFoto" placeholder="Proposal">
                                            <label>Max Size : 5MB</label>

                                            @endif
                                            
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Status Bimbingan</div>
                                        <div class="col-lg-9 col-md-8">
                                            <span class="badge bg-{{$proposal->is_confirmed ? 'success' : 'danger'}}">
                                                {{$proposal->is_confirmed ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi Pembimbing'}}
                                            </span>
                                        </div>
                                    </div>
                                
                                    <div class="text-center {{$proposal->status == 2 ? 'd-none' : ''}}">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            <!-- ======= End Overview Tabs ======= -->

                            <!-- ======= Komentas Proposal Tabs ======= -->
                            <div class="tab-pane fade komentar pt-3" id="komentar">
                                
                            @foreach($komen as $k)
                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">{{ $k->title }}</label>
                                <div class="col-md-8 col-lg-9">
                                    <textarea class="form-control" disabled>{{ $k->deskripsi }}</textarea>
                                </div>
                            </div>
                            @endforeach
                            </div>
                            <!-- ======= End Komentas Proposal Tabs ======= -->

                            <!-- ======= Simbelmawa Tabs ======= -->
                            <div class="tab-pane fade simbelmawa pt-3" id="simbelmawa">
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Usename Simbelmawa</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input class="form-control" value="{{$proposal->student->username_simbelmawa}}" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Password Simbelmawa</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input class="form-control" value="{{$proposal->student->password_simbelmawa}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- ======= End Simbelmawa Tabs ======= -->

                            <!-- ======= Profile Edit Tabs ======= -->
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                @if(session()->has("error"))
                                    @if(session()->get('position') == 'profile')
                                    <div class="alert alert-danger" role="alert">
                                        {{session()->get('error')}}
                                    </div>
                                    @endif
                                @endif
                                @if(session()->has("success"))
                                    @if(session()->get('position') == 'profile')
                                        <div class="alert alert-success" role="alert">
                                            {{session()->get('success')}}
                                        </div>
                                    @endif
                                @endif
                                <form method="post" action="{{route('student.profile.update')}}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Pengusul</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control" id="fullName" value="{{$proposal->student->name}}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">NIM</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nim" type="text" class="form-control" id="nim" value="{{$proposal->student->code}}" disabled>
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
                                            <input name="phone_number" type="text" class="form-control" id="Country" value="{{$proposal->student->phone_number}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email" value="{{$proposal->student->user->email}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Judul</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="title" type="text" class="form-control" id="company" value="{{$proposal->title}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Deskripsi Singkat</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="description" class="form-control" id="about" style="height: 100px">{{$proposal->description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>
                            <!-- ======= End Profile Edit Tabs ======= -->

                            <!-- ======= Ganti Password Tabs ======= -->
                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                @if(session()->has("error"))
                                    @if(session()->get('position') == 'password')
                                        <div class="alert alert-danger" role="alert">
                                            {{session()->get('error')}}
                                        </div>
                                    @endif
                                @endif
                                @if(session()->has("success"))
                                    @if(session()->get('position') == 'password')
                                        <div class="alert alert-success" role="alert">
                                            {{session()->get('success')}}
                                        </div>
                                    @endif
                                @endif
                                <!-- Change Password Form -->
                                <form method="post" action="{{route('student.profile.change-password')}}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="old" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="confirm_password" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>
                            <!-- ======= End Ganti Password Tabs ======= -->

                        </div>
                        <!-- ======= End Content Tabs ======= -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
<!-- ======= End Body Section ======= -->

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
    <script>
        $(document).ready(function () {
            $('.datatable').DataTable();
        })
    </script>
@endsection
