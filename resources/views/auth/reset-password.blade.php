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
            <form class="card card-md" action="{{ route('password.update') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control fw-semibold @error('email') is-invalid @enderror"
                            name="email" placeholder="Masukkan email" required autocomplete="off"
                            value="{{ old('email', $request->email) }}" readonly />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control fw-semibold @error('password') is-invalid @enderror"
                            name="password" placeholder="Masukkan Password" required autocomplete="off"
                            value="{{ old('password') }}" />
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password"
                            class="form-control fw-semibold @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" placeholder="Masukkan Konfirmasi Password" required
                            autocomplete="off" value="{{ old('password_confirmation') }}" />
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-dark w-100 btn-sm py-2">Simpan Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('sweetalert::alert')
    @include('layout._footer')
</body>

</html>
