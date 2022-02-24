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
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <div class="text-sm">{{ session('status') }}</div>
                </div>
            @endif
            <form class="card card-md" action="{{ route('password.email') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="mb-3 big-small text-dark">
                        {{ __('Lupa kata sandi? tidak masalah. Silahkan isi alamat email yang terdaftar pada form di bawah. Sistem akan mengirimkan email untuk melakukan reset kata sandi.') }}
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
                        <button type="submit" class="btn btn-dark w-100 btn-sm py-2">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('sweetalert::alert')
    @include('layout._footer')
</body>

</html>
