@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Rubah Pendaftaran Seminar Hasil Tugas Akhir</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('seminar.update', $seminar->id) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">NIM Mahasiswa</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ $seminar->mahasiswa->nim }}" readonly />
                @error('nim')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ ucwords($seminar->mahasiswa->nama) }}" readonly required />
                @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $seminar->mahasiswa->no_hp }}" readonly />
                @error('no_hp')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tempat dan Tgl Lahir</label>
                <input type="text" class="form-control @error('ttl') is-invalid @enderror" name="ttl" value="{{ ucwords($seminar->mahasiswa->tpt_lahir) }}, {{ date('d F Y', strtotime($seminar->mahasiswa->tgl_lahir)) }}" readonly required />
                @error('ttl')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Pembimbing Utama</label>
                <input type="text" class="form-control @error('dosen_id_satu') is-invalid @enderror" name="dosen_id_satu" value="{{ ucwords($seminar->proposal->dosen_satu->nama) }}" readonly required />
                @error('dosen_id_satu')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Pembimbing Pendamping</label>
                <input type="text" class="form-control @error('dosen_id_dua') is-invalid @enderror" name="dosen_id_dua" value="{{ ucwords($seminar->proposal->dosen_dua->nama) }}" readonly required />
                @error('dosen_id_dua')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <hr class="p-0 my-2" />
          <p class="fw-semibold text-muted">Silahkan Upload File sesuai syarat-syarat untuk Mendaftar
            Seminar
            Hasil Tugas Akhir.</p>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label mt-0 pt-0">Kartu Rencana Studi</label>
                <a href="{{ Storage::url($seminar->krs) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('krs') is-invalid @enderror" name="krs" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('krs')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label mt-0 pt-0">Transkip Nilai</label>
                <a href="{{ Storage::url($seminar->transkip_nilai) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('transkip_nilai') is-invalid @enderror" name="transkip_nilai" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('transkip_nilai')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label mt-0 pt-0">Bukti Penyerahan Laporan Kerja Praktek</label>
                <a href="{{ Storage::url($seminar->laporan_kp) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('laporan_kp') is-invalid @enderror" name="laporan_kp" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('laporan_kp')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label mt-0 pt-0">Kartu Kuning</label>
                <a href="{{ Storage::url($seminar->kartu_kuning) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('kartu_kuning') is-invalid @enderror" name="kartu_kuning" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('kartu_kuning')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label mt-0 pt-0">Keterangan Keuangan dari BAUK (Pembayaran TA
                  Min.
                  50%)</label>
                <a href="{{ Storage::url($seminar->sk_keuangan) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('sk_keuangan') is-invalid @enderror" name="sk_keuangan" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('sk_keuangan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label mt-0 pt-0">Lembar Aktifitas Tugas Akhir / Lembar
                  Konsultasi</label>
                <a href="{{ Storage::url($seminar->lmbr_konsultasi) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('lmbr_konsultasi') is-invalid @enderror" name="lmbr_konsultasi" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('lmbr_konsultasi')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label class="form-label">Judul Tugas Akhir</label>
            <textarea name="judul_ta" rows="3" class="form-control @error('judul_ta') is-invalid @enderror" required>{{ $seminar->judul_ta }}</textarea>
            @error('judul_ta')
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
