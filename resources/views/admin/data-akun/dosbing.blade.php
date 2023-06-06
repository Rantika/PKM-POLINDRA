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
                                        @php
                                            $cek = DB::table("reviewers")->where("lecturer_id", $data->id)->where("deleted_at", NULL)->first();
                                        @endphp
                                        
                                        @php
                                            $cek_dosbing = DB::table("dosbing")->where("dosbing_id", $data->id)->count();
                                        @endphp

                                    <span class="badge bg-{{$cek ? 'success' : 'warning'}}">
                                        <i class="bi bi-{{$cek ? 'check' : 'x'}}-circle me-1"></i> {{$cek ? 'Ya' : 'Tidak'}}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                    <span class="badge bg-{{$cek_dosbing == 1 ? 'success' : 'warning'}}">
                                        <i class="bi bi-{{$cek_dosbing == 1 ? 'check' : 'x'}}-circle me-1"></i> {{ $cek_dosbing == 1 ? 'Ya' : 'Tidak'}}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                    <span class="badge bg-{{$data->is_active ? 'success' : 'danger'}}">
                                        <i class="bi bi-{{$data->is_active ? 'check' : 'x'}}-circle me-1"></i> {{$data->is_active ? 'Aktif' : 'Non-Aktif'}}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-{{$data->username_simbelmawa ? 'success' : 'warning'}} lolos" type="button" data-id="{{$data->id}}" title="{{$data->username_simbelmawa ? 'Update' : 'Input'}} Akun Simbelmawa"><i class="bi bi-person-fill"></i></button>
                                        <button class="btn btn-sm btn-info edit" type="button" title="Edit" data-bs-toggle="modal" data-bs-target="#modalDialogEdit-{{ $data->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
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
                                    <select name="prody_id" class="form-control" id="prody_id">
                                        <option value="">- Pilih -</option>
                                        @foreach($prodies as $item)
                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
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
    @foreach($lecturers as $data)
    <div class="modal fade" id="modalDialogEdit-{{ $data->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('account.lecturer.update', ['id' => $data->id] ) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Akun Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{ $data->name }}">
                                    <label for="name">Nama</label>
                                </div>
                            </div>
                            <div class="col-md-12 pb-3">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $data->user->email }}" readonly>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-12 pb-3">
                                <div class="form-floating">
                                    <select name="prody_id" class="form-control" id="prody_id">
                                        <option value="">- Pilih -</option>
                                        @foreach($prodies as $item)
                                            @if($data->prody_id == $item->id)
                                            <option value="{{ $item->id }}" selected>{{$item->name}}</option>
                                            @else
                                            <option value="{{ $item->id }}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 pb-3">
                                <div class="form-floating">
                                    <input type="text" name="nip" class="form-control" id="nip" placeholder="NIP" value="{{ $data->nip }}">
                                    <label for="nip">NIP</label>
                                </div>
                            </div>
                            <div class="col-md-12 pb-3">
                                <div class="form-floating">
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="No Handphone" value="{{ $data->phone_number }}">
                                    <label for="phone_number">No Handphone</label>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-floating">
                                    <select id="status" class="form-select" name="status">
                                        @if($data->is_active == 1)
                                        <option value="1" selected>Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                        @else
                                        <option value="1">Aktif</option>
                                        <option value="0" selected>Non-Aktif</option>
                                        @endif
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
    @endforeach
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
