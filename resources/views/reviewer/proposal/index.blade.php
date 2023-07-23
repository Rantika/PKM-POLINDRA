@php
use App\Models\komen_proposal;
use App\Models\Dosbing;
@endphp

@extends('layouts.main')

@section('title') Review Proposal PKM @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
<div class="pagetitle">
    <h1>Review Proposal PKM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="#"></a></li>
            <li class="breadcrumb-item active"><a href="\reviewer">Dashboard</a></li>
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
            <div class="card">
                <div class="card-body pt-4">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Pengusul</th>
                                <th>Judul</th>
                                <th>Skema</th>
                                <th>Pembimbing</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proposals as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$data->mahasiswa->name}}</td>
                                <td>{{$data->title}}</td>
                                <td>{{$data->scheme->name}}</td>
                                <td>{{ $data->lecturer->name }}</td>
                                <td class="text-center">
                                    @if ($data->approved == 1)
                                        <button disabled class="btn btn-success btn-sm">
                                            Lolos Didanai
                                        </button>    
                                    @else
                                        <button disabled class="btn btn-warning btn-sm">
                                            Belum Lolos
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($settings)
                                        @if($settings->mulai <= now() && $settings->selesai > now())
                                        <a href="{{ url('/reviewer/proposal/'.$data->id.'/komentar') }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-chat"></i> Komentar 
                                        </a>
                                        <a target="_blank" href="{{ url('/reviewer/proposal/'.$data->id.'/file_revisi') }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-search"></i> File Revisi
                                        </a>
                                        @else
                                        <button class="btn btn-warning btn-sm" disabled>
                                        <i class="bi bi-chat"></i> Komentar belum dibuka 
                                        </button>
                                        @endif
                                    @else
                                    <button class="btn btn-warning btn-sm" disabled>
                                    <i class="bi bi-chat"></i> Komentar belum dibuka 
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

@endsection

@section("js")

<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>

@endsection