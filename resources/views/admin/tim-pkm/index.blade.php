@extends('layouts.main')

@section('title') Tim PKM @endsection

@section('css')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
    <div class="pagetitle">
        <h1>Data Proposal Tim PKM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item active"><a href="\dashboard">Dashboard</a></li>
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
                        {{-- <button type="button" class="btn btn-sm btn-primary my-4" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button> --}}

                        <div class="table-responsive">
                            <!-- ======= Data Table ======= -->
                            <table class="table table-striped datatable nowrap">
                                <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Pengusul</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Skema</th>
                                    <th class="text-center">Pembimbing</th>
                                    <th class="text-center">Reviewer</th>
                                    <th class="text-center">Template Proposal PKM</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proposals as $data)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$data->year}}</td>
                                        <td>{{$data->student->name ?? '-'}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->scheme->short}}</td>
                                        <td>{{$data->lecturer->name ?? '-'}}</td>
                                        <td>{{optional(optional($data->reviewer)->lecturer)->name ?? '-'}}</td>
                                        <td class="text-center">
                                            <a href="{{$data->file ? asset($data->file) : '#'}}" target="{{$data->file ? '_blank' : '_self'}}" class="btn btn-sm btn-{{$data->file ? 'primary' : 'warning'}}" title="{{$data->file ? 'Download' : 'Belum Mengupload Proposal'}}"><i class="bi bi-download"></i></a>
                                            @if ($data->file_done)
                                            <a href="{{$data->file_done ? asset($data->file_done) : '#'}}" target="{{$data->file_done ? '_blank' : '_self'}}" class="btn btn-sm btn-{{$data->file_done ? 'success' : 'warning'}}" title="{{$data->file_done ? 'Download File Hasil' : 'Belum Mengupload Proposal Hasil'}}"><i class="bi bi-download"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $status = [$data->file ? 'Belum direview' : 'Belum Upload Proposal', 'Sedang direview', 'Selesai', 'Lolos Didanai'];
                                                $statusColor = ['danger', 'warning', 'primary', 'success'];
                                            @endphp
                                            <span class="badge bg-{{$statusColor[$data->status]}}">
                                                {{$status[$data->status]}}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($data->status == 2)
                                            <a href="{{route('proposal.lolos', $data->id)}}" class="btn btn-sm btn-success" title="Lolos Didanai"><i class="bi bi-check-circle"></i></a>
                                            @endif
                                            <button class="btn btn-sm btn-primary bimbingan" type="button" data-id="{{$data->student->user->id}}" title="Lihat Bimbingan"><i class="bi bi-person-workspace"></i></button>
                                            <button class="btn btn-sm btn-info edit" type="button" data-id="{{$data->id}}" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                            {{-- <button class="btn btn-sm btn-danger delete" type="button" data-id="{{$data->id}}" title="Delete"><i class="bi bi-trash"></i></button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- ======= End Data Table ======= -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======= Tambah ======= -->
    <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('proposal.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Proposal Tim PKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" name="student_id">
                                        @foreach($students as $data)
                                            <option value="{{$data->id}}">{{$data->nim .' | '. $data->prody->name .' | '. $data->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingName">Pengusul</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="year" class="form-control" placeholder="2019">
                                    <label for="year">Tahun</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="title" class="form-control" id="floatingTitle" placeholder="Judul">
                                    <label for="floatingTitle">Judul</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea name="description" class="form-control" style="height: 100px" id="floatingDeskripsi" placeholder="Deskripsi"></textarea>
                                    <label for="floatingDeskripsi">Deskripsi Singkat</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($schemes as $data)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="scheme_id" value="{{$data->id}}">
                                                <label class="form-check-label">
                                                    {{$data->name}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" name="lecturer_id">
                                        @foreach($lecturers as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="jurusan">Dosen Pembimbing</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" name="reviewer_id">
                                        @foreach($reviewers as $data)
                                            <option value="{{$data->id}}">{{$data->lecturer->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="jurusan">Reviewer</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="file" name="file" class="form-control" placeholder="Proposal">
                                    <label for="jurusan">File Proposal</label>
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
    <!-- ======= End Tambah ======= -->

    <!-- ======= Edit ======= -->
    <div class="modal fade" id="modalDialogUpdate" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-update" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Proposal Tim PKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" name="student_id" id="student_id" disabled>
                                        @foreach($students as $data)
                                            <option value="{{$data->id}}">{{$data->nim .' | '. $data->prody->name .' | '. $data->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingName">Pengusul</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="year" class="form-control" id="year" placeholder="2019">
                                    <label for="year">Tahun</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Judul">
                                    <label for="title">Judul</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea name="description" class="form-control" style="height: 100px" id="description" placeholder="Deskripsi"></textarea>
                                    <label for="description">Deskripsi Singkat</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($schemes as $data)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="update_scheme_id" value="{{$data->id}}">
                                                <label class="form-check-label">
                                                    {{$data->name}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" name="lecturer_id" id="lecturer_id">
                                        @foreach($lecturers as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="jurusan">Dosen Pembimbing</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" id="reviewer_id" name="reviewer_id">
                                        @foreach($reviewers as $data)
                                            <option value="{{$data->id}}">{{$data->lecturer->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="jurusan">Reviewer</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="file" name="file" class="form-control" placeholder="Proposal">
                                    <label for="jurusan">File Proposal</label>
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
    <!-- ======= End Edit ======= -->

    <!-- ======= Tim Lolos ======= -->
    <div class="modal fade" id="modalLolos" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-lolos" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Update Tim Lolos PKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="user_simbelmawa" class="form-control" id="user_simbelmawa" placeholder="Username Simbelmawa">
                                    <label for="year">Username Simbelmawa</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="password_simbelmawa" class="form-control" id="password_simbelmawa" placeholder="Password Simbelmawa">
                                    <label for="year">Password Simbelmawa</label>
                                </div>
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
    <!-- ======= End Tim Lolos ======= -->

    <!-- ======= Bimbingan ======= -->
    <div class="modal fade" id="modalBimbingan" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Bimbingan TIM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body profile-card pt-4">
                                <h5>Hasil Bimbingan</h5>
                                <table class="table table-hover">
                                    <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Bimbingan</th>
                                    <th>Status</th>
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
    <!-- ======= End Bimbingan ======= -->

@endsection
<!-- ======= End Body Section ======= -->

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
    <script>
        $(document).ready(function () {
            $('.datatable').DataTable();

            $(document).on('click', '.edit', function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('proposal.show')}}/${id}`,
                    success: function (response) {
                        $('#form-update').attr('action', `{{route('proposal.update')}}/${response.id}`)
                        $('#student_id').val(response.student_id).change()
                        $('#year').val(response.year)
                        $('#title').val(response.title)
                        $('#description').val(response.description)
                        $('input[name="update_scheme_id"]').filter(`[value=${response.scheme_id}]`).prop('checked', true);
                        $('#lecturer_id').val(response.lecturer_id).change()
                        $('#reviewer_id').val(response.reviewer_id).change()

                        $("#modalDialogUpdate").modal('show');
                        fadeOut()
                    }
                })
            })

            $(document).on('click', '.lolos', function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('proposal.show')}}/${id}`,
                    success: function (response) {
                        $('#form-lolos').attr('action', `{{route('proposal.lolos')}}/${response.id}`)
                        $('#fund_value').val(response.fund_value)
                        $('#username_simbelmawa').val(response.username_simbelmawa)
                        $('#password_simbelmawa').val(response.password_simbelmawa)

                        $("#modalLolos").modal('show');
                        fadeOut()
                    }
                })
            })

            $(document).on('click', '.delete', function () {
                let id = $(this).data('id');

                swal({
                    title: "Yakin ingin menghapus data ini?",
                    text: "Ketika data terhapus, anda tidak bisa mengembalikan data tersebut!",
                    icon: "warning",
                    buttons: [
                        'Jangan, batalkan!',
                        'Ya, lanjutkan!'
                    ],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        window.location.replace('{{route('proposal.delete', '')}}/'+id);
                    } else {
                        swal("Dibatalkan", "Data aman", "error");
                    }
                })

            });

            $(document).on('click', '.bimbingan', function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('proposal.show-bimbingan')}}/${id}`,
                    success: function (response) {
                        $('#bimbingan').html('');

                        if (response.bimbingan.length === 0){
                            $('#bimbingan').append(`
                                <tr>
                                  <td colspan="4" class="text-center">Tidak ada data!</td>
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
                                      <button type="button" class="btn btn-${data.is_confirmed ? 'success' : 'warning'}" disabled> ${data.is_confirmed ? 'Terkonfirmasi' : 'Bulum dikonfirmasi'}</button>
                                  </td>
                                <tr>
                            `)
                            i++;
                        });

                        fadeOut()
                        $("#modalBimbingan").modal('show');
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
