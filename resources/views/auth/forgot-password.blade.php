@extends('auth.auth')
@section('main-content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <a href="{{ route('login') }}">
                        <div class="app-brand justify-content-center">
                            <img src="{{ asset('assets/img/logo/logo-dark.png') }}" alt="Logo Stitek Bontang">
                        </div>
                    </a>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <div class="text-sm">Tautan reset kata sandi telah dikirim ke email.</div>
                    </div>
                    @endif
                    <!-- /Logo -->
                    <p class="mb-4 small">Lupa kata sandi? tidak masalah. Silahkan isi alamat email yang terdaftar pada
                        form di bawah. Sistem akan mengirimkan email untuk melakukan reset kata sandi.</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan email terdaftar" autofocus required autocomplete="off"
                                value="{{ old('email') }}" />
                            @error('email')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark d-grid w-100" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
@endsection