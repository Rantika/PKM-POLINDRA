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
    
    @if (session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selamat Datang, {{ Auth::user()->student->name }} !</strong> 
        {!! session("success") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(empty($tim))
    
    @else
    @if($tim["nama_tim"] == null)
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Perhatian!</h4>
        <p>
            Anda Tidak Bisa Mengupload Data Proposal TIM .
        </p>
        <hr>
        <p class="mb-0">
            Silahkan Lengkapi Data Profil TIM Anda Terlebih Dahulu.
        </p>
    </div>
    @else
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Berhasil!</h4>
        <p>
            Data TIM Anda Sedang Diproses.
        </p>
        <hr>
        <p class="mb-0">
            Silahkan Tunggu Konfirmasi Yang Akan Diberikan.
        </p>
    </div>
    @endif
    @endif
    
    <form action="{{ route('student.store-tim') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-pencil"></i>
                        <strong>
                            Ketua Tim
                        </strong>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row">
                            <label class="col-md-3"> Pengusul </label>
                            <div class="col-md-7">
                                {{ Auth::user()->student->name }}
                            </div>
                        </div>
                        <div class="row pt-2">
                            <label class="col-md-3"> NIM </label>
                            <div class="col-md-7">
                                {{ Auth::user()->student->nim }}
                            </div>
                        </div>
                        <div class="row pt-2">
                            <label class="col-md-3"> Jurusan </label>
                            <div class="col-md-7">
                                {{ Auth::user()->student->prody->group->name }}
                            </div>
                        </div>
                        <div class="row pt-2">
                            <label class="col-md-3"> No. HP </label>
                            <div class="col-md-7">
                                {{ Auth::user()->student->phone_number }}
                            </div>
                        </div>
                        <div class="row pt-2">
                            <label class="col-md-3"> Jurusan </label>
                            <div class="col-md-7">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-pencil"></i>
                        <strong>
                            Profil Tim
                        </strong>
                    </div>
                    <div class="card-body">
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_tim" class="pb-2"> Nama TIM </label>
                                    @if(empty($tim))
                                    <input type="text" class="form-control" name="nama_tim" placeholder="Masukkan Nama TIM" id="nama_tim">
                                    @else
                                    @if($tim["nama_tim"] == null)
                                    <input type="text" class="form-control" name="nama_tim" placeholder="Masukkan Nama TIM">
                                    @else
                                    <input type="text" class="form-control" name="nama_tim" placeholder="Masukkan Nama TIM" value="{{ $tim->nama_tim }}" disabled>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="schema_id" class="pb-2"> Schema </label>
                                    @if(empty($tim))
                                    <select name="schema_id" class="form-control" id="schema_id">
                                        <option value="">- Pilih -</option>
                                        @foreach($schema as $item)
                                        @if(empty($tim))
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @else
                                    @if($tim["nama_tim"] == null)
                                    <select name="schema_id" class="form-control" id="schema_id">
                                        <option value="">- Pilih -</option>
                                        @foreach($schema as $item)
                                        @if(empty($tim))
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <input type="text" class="form-control" value="{{ $tim->proposal->scheme->name }}" disabled>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="pb-2"> Judul </label>
                                    @if(empty($tim))
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Masukkan Judul">
                                    @else
                                    @if($tim["nama_tim"] == null)
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Masukkan Judul">
                                    @else
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Masukkan Judul" value="{{ $tim->proposal->title }}" disabled>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="pb-2"> Dosen Pembimbing </label>
                                    @if(empty($tim))
                                    <select name="dosbing_id" class="form-control" id="dosbing_id">
                                        <option value="">- Pilih -</option>
                                        @foreach($dosbing as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @else
                                    @if($tim["nama_tim"] == null)
                                    <select name="dosbing_id" class="form-control" id="dosbing_id">
                                        <option value="">- Pilih -</option>
                                        @foreach($dosbing as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @else
                                    @if($cekstatus->status == 2)
                                    <select name="dosbing_id" class="form-control" id="dosbing_id" required>
                                        <option value="">- Pilih -</option>
                                        @foreach($dosbing as $data)
                                        @if($data->id == $cekstatus->dosbing_id)
                                        
                                        @else
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        
                                        @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <input type="text" class="form-control" name="dosbing_id" value="{{ $cekstatus->lecturer->name }}" disabled>
                                    @endif
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if(empty($tim))
                        
                        @else
                        @if($is_team == 0)
                        <div class="alert alert-danger text-center">
                            <strong>
                                <i>
                                    Silahkan Daftarkan Nama Anggota TIM Anda Terlebih Dahulu
                                </i>
                            </strong>
                        </div>
                        @else
                        @if(empty($cekstatus))
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                        @else
                        @if($cekstatus->status == 0)
                        <a class="btn btn-success" style="width: 100%;">
                            <strong>
                                Status :
                                <i>
                                    Sedang Diproses
                                </i>
                            </strong>
                        </a>
                        @elseif($cekstatus->status == 1)
                        <button disabled class="btn btn-success" style="width: 100%;">
                            <strong>
                                Status :
                                <i>
                                    TIM Anda Sudah di ACC
                                </i>
                            </strong>
                        </button>
                        @elseif($cekstatus->status == 2)
                        <button disabled class="btn btn-danger" style="width: 100%;">
                            <strong>
                                Status :
                                <i>
                                    TIM Anda Di Tolak
                                </i>
                            </strong>
                        </button>
                        <br><br>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <strong>
                                Simpan
                            </strong>
                        </button>
                        @endif
                        @endif
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<section class="section profile">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Anggota TIM
                    </strong>
                </div>
                <div class="card-body pt-3">
                    @if(!empty($tim_student))
                    <div class="row">
                        @forelse($tim_student as $tim)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <center>
                                                <img src="{{ url('/assets/img/user-icon.png') }}" style="width: 100px; height: 100px;">
                                            </center>
                                        </div>
                                        <div class="col-md-8">
                                            <strong>
                                                {{ $tim->student->nim }}
                                                <br>
                                                {{ $tim->student->name }}
                                            </strong>
                                            <br>
                                            {{ $tim->student->prody->name }}
                                            <br>
                                            {{ $tim->student->phone_number }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center">
                                <strong>
                                    Data Anggota Tim Belum Ada
                                </strong>
                            </div>
                        </div>
                        @endforelse
                    </div>
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