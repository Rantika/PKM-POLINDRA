@php
    use App\Models\Proposal;
@endphp

@extends('layouts.main')

@section('title') Plotting - Reviewer @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title ======= -->
@section('breadcumb')
<div class="pagetitle">
    <h1>Plotting Reviewer</h1>
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
                                <th class="text-center">NIM</th>
                                <th class="text-center">Prodi</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">No Hp</th>
                                <th class="text-center">Reviewer</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviewers as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$data->student->name}}</td>
                                <td>{{$data->student->nim}}</td>
                                <td>{{$data->lecturer->prody->name ?? '-'}}</td>
                                <td>{{$data->lecturer->prody->group->name ?? '-'}}</td>
                                <td>{{$data->lecturer->phone_number ?? '-'}}</td>
                                <td>{{$data->lecturer->name ?? '-'}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalDialogUpdate-{{ $data->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('meta.reviewer.delete', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button onclick="return confirm('Apakah Yakin Ingin Menghapus Data ? ')" type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{route('meta.reviewer.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Plotting Reviewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" name="lecturer_id">
                                    <option value="">- Pilih Reviewer -</option>
                                    @foreach($lecturers as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <label for="jurusan">Reviewer</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" name="student_id">
                                    <option value="">-- Pilih Mahasiswa --</option>
                                    @foreach($mahasiswa as $data)
                                        @php
                                            $cek = Proposal::where("student_id", $data["student_id"])->where("reviewer_id", NULL)->first();
                                        @endphp
                                        @if($cek)
                                        <option value="{{ $data->student->id }}">
                                            {{ $data->student->name }} - {{ $data->student->prody->name }}
                                        </option>

                                        @else
                                        @endif
                                    @endforeach
                                </select>
                                <label for="jurusan">Mahasiswa</label>
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
@foreach($reviewers as $edit)
<div class="modal fade" id="modalDialogUpdate-{{ $edit->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{route('meta.reviewer.update', ['id' => $edit->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Plotting Reviewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" name="lecturer_id">
                                    <option value="">- Pilih Dosen -</option>
                                    @foreach($lecturers as $data)
                                        @if($edit->lecturer_id == $data->id)
                                        <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                        @else
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="jurusan">Dosen</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" name="student_id">
                                    <option value="">-- Pilih Mahasiswa default Reviewer --</option>
                                    @foreach($mahasiswa as $data)
                                        @if($data["id"] == $edit["student_id"])
                                        <option value="{{ $data->student->id }}" selected>
                                            {{ $data->student->name }} - {{ $data->student->prody->name }}
                                        </option>
                                        @else
                                            @php
                                                $cek_data = Proposal::where("student_id", $data["student_id"])->where("reviewer_id", NULL)->first();
                                            @endphp

                                            @if($cek_data)
                                            <option value="{{ $data->student->id }}">
                                            {{ $data->student->name }} - {{ $data->student->prody->name }}
                                            </option>
                                            @else

                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                                <label for="jurusan">Mahasiswa</label>
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
@endsection
<!-- ======= End Body Section ======= -->

@section('js')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();

        $(document).on('click', '.edit', function() {
            fadeIn()
            let id = $(this).data('id')

            $.ajax({
                url: `{{route('meta.reviewer.show')}}/${id}`,
                success: function(response) {
                    $('#form-update').attr('action', `{{route('meta.reviewer.update')}}/${response.id}`)
                    $('#lecturer_id').val(response.lecturer_id).change()
                    $('#prody_id').val(response.prody_id).change()

                    $("#modalDialogUpdate").modal('show');
                    fadeOut()
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