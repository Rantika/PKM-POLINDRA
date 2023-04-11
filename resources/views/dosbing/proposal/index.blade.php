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

<!-- ======= Page Title ======= -->
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
                                <div class="table-responsive">
                                    <table class="table table-striped datatable nowrap">
                                        <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Pengusul</th>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Skema</th>
                                            <th class="text-center">Reviewer</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($proposals->where('status', 0)->all() as $data)
                                            <tr>
                                                <td class="text-center">{{$loop->iteration}}</td>
                                                <td>{{$data->student->name}}</td>
                                                <td>{{$data->title}}</td>
                                                <td>{{$data->scheme->name}}</td>
                                                <td>{{optional($data->reviewer)->lecturer->name ?? '-'}}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-primary confirm" data-id="{{$data->student->user->id}}" title="Data Bimbingan" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                                                        <i class="bi bi-eye"></i> Bimbingan
                                                    </button>
                                                    <a href="{{route('lecturer.confirm', $data->id)}}" class="btn btn-sm btn-{{$data->is_confirmed ? 'success' : 'warning'}}" title="Approve Proposal">
                                                        <i class="bi bi-eye"></i> {{$data->is_confirmed ? 'Approved' : 'Approve'}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- ======= End Tab Belum Direvie ======= -->

                            <!-- ======= Tab Sedang Direview ======= -->
                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-striped datatable nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Pengusul</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Skema</th>
                                        <th class="text-center">Reviewer</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proposals->where('status', 1)->all() as $data)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td>{{$data->student->name}}</td>
                                            <td>{{$data->title}}</td>
                                            <td>{{$data->scheme->name}}</td>
                                            <td>{{optional($data->reviewer)->lecturer->name ?? '-'}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info review" data-id="{{$data->id}}" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#modalRevisi">
                                                    <i class="bi bi-eye"></i> Lihat
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
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
                                        <th class="text-center">Reviewer</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proposals->whereIn('status', [2, 3])->all() as $data)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td>{{$data->student->name}}</td>
                                            <td>{{$data->title}}</td>
                                            <td>{{$data->scheme->name}}</td>
                                            <td>{{optional($data->reviewer)->lecturer->name ?? '-'}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success done" data-id="{{$data->id}}" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#modalSelesai">
                                                    <i class="bi bi-eye"></i> Lihat
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- ======= Tab Selesai ======= -->
                        </div>>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======= End Tabs Section ======= -->

    <!-- ======= Konfirmasi ======= -->
    <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Bimbingan PKM</h5>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body profile-card pt-4">
                                <h5>Hasil Bimbingan</h5>
                                <table class="table table-hover">
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Bimbingan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody id="bimbingan">

                                    </tbody>
                                </table>
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
    <!-- ======= End Konfirmasi ======= -->

    <!-- ======= Review ======= -->
    <div class="modal fade" id="modalRevisi" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Review Proposal PKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="offset-3 col-md-6">
                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <i class="bi bi-file-word rounded-circle" style="font-size: 65px"></i>
                                    <h5 id="review-title">Download File Review</h5>
                                    <div class="social-links mt-2">
                                        <a id="review-file" href="#" class="twitter" target="_blank">
                                            <i class="bi bi-download" style="font-size: 25px"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="cover" type="text" class="form-control" id="cover" placeholder="Cover" disabled></textarea>
                                <label for="cover">Cover</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="kata_pengantar" type="text" class="form-control" id="kata_pengantar" placeholder="Kata Pengantar" disabled></textarea>
                                <label for="kata_pengantar">Kata Pengantar</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_1" type="text" class="form-control" id="bab_1" placeholder="BAB I" disabled></textarea>
                                <label for="bab_1">BAB I</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_2" type="text" class="form-control" id="bab_2" placeholder="BAB II" disabled></textarea>
                                <label for="bab_2">BAB II</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="bab_3" type="text" class="form-control" id="bab_3" placeholder="BAB III" disabled></textarea>
                                <label for="bab_3">BAB III</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="daftar_pustaka" type="text" class="form-control" id="daftar_pustaka" placeholder="Daftar Pustaka" disabled></textarea>
                                <label for="dafta_pustaka">Daftar Pustaka</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End Review ======= -->

    <!-- ======= Selesai ======= -->
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
                        <div class="col-md-12">
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End Selesai ======= -->
@endsection
<!-- ======= End Body Section ======= -->

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
    <script>
        $(document).ready(function () {
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
                        }else
                            $('#proposal-download').addClass('d-none')

                        if (response.bimbingan.length === 0){
                            $('#bimbingan').append(`
                                <tr>
                                  <td colspan="3" class="text-center">Tidak ada data!</td>
                                <tr>
                            `)
                        }

                        let i = 1;
                        response.bimbingan.map(function (data) {
                            $('#bimbingan').append(`
                                <tr>
                                  <td>${i}</td>
                                  <td>${data.date}</td>
                                  <td>${data.description}</td>
                                  <td>
                                      <button type="button" class="btn btn-${data.is_confirmed ? 'success' : 'warning'} confirm-bimbingan" data-id="${data.id}"> ${data.is_confirmed ? 'Terkonfirmasi' : 'Konfirmasi'}</button>
                                  </td>
                                <tr>
                            `)
                            i++;
                        });

                        fadeOut()
                        $("#modalDialogScrollable").modal('show');
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
