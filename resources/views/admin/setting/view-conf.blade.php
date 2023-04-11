@extends('layouts.main')

@section('title')
    Setting - Tampilan
@endsection

@section('css')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
@endsection

@section('breadcumb')
    <div class="pagetitle">
        <h1>Setting - Tampilan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Tampilan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img width="100px" src="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" alt="Profile" class="rounded-circle">
                        </div>
                        <form action="{{ route('setting.view.store-logo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <input name="file" class="form-control" type="file">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Setting - Tampilan aplikasi</h5>
                        <form action="{{ route('setting.view.store') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Singkatan</label>
                                <div class="col-sm-10">
                                    <input name="short" type="text" class="form-control" value="{{ $configs->where('name', 'short')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'short')->first()->value }}" placeholder="Max : 5 Huruf">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Aplikasi</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" value="{{ $configs->where('name', 'name')->first() == null ? 'Pojok Kemahasiswaan' : $configs->where('name', 'name')->first()->value }}" class="form-control" placeholder="Nama Aplikasi">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
    {{-- Jika ada tambahan CSS khusus di page ini, tambahkan di sini --}}
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();

            let type = false;
            if ('{{ session()->has('success') }}' == true) type = "success";
            if ('{{ session()->has('error') }}' == true) type = "error";

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
