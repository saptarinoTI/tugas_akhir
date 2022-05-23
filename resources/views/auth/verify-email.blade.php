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

          @if (session('status') == 'verification-link-sent')
          <div class="mb-4 big-small text-success alert alert-success small">
            Tautan verifikasi telah dikirim ke email. Silahkan cek <span class="text-danger fw-bold">spam</span> jika pada pesan masuk tidak tersedia.
          </div>
          @endif

          <p class="mb-4 fw-bold">Pendaftaran email berhasil! Sebelum memulai, silahkan klik tombol
            <span class="fw-bolder">Verifikasi</span> dibawah kemudian cek email anda untuk memverifikasi
            email. Jika email tidak masuk, silahkan perhatikan email yang anda isi, bisa dirubah jika salah. Dan bisa memeriksa spam pada email.
          </p>
          <div class="text-center mb-4">
            <img src="{{ asset('assets/img/spam.jpg') }}" alt="spam email" height="350px" class="border">
          </div>

          <p class="fw-bold">Email Terdaftar : {{ auth()->user()->email }}</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('verification.send') }}" method="POST">
            @csrf
            <div class="mb-3">
              <div class="row">
                <div class="col-12 col-md-6">
                  <button type="submit" class="btn btn-dark w-100"><span class="small">Verifikasi
                      Email</span>
                  </button>
                </div>
                <div class="col-12 mt-2 mt-md-0 col-md-6">
                  <a href="{{ route('register.getEmail') }}" class="btn btn-outline-dark w-100"><span class="small">Rubah
                      Email</span>
                  </a>
                </div>
              </div>
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
