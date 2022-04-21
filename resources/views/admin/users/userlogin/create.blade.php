@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tambah Data User Login</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('user-login.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Input username" value="{{ old('username') }}" autocomplete="off" />
            <span class="small text-secondary">* Silahkan input username hanya angka saja.</span>
            @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input name" value="{{ old('name') }}" autocomplete="off" />
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" placeholder="Select role">
              @foreach ($roles as $role)
              <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>
              @endforeach
              @error('role')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
