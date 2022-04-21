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
                    <!-- /Logo -->
                    <p class="mb-4 small">Ups email Anda tidak terdaftar. Silahkan daftarkan email yang benar, karena
                        akan digunakan untuk proses verifikasi.</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('register.postEmail') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan email anda" autofocus required autocomplete="off"
                                value="{{ old('email') }}" />
                            @error('email')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark d-grid w-100 border-0" type="submit">
                                <div class="small">Daftar Email</div>
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <form action="{{ route('logout') }}" method="post" class="p-0 m-0">
                            @csrf
                            <button type="submit" class="btn btn-logout btn-danger w-100 border-0">
                                <span class="small">Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
@endsection