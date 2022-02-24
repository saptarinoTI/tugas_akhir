@extends('layout.app')
@section('main-title', 'Rubah Password')
@section('main-page')
    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('password-change.post') }}" method="post" class="card">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">ID Login</label>
                                <input type="text" class="form-control fw-semibold" value="{{ auth()->user()->id }}"
                                    name="id" readonly />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control fw-semibold"
                                    value="{{ ucwords(auth()->user()->name) }}" name="name" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control fw-semibold"
                                    value="{{ ucwords(auth()->user()->email) }}" name="email" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Password Saat Ini</label>
                                <input type="password"
                                    class="form-control fw-semibold @error('old_password') is-invalid @enderror"
                                    name="old_password" value="{{ old('old_password') }}" autofocus autocomplete="off"
                                    required />
                                @error('old_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password"
                                    class="form-control fw-semibold @error('new_password') is-invalid @enderror"
                                    name="new_password" value="{{ old('new_password') }}" required />
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control fw-semibold @error('konf_password') is-invalid @enderror"
                                    name="konf_password" value="{{ old('konf_password') }}" required />
                                @error('konf_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-dark btn-sm p-2 rounded-2 border-0" type="submit">Rubah Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
