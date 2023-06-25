@php
    use Carbon\Carbon;
@endphp

@extends('layouts.main')

@section('title') Setting - Periode @endsection

@section('css')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

@section('breadcumb')
    <div class="pagetitle">
        <h1>Waktu Review</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Waktu Review
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary my-4" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped datatable">
                            <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Berakhir</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pengaturan as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>
                                @php
                                        $mulai = Carbon::createFromFormat('Y-m-d H:i:s', $data->mulai);
                                        $format = $mulai->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                                        echo $format;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $mulai = Carbon::createFromFormat('Y-m-d H:i:s', $data->selesai);
                                        $format = $mulai->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                                        echo $format;
                                    @endphp
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" data-id="{{ $data->id }}" type="checkbox" {{$data->is_active ? 'checked' : ''}}>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable-{{ $data['id'] }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('setting.waktu-review.delete', ['id' => $data['id']]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <form action="{{route('setting.waktu-review.store')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Waktu Upload Proposal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input name="mulai" type="datetime-local" class="form-control" placeholder="Waktu Mulai" required>
                                    <label>Waktu Mulai</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input class="form-control" type="datetime-local" name="selesai"  placeholder="Waktu Berakhir"></input>
                                    <label for="floatingDeskripsi">Waktu Berakhir</label>
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

    {{-- Modal Update --}}
    
    @foreach($pengaturan as $data)
    <div class="modal fade" id="modalDialogScrollable-{{ $data['id'] }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('setting.waktu-review.update', ['id' => $data->id]) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Waktu Upload</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input name="mulai" type="datetime-local" class="form-control" placeholder="Waktu Mulai" required value="{{ $data['mulai'] }}" >
                                        <label>Waktu Mulai</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input class="form-control" type="datetime-local" name="selesai"  placeholder="Waktu Berakhir" value="{{ $data['selesai'] }}" >
                                        <label for="floatingDeskripsi">Waktu Berakhir</label>
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
@endsection

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
    <script>
        $(document).ready(function () {
            $('.datatable').DataTable();

            $(document).on('click', '.edit', function () {
                fadeIn()
                let id = $(this).data('id')

                $.ajax({
                    url: `{{route('setting.period.show')}}/${id}`,
                    success: function (response) {
                        $('#form-update').attr('action', `{{route('setting.period.update')}}/${response.id}`)
                        $('#name').val(response.name)
                        $('#description').val(response.description)

                        $("#modalDialogUpdate").modal('show');
                        fadeOut()
                    }
                })
            })

            $(document).on('change', '.form-check-input', function () {
                let id = $(this).data('id')
                let val = $(this).is(':checked');

                $.ajax({
                    url: `{{route('setting.period.update-status')}}/${id}`,
                    data: { is_active : val ? 1 : 0 },
                    type: 'POST',
                    success: function (response) {
                        window.location.href = window.location.href;
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
                        window.location.replace('{{route('setting.period.delete', '')}}/'+id);
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
