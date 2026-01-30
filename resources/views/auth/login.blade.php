<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Toko plastik GH Tanjungpinang</title>
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        .login-page {
            background-image: url('{{ asset('logo/bg.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .login-logo {
            margin-bottom: 0 !important;
        }
        .login-logo img {
            max-height: 100px;
        }
        /* CSS untuk membuat card transparan */
        .card {
            background-color: rgba(255, 255, 255, 0.5) !important; /* Latar belakang putih semi-transparan */
            border: none; /* Menghilangkan border card */
        }
        .card-header,
        .card-body {
            background-color: transparent !important; /* Membuat header dan body card transparan */
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="login-logo">
                  
                </div>
                <br>
                <b>Sistem Informasi Pengolahan Data penjualan Di Toko plastik GH Tanjungpinang</b>
                <br>
               
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <div class="text-danger mb-3">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <div class="text-danger mb-3">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                    </div>
                </form>

                @if (Route::has('password.request'))
                    <p class="mb-1 mt-3">
                        <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>