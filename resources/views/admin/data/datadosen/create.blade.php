@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tambah Data Dosen</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('data-dosen.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="id_dosen" class="form-control @error('id_dosen') is-invalid @enderror" placeholder="Input id" value="{{ old('id_dosen') }}" autocomplete="off" />
            <span class="small text-secondary">* Silahkan input id dosen hanya angka saja.</span>
            @error('id_dosen')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Input name" value="{{ old('nama') }}" autocomplete="off" />
            @error('nama')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
