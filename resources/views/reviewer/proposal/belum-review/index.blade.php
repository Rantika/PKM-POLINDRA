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
<!-- ======= Tabs Section ======= -->
<section class="section profile">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3 ">
                    <div class="profile-overview">
                        <h5 class="card-title">Profil Tim</h5>
                        <button class="btn btn-sm btn-warning confirm" title="Review" data-id="{{ $proposals->id }}" data-bs-toggle="modal" data-bs-target="#modalDownloadData">
                            <i class="bi bi-eye"></i> Review
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3 ">
                    <h3 class="panel-title"></h3>
                    <div class="right">
                        <button type="button" class="btn btn-sm btn-primary my-4" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                    <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                @forelse($data_proposal as $data)
                                <tr>
                                    <td class="text-center">{{$nomor++}}</td>
                                    <td class="text-center">{{$data->title}}</td>
                                    <td class="text-center">{{$data->deskripsi}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <strong>
                                            <i>
                                                Data Belum Ada
                                            </i>
                                        </strong>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{url('/reviewer/proposal/belum-review')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="proposal_id" value="{{$proposals->id}}">
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input name="title" type="text" class="form-control" id="floatingDesc" placeholder="Judul" required>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-floating">
                                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextarea2" style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">Deskripsi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalDownloadData" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-confirm" action="#" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Review Proposal PKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="offset-3 col-md-6">
                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <i class="bi bi-file-word rounded-circle" style="font-size: 65px"></i>
                                    <h5 id="confirm-title"></h5>
                                    <div class="social-links mt-2">
                                        <a id="confirm-file" href="#" class="download" target="_blank">
                                            <i class="bi bi-download" style="font-size: 25px"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("js")

<script>
        $(document).ready(function () {

            $('.confirm').click(function () {
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('reviewer.get-proposal')}}/${id}`,
                    success: function (response) {
                        $('#form-confirm').attr('action', `{{route('reviewer.upload-proposal')}}/${id}`)

                        $('#confirm-title').html(response.title)
                        if (response.file){
                            $('#confirm-file').attr('target', '_blank')
                            $('#confirm-file').attr('href',`{{asset('/')}}` + response.file)

                            $(".download").click(function() {
                                $.ajax({
                                    url: `{{ url('/reviewer/proposal/belum-review/${id}/update-status') }}`,
                                    method: "GET",
                                })
                            })
                        }else {
                            $('#confirm-file').attr('target', '_self')
                            $('#confirm-file').attr('href', '#')
                            $('#confirm-file').html('Belum Upload Proposal')
                        }
                    }
                })
            })

            $('.review').click(function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('reviewer.get-proposal')}}/${id}`,
                    success: function (response) {
                        fadeOut()

                        $('#review-title').html(response.file_review ? response.file_review.split('/')[1] : '')
                        if (response.file_review){
                            $('#review-file').attr('target', '_blank')
                            $('#review-file').attr('href', `{{asset('/')}}` + response.file_review)
                        }else {
                            $('#review-file').attr('target', '_self')
                            $('#review-file').attr('href', `#`)
                            $('#review-file').html('Tidak ada Proposal review')
                        }

                        $('#cover').html(response.comment.cover)
                        $('#kata_pengantar').html(response.comment.kata_pengantar)
                        $('#bab_1').html(response.comment.bab_1)
                        $('#bab_2').html(response.comment.bab_2)
                        $('#bab_3').html(response.comment.bab_3)
                        $('#daftar_pustaka').html(response.comment.daftar_pustaka)

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
                        $('#done-title').html(response.file_done ? response.file_done.split('/')[1] : '')

                        if (response.file_done){
                            $('#done-file').attr('target', '_blank')
                            $('#done-file').attr('href', `{{asset('/')}}` + response.file_done)
                        }else {
                            $('#done-file').attr('target', '_self')
                            $('#done-file').attr('href', `#`)
                            $('#done-file').html('Tidak ada Proposal diupload')
                        }

                        $('#done_cover').html(response.comment.cover)
                        $('#done_kata_pengantar').html(response.comment.kata_pengantar)
                        $('#done_bab_1').html(response.comment.bab_1)
                        $('#done_bab_2').html(response.comment.bab_2)
                        $('#done_bab_3').html(response.comment.bab_3)
                        $('#done_daftar_pustaka').html(response.comment.daftar_pustaka)

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
        })
    </script>

@endsection