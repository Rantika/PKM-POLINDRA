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
<!-- ======= Tabs Section ======= -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body pt-4">
                    <!-- ======= Tabs ======= -->
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Belum direview</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sedang direview</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Selesai</button>
                        </li>
                    </ul>
                    <!-- ======= End Tabs ======= -->

                    <div class="tab-content pt-4" id="borderedTabContent">

                        <!-- ======= Tab Belum Direview ======= -->
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Pengusul</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Skema</th>
                                        <th class="text-center">Pembimbing</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proposals->where('status', 0)->where('is_confirmed', 1)->all() as $data)
                                        @php
                                            $cek = Dosbing::where("dosbing_id", $data->reviewer_id)
                                                ->where("student_id", $data->mahasiswa->user_id)
                                                ->first();
                                        @endphp

                                        @if($cek)

                                        @else
                                        <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$data->mahasiswa->name}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->scheme->name}}</td>
                                        <td>{{ $data->lecturer->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/reviewer/proposal/belum-review/'.$data->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-eye"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- ======= End Tab Belum Direview ======= -->

                        <!-- ======= Tab Sedang Direview ======= -->
                        <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Pengusul</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Skema</th>
                                        <th class="text-center">Pembimbing</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proposals->where("status", 2)->where("approved", 1)->all() as $data)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$data->student->name}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->scheme->name}}</td>
                                        <td>{{optional($data->reviewer)->lecturer->name ?? '-'}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info review" data-id="{{$data->id}}" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#modalRevisi-{{ $data->id }}">
                                                <i class="bi bi-eye"></i> Lihat
                                            </button>
                                            <form action="{{ url('/reviewer/proposal/setujui') }}" method="POST" style="display: inline;">
                                                @method("PUT")
                                                @csrf
                                                <input type="hidden" name="proposal_id" value="{{ $data->id }}">
                                                <button onclick="return confirm('Apakah Anda Menyetujui Proposal?')" type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-check"></i> Setujukan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- @foreach($proposals->where('status', 1)->where("approved", 0)->all() as $data)
                                    @endforeach -->
                                </tbody>
                            </table>
                        </div>
                        <!-- ======= End Tab Sedang Direview ======= -->

                        <!-- ======= Tab Selesai ======= -->
                        <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table table-striped datatable nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Pengusul</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Skema</th>
                                        <th class="text-center">Pembimbing</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proposals->where("status", 3)->where("approved", 0)->all() as $data)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$data->student->name}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->scheme->name}}</td>
                                        <td>{{optional($data->reviewer)->lecturer->name ?? '-'}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#modalSelesai-{{ $data->id }}">
                                                <i class="bi bi-eye"></i> Lihat
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- ======= End Tab Selesai ======= -->

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======= End Tabs Section ======= -->

<!-- ======= Review Proposal PKM======= -->
<div class="modal fade" id="modalDialogScrollable" tabindex="-1">
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
                                        <a id="confirm-file" href="#" class="twitter" target="_blank">
                                            <i class="bi bi-download" style="font-size: 25px"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="cover" type="text" class="form-control" placeholder="Cover"></textarea>
                                <label for="cover">Cover</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="kata_pengantar" type="text" class="form-control" placeholder="Kata Pengantar"></textarea>
                                <label for="kata_pengantar">Kata Pengantar</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_1" type="text" class="form-control" placeholder="BAB I"></textarea>
                                <label for="bab_1">BAB I</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_2" type="text" class="form-control" placeholder="BAB II"></textarea>
                                <label for="bab_2">BAB II</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_3" type="text" class="form-control" placeholder="BAB III"></textarea>
                                <label for="bab_3">BAB III</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="daftar_pustaka" type="text" class="form-control" placeholder="Daftar Pustaka"></textarea>
                                <label for="dafta_pustaka">Daftar Pustaka</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Upload Proposal Review (Opsional)</label>
                                <input name="file" type="file" class="form-control" placeholder="Kegiatan">
                            </div>
                            <label>Max Size : 5MB</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ======= End Review Proposal PKM ======= -->

<!-- ======= Data Review Proposal PKM ======= -->
@foreach($proposals->where('status', 2)->where("approved", 1)->all() as $data)
<div class="modal fade" id="modalRevisi-{{ $data->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Keterangan Revisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/reviewer/proposal/belum-review') }}" method="POST">
                    @csrf
                    <input type="hidden" name="proposal_id" value="{{ $data->id }}">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="title" type="text" class="form-control" id="title" placeholder="Cover"></textarea>
                                <label for="title">Judul</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="deskripsi" type="text" class="form-control" id="deskripsi" placeholder="Kata Pengantar"></textarea>
                                <label for="deskripsi">Deskripsi</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary my-4">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                    </div>
                </form>
                <hr>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body pt-3 ">
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
                                            @php
                                                $komen = komen_proposal::where("proposal_id", $data->id)->get();
                                            @endphp
                                            @foreach($komen as $k)
                                            <tr>
                                                <td class="text-center">{{$loop->iteration}}.</td>
                                                <td class="text-center">{{ $k->title }}</td>
                                                <td class="text-center">{{ $k->deskripsi }}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- ======= End Data Review Proposal PKM ======= -->

<!-- ======= Hasil Akhir ======= -->
@foreach($proposals->where("status", 3)->where("approved", 0)->all() as $data)
<div class="modal fade" id="modalSelesai-{{ $data->id }}" tabindex="-1">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- ======= End Hasil Akhir ======= -->
@endsection
<!-- ======= End Body Section ======= -->

@section('js')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();

        $('.confirm').click(function() {
            fadeIn()
            let id = $(this).data('id')

            $.ajax({
                url: `{{route('reviewer.get-proposal')}}/${id}`,
                success: function(response) {
                    $('#form-confirm').attr('action', `{{route('reviewer.upload-proposal')}}/${id}`)

                    $('#confirm-title').html(response.title)
                    if (response.file) {
                        $('#confirm-file').attr('target', '_blank')
                        $('#confirm-file').attr('href', `{{asset('/')}}` + response.file)
                    } else {
                        $('#confirm-file').attr('target', '_self')
                        $('#confirm-file').attr('href', '#')
                        $('#confirm-file').html('Belum Upload Proposal')
                    }

                    fadeOut()
                    $("#modalDialogScrollable").modal('show');
                }
            })
        })

        $('.review').click(function() {
            fadeIn()
            let id = $(this).data('id')

            $.ajax({
                url: `{{route('reviewer.get-proposal')}}/${id}`,
                success: function(response) {
                    fadeOut()

                    $('#review-title').html(response.file_review ? response.file_review.split('/')[1] : '')
                    if (response.file_review) {
                        $('#review-file').attr('target', '_blank')
                        $('#review-file').attr('href', `{{asset('/')}}` + response.file_review)
                    } else {
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

        $('.done').click(function() {
            fadeIn()
            let id = $(this).data('id')

            $.ajax({
                url: `{{route('reviewer.get-proposal')}}/${id}`,
                success: function(response) {
                    $('#done-title').html(response.file_done ? response.file_done.split('/')[1] : '')

                    if (response.file_done) {
                        $('#done-file').attr('target', '_blank')
                        $('#done-file').attr('href', `{{asset('/')}}` + response.file_done)
                    } else {
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
        if ('{{session()->has("success")}}' == true) type = "success";
        if ('{{session()->has("error")}}' == true) type = "error";

        if (type) {
            swal({
                title: type == 'success' ? "Success !" : 'Error !',
                text: type == 'success' ? "{{ session()->get('success') }}" : "{!! session()->get('error') !!}",
                icon: `${type}`,
                confirmButtonColor: "#556ee6",
                timer: 10000,
            });
        }
    })
</script>
@endsection