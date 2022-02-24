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
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 big-small text-success alert alert-success">
                    {{ __('Tautan verifikasi telah dikirim ke email yang Anda berikan saat pendaftaran.') }}
                </div>
            @endif
            <form class="card card-md" action="{{ route('verification.send') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="mb-4 big-samll text-muted">
                        {{ __('Pendaftaran email berhasil! Sebelum memulai, silahkan klik tombol verifikasi dibawah kemudian cek email anda untuk memverifikasi email.') }}
                    </div>
                    <div class="form-footer">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <button type="submit" class="btn btn-dark w-100"><span class="small">Verifikasi
                                        Email</span>
                                </button>
                            </div>
                            <div class="col-12 mt-2 mt-md-0 col-md-4">
                                <a href="{{ route('register.getEmail') }}" class="btn btn-outline-dark w-100"><span
                                        class="small">Rubah
                                        Email</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mb-3 mt-0">
                <form action="{{ route('logout') }}" method="post" class="p-0 m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout border-0 px-5 py-1 mt-3">
                        <span class="text-danger fw-semibold bg-transparent py-1">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    @include('layout._footer')
</body>

</html>
