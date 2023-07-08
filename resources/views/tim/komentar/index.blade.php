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

                    @foreach ($proposals->komentar()->where("parent", 0)->orderBy("created_at", "DESC")->get() as $item)
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ url('/image/profil.png') }}" style="width: 50px; height: 50px; border-radius: 50px;">
                        </div>
                        <div class="col-md-11">
                            <strong>
                                {{ $item["lecturer"]["name"] }}
                            </strong>
                            <br>
                            <span style="color: red">
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                            <br>
                            <p style="text-align: justify; color: black;">
                                {{ $item->komentar }}
                            </p>

                            @foreach ($item->childs()->orderBy("created_at", "DESC")->get() as $child)
                                
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="{{ url('/image/profil.png') }}" style="width: 50px; height: 50px; border-radius: 50px;">
                                </div>
                                <div class="col-md-11">
                                    <strong>
                                        {{ $child["user"]["email"] }}
                                    </strong>
                                    <br>
                                    <span style="color: red">
                                        {{ $child->created_at->diffForHumans() }}
                                    </span>
                                    <br>
                                    <p style="text-align: justify; color: black;">
                                        {{ $child->komentar }}
                                    </p>
                                </div>
                            </div>

                            @endforeach

                            <form style="margin-bottom: 30px;" action="{{ url('/team/proposal/'.$proposals["id"].'/komentar') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="proposal_id" value="{{ $item["proposal_id"] }}">
                                    <input type="hidden" name="parent" value="{{ $item["id"] }}">
                                    <textarea name="komentar" id="komentar" class="form-control" rows="5" placeholder="Balas Komentar"></textarea>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus"></i> Tambah 
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btnkomentar").click(function() {
                $("#viewkomentar").toggle("slide");
            })
        });
    </script>
@endsection