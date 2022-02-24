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
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand brand-login navbar-brand-autodark"><img
                        src="{{ asset('img/logo/logo-dark.png') }}" height="53" alt="STITEK Bontang"></a>
            </div>
            <form class="card card-md" action="{{ route('register.postEmail') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="mb-4 big-small text-dark">
                        {{ __('Ups email Anda tidak terdaftar. Silahkan daftarkan email yang benar, karena akan digunakan untuk proses verifikasi.') }}
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Masukkan email" required autocomplete="off" value="{{ old('email') }}" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-dark w-100 btn-sm py-2">Daftar</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                <form action="{{ route('logout') }}" method="post" class="p-0 m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout border-0 px-5 py-1">
                        <span class="text-danger fw-semibold bg-transparent small py-1">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    @include('layout._footer')
</body>

</html>
