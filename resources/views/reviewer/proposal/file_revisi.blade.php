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
                        @if ($proposals->status == 2 || $proposals->status == 1 || $proposals->status == 0)
                            
                        @else
                        <form action="{{ url('/reviewer/proposal/'.$proposals->id.'/file_revisi') }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="row mb-3">
                                <label class="control-label col-md-3"> Setujui Proposal </label>
                                <div class="col-md-7">
                                    <button onclick="return confirm('Yakin ? Apakah Anda Menyetujui Proposal Ini ?')" type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-check"></i> Setujui proposal
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
                                <button class="btn btn-sm btn-primary done" data-id="{{$item->id}}" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#modalSelesai">
                                    <i class="bi bi-eye"></i> Download Proposal
                                </button>
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

<div class="modal fade" id="modalSelesai" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Hasil Akhir Proposal PKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="offset-3 col-md-6">
                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <i class="bi bi-file-word rounded-circle" style="font-size: 65px"></i>
                                    <h5 id="done-title">Download Hasil Akhir</h5>
                                    <div class="social-links mt-2">
                                        <a id="done-file" href="#" class="twitter" target="_blank">
                                            <i class="bi bi-download" style="font-size: 25px"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="cover" type="text" class="form-control" id="done_cover" placeholder="Cover" disabled></textarea>
                                <label for="cover">Cover</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="kata_pengantar" type="text" class="form-control" id="done_kata_pengantar" placeholder="Kata Pengantar" disabled></textarea>
                                <label for="kata_pengantar">Kata Pengantar</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_1" type="text" class="form-control" id="done_bab_1" placeholder="BAB I" disabled></textarea>
                                <label for="bab_1">BAB I</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_2" type="text" class="form-control" id="done_bab_2" placeholder="BAB II" disabled></textarea>
                                <label for="bab_2">BAB II</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_3" type="text" class="form-control" id="done_bab_3" placeholder="BAB III" disabled></textarea>
                                <label for="bab_3">BAB III</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="daftar_pustaka" type="text" class="form-control" id="done_daftar_pustaka" placeholder="Daftar Pustaka" disabled></textarea>
                                <label for="dafta_pustaka">Daftar Pustaka</label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section("js")

<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable();
        $('.confirm').click(function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('lecturer.show-bimbingan')}}/${id}`,
                    success: function (response) {
                        {{--$('#btn-confirm').attr('href', `{{route('lecturer.confirm')}}/${id}`)--}}
                        $('#bimbingan').html('');

                        $('#proposal-title').html(response.proposal.file ? response.proposal.title : 'Belum upload Proposal')
                        if(response.proposal.file) {
                            $('#proposal-download').removeClass('d-none')
                            $('#proposal-download').attr('href', `{{asset('/')}}` + (response.proposal.file ?? '#'))
                        }else {
                            $('#proposal-download').addClass('d-none')
                        }

                        fadeOut()
                    }
                })
            })


            $(document).on('click', '.confirm-bimbingan', function () {
                fadeIn()
                let id = $(this).data('id');
                let elm  = $(this);

                $.ajax({
                    url: `{{route('lecturer.confirm-bimbingan')}}/${id}`,

                    success: function (response) {
                        elm.removeClass('confirm-bimbingan')
                        elm.removeClass('btn-warning')
                        elm.addClass('btn-success')
                        elm.html('Terkonfirmasi')

                        fadeOut()
                    }
                })
            })


            $('.review').click(function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('reviewer.get-proposal')}}/${id}`,
                    success: function (response) {
                        $('#review-title').html(response.file_review ? response.file_review.split('/')[1] : '')
                        if (response.file_review){
                            $('#review-file').attr('target', '_blank')
                            $('#review-file').attr('href', `{{asset('/')}}` + response.file_review)
                        }else {
                            $('#review-file').attr('target', '_self')
                            $('#review-file').attr('href', `#`)
                            $('#review-file').html('Tidak ada Proposal review')
                        }

                       console.log("Ada");

                        fadeOut()
                        $("#modalRevisi").modal('show');
                    }
                })
            })

            $('.done').click(function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('reviewer.get-proposal')}}/${id}`,
                    success: function (response) {
                        console.log(response)
                        $('#done-title').html(response.file ? response.file.split('/')[1] : '')

                        if (response.file){
                            $('#done-file').attr('target', '_blank')
                            $('#done-file').attr('href', `{{asset('/')}}` + response.file)
                        }else {
                            $('#done-file').attr('target', '_self')
                            $('#done-file').attr('href', `#`)
                            $('#done-file').html('Tidak ada Proposal diupload')
                        }

                        // $('#done_cover').html(response.comment.cover)
                        // $('#done_kata_pengantar').html(response.comment.kata_pengantar)
                        // $('#done_bab_1').html(response.comment.bab_1)
                        // $('#done_bab_2').html(response.comment.bab_2)
                        // $('#done_bab_3').html(response.comment.bab_3)
                        // $('#done_daftar_pustaka').html(response.comment.daftar_pustaka)

                        fadeOut()
                        $("#modalSelesai").modal('show');
                    }
                })
            })

            let type = false;
            if('{{session()->has("success")}}' == true) type = "success";
            if('{{session()->has("error")}}' == true) type = "error";

            if(type){
                swal({
                    title: type =='success' ? "Success !" : 'Error !',
                    text: type =='success' ? "{{ session()->get('success') }}" : "{!! session()->get('error') !!}",
                    icon: `${type}`,
                    confirmButtonColor: "#556ee6",
                    timer: 10000,
                });
            }
    });
</script>

@endsection