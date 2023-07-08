<!DOCTYPE html>
<html lang="en">
<head>
	<title>PKM Polindra - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('auth/login/images/icons/favicon.ico')}}" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('auth/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-color: #23B6E4">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                @if(session()->has("error"))
                <div class="alert alert-danger" role="alert">
                    {{session()->get('error')}}
                </div>
                @endif
				<form class="login100-form validate-form flex-sb flex-w" action="{{route('login.process')}}" method="post">
                    @csrf
					<span class="login100-form-title p-b-20" style="font-size: 25px;">
							Program Kreatifitas Mahasiswa
                        <br>
					</span>
                    <span class="login100-form-title p-b-5">
                        <img class="mb-3 logo-image" src="{{ asset($configs->where('name', 'logo')->first() == null ? 'home/assets/img/logo.png' : $configs->where('name', 'logo')->first()->file) }}" alt="logo" width="150" height="150">
						<hr>
						<span style="font-size: 25px; color:#D9D9D9">
							Politeknik Negeri Indramayu
                        <br>
					</span>
                    </span>
					<div class="p-t-5 p-b-9 mt-3">
						<span class="txt1">
							Email
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Email is required">
						<input class="input100" type="text" name="email" >
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" >
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17" >
                        <button type="submit" class="login100-form-btn" style="color: #ffff; background-color:#23B6E4">
                            Login
                        </button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Belum punya akun?
						</span>

						<a href="{{route('register')}}" class="txt2 bo1">
							Daftar di sini!
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="{{asset('auth/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('auth/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/login/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('auth/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/login/js/main.js')}}"></script>

</body>
</html>
