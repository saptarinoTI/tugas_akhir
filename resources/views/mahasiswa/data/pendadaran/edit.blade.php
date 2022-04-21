@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Rubah Pendaftaran Pendadaran Tugas Akhir Mahasiswa</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('pendadaran.update', $pendadaran->id) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Kartu Rencana Studi</label>
                <a href="{{ Storage::url($pendadaran->krs) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
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
                <label class="form-label">Transkip Nilai</label>
                <a href="{{ Storage::url($pendadaran->transkip_nilai) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
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
                <label class="form-label">Lembar Aktifitas Tugas Akhir / Lembar
                  Konsultasi</label>
                <a href="{{ Storage::url($pendadaran->lmbr_konsultasi) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
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
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">SK Bebas Perkuliahan dari BAAK</label>
                <a href="{{ Storage::url($pendadaran->bebas_perkuliahan) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('bebas_perkuliahan') is-invalid @enderror" name="bebas_perkuliahan" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('bebas_perkuliahan')
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
                <label class="form-label">SK Bebas Keuangan dari BAUK</label>
                <a href="{{ Storage::url($pendadaran->bebas_keuangan) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('bebas_keuangan') is-invalid @enderror" name="bebas_keuangan" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('bebas_keuangan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">SK Bebas Perpustakaan</label>
                <a href="{{ Storage::url($pendadaran->bebas_perpus) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('bebas_perpus') is-invalid @enderror" name="bebas_perpus" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('bebas_perpus')
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
                <label class="form-label">SK Bebas Laboratoium</label>
                <a href="{{ Storage::url($pendadaran->bebas_lab) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('bebas_lab') is-invalid @enderror" name="bebas_lab" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('bebas_lab')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Sertifikat Action Program</label>
                <a href="{{ Storage::url($pendadaran->act_program) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('act_program') is-invalid @enderror" name="act_program" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('act_program')
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
                <label class="form-label">Sertifikat Kompetensi Lab</label>
                <a href="{{ Storage::url($pendadaran->komp_lab) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('komp_lab') is-invalid @enderror" name="komp_lab" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('komp_lab')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Sertifikat TOEFL</label>
                <a href="{{ Storage::url($pendadaran->toefl) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('toefl') is-invalid @enderror" name="toefl" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('toefl')
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
                <label class="form-label">Ijazah Terakhir</label>
                <a href="{{ Storage::url($pendadaran->ijazah_terakhir) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('ijazah_terakhir') is-invalid @enderror" name="ijazah_terakhir" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('ijazah_terakhir')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Kartu Tanda Penduduk (KTP)</label>
                <a href="{{ Storage::url($pendadaran->ktp) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('ktp')
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
                <label class="form-label">Akte Kelahiran</label>
                <a href="{{ Storage::url($pendadaran->akte_kelahiran) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('akte_kelahiran') is-invalid @enderror" name="akte_kelahiran" />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1
                  MB.</span>
                @error('akte_kelahiran')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Foto 3x4 latar belakang merah (cetak dan
                  softcopy)</label>
                <a href="{{ Storage::url($pendadaran->foto) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-muted-light">
                  <i class='bx bx-chevrons-right'></i> File
                </a>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" />
                <span class="small text-muted-light fw-semibold">* Upload foto maksimal 1
                  MB.</span>
                @error('foto')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label class="form-label">Judul Tugas Akhir</label>
            <textarea name="judul_ta" rows="3" class="form-control @error('judul_ta') is-invalid @enderror" required>{{ $pendadaran->judul_ta }}</textarea>
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
