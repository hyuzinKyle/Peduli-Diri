<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

    <!--<title>Login & Registration Form</title>-->
</head>

<body>
    <div class="background">
        <div class="logo">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 712 712" width="70px"
                height="70px" color=''>
                <defs>
                    <style>
                        .cls-1 {
                            fill: none;
                        }

                    </style>
                </defs>
                <line class="cls-1" x1="268.32" y1="329.26" x2="268.32" y2="457.63" />
                <polygon fill="#fff"
                    points="203.43 101.71 203.43 305.14 101.71 406.86 101.71 203.43 0 305.14 0 712 101.71 610.29 101.71 508.57 203.43 406.86 203.43 597.57 101.71 712 203.43 712 305.14 610.29 305.14 0 203.43 101.71" />
                <polygon fill="#fff"
                    points="712 432.29 330.57 432.29 330.57 712 432.29 712 432.29 508.57 610.29 508.57 712 432.29" />
                <polygon fill="#fff" points="610.29 712 712 712 712 457.71 610.29 534 610.29 712" />
                <polygon fill="#fff"
                    points="521.29 305.14 330.57 305.14 330.57 406.86 712 406.86 712 305.14 546.71 305.14 521.29 305.14" />
                <polygon fill="#fff"
                    points="330.57 0 330.57 101.71 521.29 101.71 354.41 279.71 545.13 279.71 712 101.71 712 0 330.57 0" />
            </svg>
        </div>
        <div class="container">
            <div class="forms-reverse">
                <!-- Registration Form -->
                <div class="form signup-reverse">
                    <span class="title">Registrasi</span>
                    <form id="form" action="/postregister" method="POST" novalidate>
                        @csrf
                        @if (session('message'))
                            <div class="alert">
                                <span class="closebtn"
                                    onclick="this.parentElement.style.display='none';">&times;</span>
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="alert" id="error" style="display: none"></div>
                        <div class="input-field">
                            <input type="text" id="nama" placeholder="Masukkan Nama anda" name="nama" required>
                            <i class="uil uil-user"></i>
                        </div>
                        <div class="input-field nik">
                            <input type="text" id="nik" placeholder="Masukkan NIK anda" name="nik" required>
                            <i class="uil uil-user icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" id="password" class="password" name="password"
                                placeholder="Buat Password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                        <div class="input-field button">
                            <input type="submit" value="Register">
                        </div>
                    </form>

                    <div class="login-signup">
                        <span class="text">Sudah terdaftar?
                            <a href="/" class="text login-link">Login Disini</a>
                        </span>
                    </div>
                </div>

                <div class="form login-reverse">
                    <span class="title">Login</span>

                    <form id="form" action="/login" method="POST" novalidate>
                        @csrf
                        @if (session('message'))
                            <div class="alert">
                                <span class="closebtn"
                                    onclick="this.parentElement.style.display='none';">&times;</span>
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="alert" id="error" style="display: none"></div>
                        <div class="input-field nik">
                            <input type="text" id="nik" placeholder="NIK anda" name="nik" required>
                            <i class="uil uil-user icon"></i>
                        </div>
                        <div class="input-field password">
                            <input type="password" id="password" class="password" name="password"
                                placeholder="Password anda" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="logCheck">
                                <label for="logCheck" class="text">Remember me</label>
                            </div>

                            {{-- <a href="#" class="text">Forgot password?</a> --}}
                        </div>

                        <div class="input-field button">
                            <input type="submit" value="Login">
                        </div>
                    </form>

                    <div class="login-signup">
                        <span class="text">Blm terdaftar?
                            <a href="/register" class="text signup-link">Daftar disini</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script>
        // js code to appear signup and login form
        login.addEventListener("click", () => {
            container.classList.add("active");
        });
        signUp.addEventListener("click", () => {
            container.classList.remove("active");
        });

        const nama = document.getElementById('nama')
        const nik = document.getElementById('nik')
        const password = document.getElementById('password')
        const form = document.getElementById('form')
        const errorElement = document.getElementById('error')

        form.addEventListener('submit', (e) => {
            let messages = []
            if (nama.value === '' || nama.value === null) {
                errorElement.style.display = "block";
                messages.push('Nama User harus diisi')
            }
            if (nama.value.length >= 15) {
                errorElement.style.display = "block";
                messages.push('Nama User Tidak boleh lebih dari 15 karakter')
            }
            if (nik.value.length < 16) {
                errorElement.style.display = "block";
                messages.push('NIK harus memiliki 16 angka')
            }
            if (password.value.length <= 6) {
                errorElement.style.display = "block";
                messages.push('Password harus lebih dari 6 karakter')
            }
            if (password.value.length >= 20) {
                errorElement.style.display = "block";
                messages.push('Password tidak boleh lebih dari 20 karakter')
            }
            if (password.value === 'password') {
                errorElement.style.display = "block";
                messages.push('Password tidak boleh "password"')
            }
            if (messages.length > 0) {
                e.preventDefault()
                errorElement.innerText = messages.join(', ')
            }
        })
    </script>
</body>

</html>
