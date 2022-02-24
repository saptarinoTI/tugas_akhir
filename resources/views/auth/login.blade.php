<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta5
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    @include('layout._header')
</head>

<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container-tight">
            <form class="card card-md" action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="." class="navbar-brand brand-login navbar-brand-autodark"><img
                                src="{{ asset('img/logo/logo-dark.png') }}" height="50" alt="STITEK Bontang"></a>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Username</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                            placeholder="Enter username" required autocomplete="off" value="{{ old('id') }}" />
                        @error('id')
                            <div class="invalid-feedback">
                                Username atau password salah!
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted">
                            Password
                            <span class="form-label-description">
                                <a href="{{ route('password.request') }}" class="text-muted">I forgot
                                    password</a>
                            </span>
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" autocomplete="off">
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                Username atau password salah!
                            </div>
                        @enderror
                    </div>
                    <div class="form-footer mb-3">
                        <button type="submit" class="btn btn-dark w-100">Sign in</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3 medium">
                <a href="{{ route('skripsi.index') }}" tabindex="-1" class="fw-semibold text-dark">Daftar
                    Judul
                    Skripsi</a> Mahasiswa STITEK Bontang
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    @include('layout._footer')
</body>

</html>
