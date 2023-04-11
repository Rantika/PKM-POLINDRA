@extends('layouts.main')

@section('title') Akun - Dosbing @endsection

@section('css')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
    <div class="pagetitle">
        <h1>Akun Dosen Pembimbing</h1>
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
                                <th class="text-center">Nama</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Prodi</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">No Hp</th>
                                <th class="text-center">Reviewer</th>
                                <th class="text-center">Dosbing</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lecturers as $data)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->nip}}</td>
                                    <td>{{$data->prody->name}}</td>
                                    <td>{{$data->prody->group->name}}</td>
                                    <td>{{$data->phone_number ?? '-'}}</td>
                                    <td class="text-center">
                                    <span class="badge bg-{{$data->is_reviewer ? 'success' : 'warning'}}">
                                        <i class="bi bi-{{$data->is_reviewer ? 'check' : 'x'}}-circle me-1"></i> {{$data->is_reviewer ? 'Ya' : 'Tidak'}}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                    <span class="badge bg-{{$data->is_dosbing ? 'success' : 'warning'}}">
                                        <i class="bi bi-{{$data->is_dosbing ? 'check' : 'x'}}-circle me-1"></i> {{$data->is_dosbing ? 'Ya' : 'Tidak'}}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                    <span class="badge bg-{{$data->is_active ? 'success' : 'danger'}}">
                                        <i class="bi bi-{{$data->is_active ? 'check' : 'x'}}-circle me-1"></i> {{$data->is_active ? 'Aktif' : 'Non-Aktif'}}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-{{$data->username_simbelmawa ? 'success' : 'warning'}} lolos" type="button" data-id="{{$data->id}}" title="{{$data->username_simbelmawa ? 'Update' : 'Input'}} Akun Simbelmawa"><i class="bi bi-person-fill"></i></button>
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
    </section>

    <!-- ======= Tambah ======= -->
    <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{route('account.lecturer.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Akun Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nama">
                                    <label for="floatingName">Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email">
                                    <label for="floatingEmail">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="nip" class="form-control" placeholder="NIP">
                                    <label for="nip">NIP</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="phone_number" class="form-control" id="phoneNumber" placeholder="No Handphone">
                                    <label for="phoneNumber">No Handphone</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" name="prody_id">
                                        @foreach($prodies as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="jurusan">Prodi</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="floatingDeskripsi">Foto</label>
                                <div>
                                    <input name="file" type="file" class="form-control" placeholder="Foto">
                                    <label>Max Size : 1MB</label>
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
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <form id="form-update" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Akun Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama">
                                    <label for="name">Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="nip" class="form-control" id="nip" placeholder="NIP">
                                    <label for="nip">NIP</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="No Handphone">
                                    <label for="phone_number">No Handphone</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select id="prody" class="form-select" name="prody_id">
                                        @foreach($prodies as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="jurusan">Prodi</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select id="status" class="form-select" name="status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                    </select>
                                    <label for="jurusan">Status</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="floatingDeskripsi">Foto</label>
                                <div>
                                    <input name="file" type="file" class="form-control" id="floatingFoto" placeholder="Foto">
                                    <label>Max Size : 1MB</label>
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

    <!-- ======= Akun Simbelmawa ======= -->
    <div class="modal fade" id="modalLolos" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-lolos" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Akun Simbelmawa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="username_simbelmawa" class="form-control" id="username_simbelmawa" placeholder="Username Simbelmawa">
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
    <!-- ======= End Akun Simbelmawa ======= -->
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
                    url: `{{route('account.lecturer.show')}}/${id}`,
                    success: function (response) {
                        $('#form-update').attr('action', `{{route('account.lecturer.update')}}/${response.id}`)
                        $('#name').val(response.name)
                        $('#email').val(response.user.email)
                        $('#nip').val(response.nip)
                        $('#phone_number').val(response.phone_number)
                        $('#prody').val(response.prody_id).change()
                        $('#status').val(response.is_active).change()

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
                        window.location.replace('{{route('account.lecturer.delete', '')}}/'+id);
                    } else {
                        swal("Dibatalkan", "Data aman", "error");
                    }
                })

            });

            $(document).on('click', '.lolos', function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('account.lecturer.show')}}/${id}`,
                    success: function (response) {
                        $('#form-lolos').attr('action', `{{route('account.lecturer.simbelmawa.store')}}/${response.id}`);
                        $('#username_simbelmawa').val(response.username_simbelmawa)
                        $('#password_simbelmawa').val(response.password_simbelmawa)

                        $("#modalLolos").modal('show');
                        fadeOut()
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
