@extends('layouts.main')

@section('title') Berita Kegiatan PKM @endsection

@section('css')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
    <div class="pagetitle">
        <h1>Berita Kegiatan PKM</h1>
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
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary my-4" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>

                        <!-- ======= Data Table ======= -->
                        <table class="table table-striped datatable">
                            <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Singkatan PKM</th>
                                <th>Jenis PKM</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $data)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{!! $data->description ? substr($data->description, 0, 50).'' : '-' !!}</td>
                                    <td class="text-center">
                                        <a href="{{asset($data->photo ?? 'assets/img/product-1.jpg')}}" target="_blank">
                                            <img class="img-table" src="{{asset($data->photo ?? 'assets/img/product-1.jpg')}}">
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info edit" type="button" data-id="{{$data->id}}" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger delete" type="button" data-id="{{$data->id}}" title="Delete"><i class="bi bi-trash"></i></button>
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
    </section>

    <!-- ======= Tambah ======= -->
    <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jenis PKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input name="title" type="text" class="form-control" id="floatingName" placeholder="Kegiatan">
                                    <label for="floatingName">Singkatan PKM</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="floatingDeskripsi">Thumbnail</label>
                                <div>
                                    <input name="file" type="file" class="form-control" id="floatingFoto" placeholder="Foto">
                                    <label>Max Size : 1MB</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="floatingDeskripsi">Jenis PKM</label>
                                <div class="form-inline">
                                    <textarea name="description" class="tinymce-editor">

                                    </textarea>
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
    <!-- ======= End Tambah ======= -->

    <!-- ======= Edit ======= -->
    <div class="modal fade" id="modalDialogUpdate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-update" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Berita Kegiatan PKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Kegiatan">
                                    <label for="title">Judul</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="floatingDeskripsi">Thumbnail</label>
                                <div>
                                    <input name="file" type="file" class="form-control" id="file" placeholder="Foto">
                                    <label>Max Size : 1MB</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <label for="floatingDeskripsi">Konten</label>
                                    <textarea id="description" name="description" class="tinymce-editor">

                                    </textarea>
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
    <!-- ======= End Edit ======= -->
@endsection
<!-- ======= End Body Section ======= -->

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
    <script>
        $(document).ready(function () {
            $('.datatable').DataTable();

            $('.edit').click(function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('news.show')}}/${id}`,
                    success: function (response) {
                        $('#form-update').attr('action', `{{route('news.update')}}/${response.id}`)
                        $('#title').val(response.title)
                        tinymce.get("description").setContent(response.description ?? '')


                        $("#modalDialogUpdate").modal('show');
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
                        window.location.replace('{{route('news.delete', '')}}/'+id);
                    } else {
                        swal("Dibatalkan", "Data aman", "error");
                    }
                })

            });

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
