@extends('layouts.main')

@section('title') Dashboard @endsection

@section('css')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

<!-- ======= Page Title Section ======= -->
@section('breadcumb')
<div class="pagetitle">
    <h1>Anggota Tim</h1>
</div>
@endsection
<!-- ======= End Page Title Section ======= -->

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

                    <!-- ======= Datatable Section ======= -->
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>

                                <th class="text-center">No</th>
                                <th>Nama Tim</th>
                                <th>Anggota Tim</th>
                                <th>Nim</th>
                                <th>No Telepon</th>
                                <th>Prody</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tim as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}.</td>
                                <td>{{$data->tim->nama_tim}}</td>
                                <td>{{$data->student->name}}</td>
                                <td>{{$data->student->nim}}</td>
                                <td>{{$data->student->phone_number}}</td>
                                <td>{{$data->student->prody->name}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning my-4" data-bs-toggle="modal" data-bs-target="#modalEdit-{{$data->id}}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete" type="button" title="Delete"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- ======= End Datatable Section ======= -->

                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======= Tambah ======= -->
<div class="modal fade" id="modalDialogScrollable" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('student.tim.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Anggota Tim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="floatingDesc" placeholder="Bimbingan" required>
                                <label for="floatingDesc">Nama Anggota</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="nim" type="text" class="form-control" id="floatingDesc" placeholder="Bimbingan" required>
                                <label for="floatingDesc">Nim</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="phone_number" type="text" class="form-control" id="floatingDesc" placeholder="No Telepon" required>
                                <label for="floatingDesc">No Telepon</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prody_id" class="form-label text-dark">Prody</label>
                                <select class="form-select" name="prody_id">
                                    @foreach ($prody as $data)

                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
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
@foreach($tim as $data)
<div class="modal fade" id="modalEdit-{{$data->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('student.tim.update', ['id' => $data->id] ) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Anggota Tim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" value="{{$data->student->name}}" id="floatingDesc" placeholder="Bimbingan" required>
                                <label for="floatingDesc">Nama Anggota</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="nim" type="text" class="form-control" id="floatingDesc" value="{{$data->student->nim}}" placeholder="Bimbingan" required>
                                <label for="floatingDesc">Nim</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="phone_number" type="text" class="form-control" value="{{$data->student->phone_number}}" id="floatingDesc" placeholder="No Telepon" required>
                                <label for="floatingDesc">No Telepon</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prody_id" class="form-label text-dark">Prody</label>
                                <select class="form-select" name="prody_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($prody as $dt)
                                    @if($data->student->prody_id == $dt->id)
                                    <option value="{{$dt->id}}" selected>{{$dt->name}}</option>
                                    @else
                                    <option value="{{$dt->id}}">{{$dt->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
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
<!-- ======= End Page Body Section ======= -->

@section('js')
{{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection