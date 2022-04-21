@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Diri Mahasiswa</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('data-diri.update', $mahasiswa->nim) }}">
          @csrf
          @method('PATCH')
          {{-- NIM Mahasiswa --}}
          <div class="mb-3">
            <label class="form-label">NIM Mahasiswa</label>
            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ ucwords($mahasiswa->nim) }}" readonly>
            @error('nim')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          {{-- Nama Mahasiswa --}}
          <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autocomplete="off" value="{{ $mahasiswa->nama }}">
            @error('nama')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          {{-- Nomor Hp --}}
          <div class="mb-3">
            <label class="form-label">Nomor Hp</label>
            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" required autocomplete="off" value="{{ $mahasiswa->no_hp }}">
            @error('no_hp')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="row">
            <div class="col-lg-5">
              {{-- Tempat Lahir --}}
              <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control @error('tpt_lahir') is-invalid @enderror" name="tpt_lahir" required autocomplete="off" value="{{ $mahasiswa->tpt_lahir }}">
                @error('tpt_lahir')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-lg-7">
              <div class="mb-3">
                {{-- Tanggal Lahir --}}
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" required autocomplete="off" value="{{ $mahasiswa->tgl_lahir }}">
                @error('tgl_lahir')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          {{-- Alamat Lengkap --}}
          <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" rows="2" name="alamat" required autocomplete="off">{{ $mahasiswa->alamat }}</textarea>
            @error('alamat')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="w-100 text-end">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-sm py-1 btn-primary rounded-2">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
