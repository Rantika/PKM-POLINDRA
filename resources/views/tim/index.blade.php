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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-pencil"></i>
                    <strong>
                        Profil Tim
                    </strong>
                </div>
                <form action="{{ route('student.store-tim') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row pt-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fullName" class="pb-2"> Pengusul </label>
                                    <input type="text" class="form-control" name="fullName" value="{{Auth::user()->student->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nim" class="pb-2"> NIM </label>
                                    <input type="text" class="form-control" name="nim" id="nim" value="{{Auth::user()->student->nim}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fullName" class="pb-2"> Jurusan </label>
                                    <input type="text" class="form-control" name="fullName" value="{{Auth::user()->student->prody->group->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nim" class="pb-2"> Nomor Handphone </label>
                                    <input type="text" class="form-control" name="nim" id="nim" value="{{Auth::user()->student->phone_number}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nim" class="pb-2"> Email </label>
                                    <input type="text" class="form-control" name="nim" id="nim" value="{{Auth::user()->email}}" disabled>
                                </div>
                            </div>
                        </div>
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
                                        @php
                                        $cek = DB::table("reviewers")
                                        ->where("lecturer_id", $data->id)
                                        ->where("deleted_at", NULL)
                                        ->first()
                                        @endphp
                                        @if($cek)

                                        @else
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @else
                                    @if($tim["nama_tim"] == null)
                                    <select name="dosbing_id" class="form-control" id="dosbing_id">
                                        <option value="">- Pilih -</option>
                                        @foreach($dosbing as $data)
                                        @php
                                        $cek = DB::table("reviewers")
                                        ->where("lecturer_id", $data->id)
                                        ->where("deleted_at", NULL)
                                        ->first()
                                        @endphp
                                        @if($cek)

                                        @else
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @else
                                    @if($tim->proposal->dosbing->status == 2)
                                    <select name="dosbing_id" class="form-control" id="dosbing_id" required>
                                        <option value="">- Pilih -</option>
                                        @foreach($dosbing as $data)
                                        @php
                                        $cek = DB::table("reviewers")
                                        ->where("lecturer_id", $data->id)
                                        ->where("deleted_at", NULL)
                                        ->first()
                                        @endphp
                                        @if($cek)

                                        @else
                                        @if($data->id == $tim->proposal->dosbing->dosbing_id)

                                        @else
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        @endif
                                        @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <input type="text" class="form-control" name="dosbing_id" value="{{ $tim->proposal->lecturer->name }}" disabled>

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
                        @if($tim["nama_tim"] == null)
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                        @else
                        @if($tim->proposal->dosbing->status == 0)
                        <a class="btn btn-success" style="width: 100%;">
                            <strong>
                                Status :
                                <i>
                                    Sedang Diproses
                                </i>
                            </strong>
                        </a>
                        @elseif($tim->proposal->dosbing->status == 1)
                        <button disabled class="btn btn-success" style="width: 100%;">
                            <strong>
                                Status :
                                <i>
                                    TIM Anda Sudah di ACC
                                </i>
                            </strong>
                        </button>
                        @elseif($tim->proposal->dosbing->status == 2)
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
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                    <ol>
                        @forelse($tim_student as $tim)
                        <!-- <li>{{ $tim->student->id }}</li> -->
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