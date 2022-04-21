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
          <h5 class="mb-2">Selamat Datang di SIMTA</h5>
          <p class="mb-4 small">Silahkan Masuk Ke Akun Anda Untuk Melakukan Aktifitas Tugas Akhir</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="id" class="form-label">Username</label>
              <input id="id" type="text" name="id" class="form-control @error('id') is-invalid @enderror" placeholder="Masukkan username atau nim" autofocus required autocomplete="off" value="{{ old('id') }}" />
              @error('id')
              <div class="invalid-feedback"> Username atau password salah! </div>
              @enderror
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href={{ route('password.request') }}>
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password')is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-dark d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>

          <p class="text-center small">
            <a href="{{ route('skripsi.index') }}" class="fw-semibold">
              <span>Daftar Judul Skripsi</span>
            </a>
            <span class="fw-light">Mahasiswa Tugas Akhir Bontang</span>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>
@endsection
