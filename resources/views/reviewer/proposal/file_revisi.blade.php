@php
    use Carbon\Carbon;
@endphp

@extends('layouts.main')

@section('title') File Revisi Proposal @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
<div class="pagetitle">
    <h1>File Revisi Proposal</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"></a>
            </li>
            <li class="breadcrumb-item active">
                <a href="\reviewer">
                    Dashboard
                </a>
            </li>
        </ol>
    </nav>
</div>
@endsection
<!-- ======= End Page Title ======= -->

<!-- ======= Body Section ======= -->
@section('content')

<section class="section">
    <div class="row">
        
        <div class="col-lg-12">
            <a href="{{ url('/reviewer/proposal') }}" class="btn btn-danger btn-sm">
                Kembali 
            </a>
            <br><br>
            <div class="card">
                <div class="card-body pt-4">
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Mahasiswa </label>
                        <div class="col-md-7">
                            {{ $proposals->student->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Reviewer </label>
                        <div class="col-md-7">
                            {{ $proposals->reviewer->lecturer->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Pembimbing </label>
                        <div class="col-md-7">
                            {{ $proposals->lecturer->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Skema </label>
                        <div class="col-md-7">
                            {{ $proposals->scheme->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Judul </label>
                        <div class="col-md-7">
                            {{ $proposals->title }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Deskripsi </label>
                        <div class="col-md-7">
                            @if (empty($proposals->description))
                            <strong>
                                Belum Ada Deskripsi
                            </strong>
                            @else
                            {{ $proposals->description }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Tahun </label>
                        <div class="col-md-7">
                            {{ $proposals->year }}
                        </div>
                    </div>
                    @if ($proposals->approved == 1)
                    <div class="row mb-3">
                        <label class="control-label col-md-3"> Status Proposal </label>
                        <div class="col-md-7">
                            <div class="btn btn-success btn-sm">
                                <strong>
                                    <i class="bi bi-check"></i> Lolos Didanai
                                </strong>
                            </div>
                        </div>
                    </div>
                    @else
                        @if ($proposals->status == 2 || $proposals->status == 1)
                            
                        @else
                        <form action="{{ url('/reviewer/proposal/'.$proposals->id.'/file_revisi') }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="row mb-3">
                                <label class="control-label col-md-3"> Setujui Proposal </label>
                                <div class="col-md-7">
                                    <button onclick="return confirm('Yakin ? Apakah Anda Menyetujui Proposal Ini ?')" type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-check"></i> Setujui
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pt-4">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Upload</th>
                                <th class="text-center">File Revisi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($file as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td class="text-center">{!! Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->isoFormat('DD MMMM YYYY | HH:mm:ss'); !!}</td>
                                <td class="text-center">{{ $item["file"] }}</td>
                                <td class="text-center">
                                    @if ($item["status"] == "0")
                                    <button class="btn btn-danger btn-sm">
                                        Belum di Revisi    
                                    </button>    
                                    @elseif($item["status"] == "1")
                                    <button class="btn btn-warning btn-sm">
                                        Revisi Ulang
                                    </button>
                                    @elseif($item["status"] == "2")
                                    <button class="btn btn-success btn-sm">
                                        Revisi Cukup
                                    </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="{{ url('/reviewer/proposal/'.$proposals->id.'/file_revisi/'.$item->id.'/download') }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    @if ($item->status == "1" || $item->status == "2" )
                                    
                                    @else
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}">
                                        <i class="bi bi-search"></i> Ubah
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@foreach ($file as $item)
<div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Ubah Status
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/reviewer/proposal/'.$proposals->id.'/file_revisi/'.$item->id.'/ubah') }}" method="POST" style="display: inline" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label mb-2"> Status Revisi </label>
                        <select name="status" class="form-control" id="status">
                            <option value="">- Pilih -</option>
                            <option value="1">Lanjut Revisi</option>
                            <option value="2">Sudah Cukup</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btn-sm">Kembali</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@section("js")

<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>

@endsection