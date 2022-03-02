<p class="fw-semibold">Sebelum mendaftar Pendadaran pastikan data mahasiswa benar. Jika terdapat
    kesalahan silahkan rubah
    pada data mahasiswa.</p>
<form method="POST" action="{{ route('pendadaran.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- No Pendaftaran Pendadaran -->
    <div class="mb-3">
        <input type="hidden" class="form-control" name="id" value="{{ $proposal->id }}" readonly />
    </div>
    <!-- Proposal ID -->
    <div class="mb-3">
        <input type="hidden" class="form-control" name="proposal_id" value="{{ $proposal->id }}" readonly />
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">NIM Mahasiswa</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                    value="{{ $proposal->mahasiswa->nim }}" readonly />
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
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                    value="{{ strtoupper($proposal->mahasiswa->nama) }}" readonly required />
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
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                    value="{{ $proposal->mahasiswa->no_hp }}" readonly />
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
                <input type="text" class="form-control @error('ttl') is-invalid @enderror" name="ttl"
                    value="{{ strtoupper($proposal->mahasiswa->tpt_lahir) }}, {{ date('d F Y', strtotime($proposal->mahasiswa->tgl_lahir)) }}"
                    readonly required />
                @error('ttl')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat di Bontang</label>
        <textarea class="form-control" name="alamat" id="alamat" rows="2" required
            readonly>{{ strtoupper($proposal->mahasiswa->alamat) }}</textarea>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Nama Pembimbing Utama</label>
                <input type="text" class="form-control @error('dosen_id_satu') is-invalid @enderror"
                    name="dosen_id_satu" value="{{ strtoupper($proposal->dosen_satu->nama) }}" readonly required />
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
                <input type="text" class="form-control @error('dosen_id_dua') is-invalid @enderror" name="dosen_id_dua"
                    value="{{ strtoupper($proposal->dosen_dua->nama) }}" readonly required />
                @error('dosen_id_dua')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <hr class="p-0 my-2" />
    <p class="fw-semibold text-muted">Silahkan Upload File sesuai syarat-syarat untuk Mendaftar Seminar
        Hasil Tugas Akhir.</p>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-2">
                <label class="form-label">Kartu Rencana Studi</label>
                <input type="file" class="form-control @error('krs') is-invalid @enderror" name="krs" required />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
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
                <input type="file" class="form-control @error('transkip_nilai') is-invalid @enderror"
                    name="transkip_nilai" required />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
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
                <label class="form-label">Lembar Aktifitas Tugas Akhir / Lembar Konsultasi</label>
                <input type="file" class="form-control @error('lmbr_konsultasi') is-invalid @enderror"
                    name="lmbr_konsultasi" required />
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
                <input type="file" class="form-control @error('bebas_perkuliahan') is-invalid @enderror"
                    name="bebas_perkuliahan" required />
                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
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
                <input type="file" class="form-control @error('bebas_keuangan') is-invalid @enderror"
                    name="bebas_keuangan" required />
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
                <input type="file" class="form-control @error('bebas_perpus') is-invalid @enderror" name="bebas_perpus"
                    required />
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
                <input type="file" class="form-control @error('bebas_lab') is-invalid @enderror" name="bebas_lab"
                    required />
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
                <input type="file" class="form-control @error('act_program') is-invalid @enderror" name="act_program"
                    required />
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
                <input type="file" class="form-control @error('komp_lab') is-invalid @enderror" name="komp_lab"
                    required />
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
                <input type="file" class="form-control @error('toefl') is-invalid @enderror" name="toefl" required />
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
                <input type="file" class="form-control @error('ijazah_terakhir') is-invalid @enderror"
                    name="ijazah_terakhir" required />
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
                <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp" required />
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
                <input type="file" class="form-control @error('akte_kelahiran') is-invalid @enderror"
                    name="akte_kelahiran" required />
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
                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" required />
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
        <textarea name="judul_ta" rows="3" class="form-control @error('judul_ta') is-invalid @enderror"
            required></textarea>
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
            Simpan Data
        </button>
    </div>
</form>
