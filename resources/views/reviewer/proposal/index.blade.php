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
                                        <button class="btn btn-sm btn-primary confirm" data-id="{{$data->id}}" title="Download" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                                                        <i class="bi bi-download"></i> Download Proposal
                                         </button>
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

<div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Download Proposal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="offset-3 col-md-6">
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <i class="bi bi-file-word rounded-circle" style="font-size: 65px"></i>
                                <h5 id="proposal-title"></h5>
                                <div class="social-links mt-2">
                                    <a id="proposal-download" href="#" class="twitter" target="_blank">
                                        <i class="bi bi-download" style="font-size: 25px"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    

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