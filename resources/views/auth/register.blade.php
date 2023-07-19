<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>PKM Polindra - Registrasi</title>

    <!-- Icons font CSS-->
    <link href="{{asset('auth/register/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('auth/register/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{asset('auth/register/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('auth/register/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('auth/register/css/main.css')}}" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins" style="background-color: #23B6E4">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    @if(session()->has("error"))
                        <div class="alert alert-danger" role="alert">
                            {{session()->get('error')}}
                        </div>
                    @endif
                    <h2 class="title" style="text-align: center"> Registrasi</h2>
                    <form method="POST" action="{{route('register.process')}}">
                        @csrf
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nama</label>
                                    <input class="input--style-4 has-error" type="text" name="name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">NIM</label>
                                    <input class="input--style-4" type="text" name="nim">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">password</label>
                                    <input class="input--style-4" type="password" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">No Hp</label>
                            <input class="input--style-4" type="text" name="phone_number">
                        </div>
                        <div class="input-group">
                            <label class="label">Jurusan</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="prody_id" class="form-control">
                                    @foreach($prodies as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="p-t-15" style="display: flex;align-items: center;justify-content: space-between;">
                            <button class="btn btn--radius-2 btn--blue" type="submit" style="text-align: center; background-color: #23B6E4">Submit</button>
                            <label style="align-items: inherit;align-content: center;">
                                Sudah Punya akun? &nbsp;<a href="{{route('login')}}" style="color: darkslategray;">Login</a>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{asset('auth/register/vendor/jquery/jquery.min.js')}}"></script>
    <!-- Vendor JS-->
    <script src="{{asset('auth/register/vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('auth/register/vendor/datepicker/moment.min.js')}}"></script>
    <script src="{{asset('auth/register/vendor/datepicker/daterangepicker.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('auth/register/js/global.js')}}"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
