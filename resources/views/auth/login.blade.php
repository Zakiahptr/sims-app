<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SIMS Web App</title>
    {{-- ngok meta tag --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}" />
    <!-- Data Tables -->
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
</head>

<body>
    <section class="login d-flex">
        <div class="login-left w-50 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-6 text-center">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="header mb-5">
                        <div class="d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px" viewBox="0 0 256 256"><path fill="#ff4d4d" d="m239.89 198.12l-14.26-120a16 16 0 0 0-16-14.12H176a48 48 0 0 0-96 0H46.33a16 16 0 0 0-16 14.12l-14.26 120A16 16 0 0 0 20 210.6a16.13 16.13 0 0 0 12 5.4h191.92a16.13 16.13 0 0 0 12.08-5.4a16 16 0 0 0 3.89-12.48M128 32a32 32 0 0 1 32 32H96a32 32 0 0 1 32-32M32 200L46.33 80H80v24a8 8 0 0 0 16 0V80h64v24a8 8 0 0 0 16 0V80h33.75l14.17 120Z"/></svg>
                            <h3 class="ms-2 mb-3 fw-semibold">
                                SIMS Web App
                            </h3>
                        </div>

                            <h2 class="mb-3 fw-bold p-3">Masuk Atau Buat Akun Untuk Memulai</h2>
                        </div>
                        <div class="login-form mt-3">
                            <div class="input-group mb-4">
                                <span class="input-group-text"  style="background-color: #ffff; border-right: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="none" stroke="#ccc" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11.996V7.998m0 3.998c0-5.157-8-5.157-8 0c0 5.167 8 5.11 8 0m0 0c0 5 5 5 5 0C21 7.027 16.97 3 12 3s-9 4.027-9 8.996c0 4.968 4.03 8.995 9 8.995c1.675.084 3.938-.421 5.776-1.831"/></svg>
                                </span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" style="border-left: none;" name="email" value="{{ old('email') }}" placeholder="masukkan email anda" required autocomplete="email" autofocus />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-text"  style="background-color: #ffff; border-right: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="none" stroke="#ccc" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M8 10V7c0-2.21 1.79-4 4-4s4 1.79 4 4v3m-4 5a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 0v3m-5.4-8h10.8c.88 0 1.6.72 1.6 1.6v7c0 1.32-1.08 2.4-2.4 2.4H7.4C6.08 21 5 19.92 5 18.6v-7c0-.88.72-1.6 1.6-1.6"/></svg>
                                </span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" style="border-right: none; border-left: none;" name="password" placeholder="masukkan password anda" required autocomplete="current-password" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span class="input-group-text"  style=" background-color: #ffff; border-left: none;" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye" style="color: #ccc"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye" style="color: #ccc"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="login text-decoration-none text-end mt-3" id="submit-btn" style="border-radius: 8px">Masuk</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Section (Hidden on Mobile) -->
        <div class="login-right bg-primary w-50 h-100">
            <div class="row">
                    <img src="{{ asset('assets/Frame_login.png') }}" alt="" />
            </div>


        </div>
    </section>

    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
</body>
</html>

