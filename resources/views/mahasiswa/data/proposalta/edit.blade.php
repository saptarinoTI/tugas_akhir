@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Rubah Ajuan Proposal Tugas Akhir Mahasiswa</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('proposal.update', $proposal->id) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row">
            {{-- No Ajuan Proposal --}}
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">No Ajuan Proposal</label>
                <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $proposal->id }}" readonly />
                @error('id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            {{-- NIM Mahasiswa --}}
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">NIM Mahasiswa</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ $proposal->mahasiswa->nim }}" readonly />
                @error('nim')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <hr class="p-0 my-2" />
          <p class="fw-semibold text-muted">Silahkan upload proposal tugas akhir. Maksimal mengajukan 3
            judul
            untuk proposal tugas akhir.
          </p>
          {{-- Proposal Satu --}}
          <div class="mb-2">
            <label class="form-label">Proposal Satu</label>
            @if ($proposal->file_satu != null)
            <p class="mb-1"><i class='bx bx-check-double'></i>
              <a href="/storage/{{ $proposal->file_satu }}" target="_blank" rel="noopener noreferrer" class="text-gray fw-semibold">{{ ucwords($proposal->judul_satu) }} - <i class='bx bxs-download'></i></a>
            </p>
            @endif
            </p>
            <input type="file" class="form-control @error('file_satu') is-invalid @enderror" name="file_satu" />
            <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
            @error('file_satu')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-2">
            <label class="form-label">Judul Proposal Satu</label>
            <input type="text" class="form-control @error('judul_satu') is-invalid @enderror" name="judul_satu" autocomplete="off" />
            @error('judul_satu')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          {{-- Proposal Dua --}}
          <div class="mb-2">
            <label class="form-label">Proposal Dua</label>
            @if ($proposal->file_dua != null)
            <p class="mb-1"><i class='bx bx-check-double'></i>
              <a href="/storage/{{ $proposal->file_dua }}" target="_blank" rel="noopener noreferrer" class="text-gray fw-semibold">{{ ucwords($proposal->judul_dua) }} - <i class='bx bxs-download'></i></a>
            </p>
            @endif
            <input type="file" class="form-control @error('file_dua') is-invalid @enderror" name="file_dua" />
            <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
            @error('file_dua')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-2">
            <label class="form-label">Judul Proposal Dua</label>
            <input type="text" class="form-control @error('judul_dua') is-invalid @enderror" name="judul_dua" autocomplete="off" />
            @error('judul_dua')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          {{-- Proposal Tiga --}}
          <div class="mb-2">
            <label class="form-label">Proposal Tiga</label>
            @if ($proposal->file_tiga != null)
            <p class="mb-1"><i class='bx bx-check-double'></i>
              <a href="/storage/{{ $proposal->file_tiga }}" target="_blank" rel="noopener noreferrer" class="text-gray fw-semibold">{{ ucwords($proposal->judul_tiga) }} - <i class='bx bxs-download'></i></a>
            </p>
            @endif
            <input type="file" class="form-control @error('file_tiga') is-invalid @enderror" name="file_tiga" />
            <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
            @error('file_tiga')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-2">
            <label class="form-label">Judul Proposal Tiga</label>
            <input type="text" class="form-control @error('judul_tiga') is-invalid @enderror" name="judul_tiga" autocomplete="off" />
            @error('judul_tiga')
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
