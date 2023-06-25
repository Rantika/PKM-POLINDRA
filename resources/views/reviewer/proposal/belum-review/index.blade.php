@extends('layouts.main')

@section('title') Review Proposal PKM @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

@section('breadcumb')
<div class="pagetitle">
    <h1>Review Proposal PKM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"></a>
            </li>
            <li class="breadcrumb-item active">
                <a href="\reviewer">Dashboard</a>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')

<section class="section profile">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <span style="text-transform: uppercase; color: blue;">
                        {{ $proposals->title }}
                        </span>
                        <span style="float: right;">
                            Mahasiswa : 
                            <span style="color: green; font-weight: bold; text-transform: uppercase;">
                            {{ $proposals["mahasiswa"]["name"] }}
                            </span>
                        </span>
                    </strong>
                </div>
                <div class="card-body pt-3">
                    <strong>Dosen Pembimbing : <span style="color: blue; text-transform: uppercase;">{{ $proposals["lecturer"]["name"] }}</span> </strong>
                    <br>
                    <strong>Skema : </strong> {{ $proposals["scheme"]["name"] }}
                    <br>
                    <strong>Detail: </strong>
                    <p style="text-align: justify;">
                        {{ $proposals["description"] }}
                    </p>
                </div>
                <div class="card-footer">
                    
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama"> Pesan </label>
                            <br><br>
                            <textarea name="pesan" class="form-control" rows="5" placeholder="Masukkan Komentar"></textarea>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus"></i> Tambah 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection