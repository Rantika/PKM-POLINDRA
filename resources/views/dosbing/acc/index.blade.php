@extends('layouts.main')

@section('title') Proposal PKM @endsection

@section('css')
<style>
    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

@section('breadcumb')
<div class="pagetitle">
    <h1>Proposal PKM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"><a href="\lecturer">Dashboard</a></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body pt-4">
                    <div class="table-responsive">
                        <table class="table table-striped datatable nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Mahasiswa</th>
                                    <th>Judul</th>
                                    <th class="text-center">Skema</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proposals as $data)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}.</td>
                                    <td>{{ $data->mahasiswa->name }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td class="text-center">{{ $data->scheme->name }}</td>
                                    <td class="text-center">
                                        @if($data->dosbing->status == 0)
                                            <button disabled class="btn btn-warning btn-sm">
                                                Belum Ada Status
                                            </button>
                                        @elseif($data->dosbing->status == 1)
                                        <button disabled class="btn btn-success btn-sm">
                                            ACC
                                        </button>
                                        @elseif($data->dosbing->status == 2)
                                        <button disabled class="btn btn-danger btn-sm">
                                            Tolak
                                        </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $data->id }}">
                                            <i class="bi bi-pencil"></i> Ubah Status
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@foreach($proposals as $data)
<div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('lecturer.update', ['id' => $data->dosbing->id] ) }}" method="POST">
                {{ csrf_field() }}
                @method("PUT")
                <div class="modal-body">
                    <label for="status"> Status </label>
                    <select name="status" class="form-control" id="status">
                        <option value="">- Pilih -</option>
                        <option value="1">Setuju</option>
                        <option value="2">Tidak Setuju</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection