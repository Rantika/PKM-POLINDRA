@extends('layouts.main')

@section('title') Master Data - Jurusan @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
<div class="pagetitle">
    <h1>Jurusan</h1>
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
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$data->name}}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{$data->is_active ? 'success' : 'danger'}}">
                                        <i class="bi bi-{{$data->is_active ? 'check' : 'x'}}-circle me-1"></i> {{$data->is_active ? 'Aktif' : 'Non-Aktif'}}
                                    </span>
                                </td>
                                <td class="text-center">
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
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="{{route('meta.group.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jurusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Nama" class="form-label text-dark" > Nama </label>
                            <input name="name" type="text" class="form-control" placeholder="Nama" required>
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
            <form id="form-update" action="#" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jurusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nama" required>
                                <label for="floatingName">Nama</label>
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
                url: `{{route('meta.group.show')}}/${id}`,
                success: function (response) {
                    $('#form-update').attr('action', `{{route('meta.group.update')}}/${response.id}`)
                    $('#name').val(response.name)
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
                    window.location.replace('{{route('meta.group.delete', '')}}/'+id);
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
