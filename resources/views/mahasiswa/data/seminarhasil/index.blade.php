@extends('layout.app')
@section('main-title', 'Pendaftaran Seminar Hasil')
@section('main-title2')
    @if (!$seminar)
        <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
            data-bs-target="#modal-pendaftaran-seminarhasil">
            <span class="small">Pendaftaran Seminar Hasil</span>
        </a>
    @endif
@endsection
@section('main-page')
    <div class="row row-deck row-cards">
        <span class=mt-0 pt-0">Untuk ketentuan dari Seminar Hasil Tugas Akhir silahkan lihat buku panduan Tugas Akhir
            yang bisa didapatkan dibagian Prodi.</span>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table_seminar_hasil" class="table card-table table-vcenter datatable nowrap"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted col-2">Status</th>
                                <th class="text-muted">Catatan</th>
                                <th class="text-muted col-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($seminar)
                                <td class="fw-semibold text-dark">
                                    @if ($seminar->status == 'diterima')
                                        <span class="badge bg-dark">Diterima
                                        @elseif ($seminar->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak
                                            @elseif ($seminar->status == 'selesai')
                                                <span class="badge bg-success">Selesai
                                                @else
                                                    <span class="badge bg-info">Dikirim
                                    @endif
                                    </span>
                                </td>
                                <td class="fw-semibold text-dark">{{ ucwords($seminar->keterangan) }}</td>
                                @if ($seminar->status == 'ditolak' or $seminar->status == 'dikirim')
                                    <td>
                                        <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#modal-edit">
                                            <span class="small"><i class="ti ti-pencil"></i></span>
                                        </a>
                                        <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal"
                                            data-bs-target="#modal-detail"
                                            data-remote="{{ route('seminar-hasil.show', $seminar->id) }}"
                                            data-title="Detail Pendaftaran Seminar Hasil Tugas Akhir">
                                            <span class="small"><i class="ti ti-eye"></i></span>
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal"
                                            data-bs-target="#modal-detail"
                                            data-remote="{{ route('seminar-hasil.show', $seminar->id) }}"
                                            data-title="Detail Pendaftaran Seminar Hasil Tugas Akhir">
                                            <span class="small"><i class="ti ti-eye"></i></span>
                                        </a>
                                    </td>
                                @endif
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('before-script')
        {{-- Modal Pendaftaran Seminar Hasil Tugas Akhir --}}
        <div class="modal modal-blur fade" id="modal-pendaftaran-seminarhasil" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-full-width modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pendaftaran Seminar Hasil Tugas Akhir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-semibold">Sebelum mendaftar Seminar Hasil pastikan data mahasiswa benar. Jika terdapat
                            kesalahan silahkan rubah
                            pada data mahasiswa.</p>
                        <form method="POST" action="{{ route('seminar-hasil.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- No Pendaftaran Seminar Hasil -->
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="id" value="{{ $noSeminar }}" readonly />
                            </div>
                            <!-- Proposal ID -->
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="proposal_id" value="{{ $proposal->id }}"
                                    readonly />
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
                                            value="{{ ucwords($proposal->mahasiswa->nama) }}" readonly required />
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
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            name="no_hp" value="{{ $proposal->mahasiswa->no_hp }}" readonly />
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
                                            value="{{ ucwords($proposal->mahasiswa->tpt_lahir) }}, {{ date('d F Y', strtotime($proposal->mahasiswa->tgl_lahir)) }}"
                                            readonly required />
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
                                        <input type="text" class="form-control @error('dosen_id_satu') is-invalid @enderror"
                                            name="dosen_id_satu" value="{{ ucwords($proposal->dosen_satu->nama) }}" readonly
                                            required />
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
                                        <input type="text" class="form-control @error('dosen_id_dua') is-invalid @enderror"
                                            name="dosen_id_dua" value="{{ ucwords($proposal->dosen_dua->nama) }}" readonly
                                            required />
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
                                        <input type="file" class="form-control @error('krs') is-invalid @enderror" name="krs"
                                            required />
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
                                        <label class="form-label">Bukti Penyerahan Laporan Kerja Praktek</label>
                                        <input type="file" class="form-control @error('laporan_kp') is-invalid @enderror"
                                            name="laporan_kp" required />
                                        <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
                                        @error('laporan_kp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Kartu Kuning</label>
                                        <input type="file" class="form-control @error('kartu_kuning') is-invalid @enderror"
                                            name="kartu_kuning" required />
                                        <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
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
                                        <label class="form-label">Keterangan Keuangan dari BAUK (Pembayaran TA Min.
                                            50%)</label>
                                        <input type="file" class="form-control @error('sk_keuangan') is-invalid @enderror"
                                            name="sk_keuangan" required />
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
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Judul Tugas Akhir</label>
                                <textarea name="judul_ta" rows="3" class="form-control @error('judul_ta') is-invalid @enderror" required></textarea>
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
                    </div>
                </div>
            </div>
        </div>

        @if ($seminar != null)
            {{-- Modal Edit Pendaftaran Seminar Hasil Tugas Akhir --}}
            <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-full-width modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Rubah Pendaftaran Seminar Hasil Tugas Akhir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('seminar-hasil.update', $seminar->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">NIM Mahasiswa</label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                                name="nim" value="{{ $proposal->mahasiswa->nim }}" readonly />
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
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" value="{{ ucwords($proposal->mahasiswa->nama) }}" readonly
                                                required />
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
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                name="no_hp" value="{{ $proposal->mahasiswa->no_hp }}" readonly />
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
                                            <input type="text" class="form-control @error('ttl') is-invalid @enderror"
                                                name="ttl"
                                                value="{{ ucwords($proposal->mahasiswa->tpt_lahir) }}, {{ date('d F Y', strtotime($proposal->mahasiswa->tgl_lahir)) }}"
                                                readonly required />
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
                                            <input type="text"
                                                class="form-control @error('dosen_id_satu') is-invalid @enderror"
                                                name="dosen_id_satu" value="{{ ucwords($proposal->dosen_satu->nama) }}"
                                                readonly required />
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
                                            <input type="text"
                                                class="form-control @error('dosen_id_dua') is-invalid @enderror"
                                                name="dosen_id_dua" value="{{ ucwords($proposal->dosen_dua->nama) }}"
                                                readonly required />
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
                                            <a href="{{ Storage::url($seminar->krs) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-decoration-none fw-semibold text-muted-light">
                                                <i class="ti ti-file-download" style="font-size: 18px;"></i> File
                                            </a>
                                            <input type="file" class="form-control @error('krs') is-invalid @enderror"
                                                name="krs" />
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
                                            <a href="{{ Storage::url($seminar->transkip_nilai) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-decoration-none fw-semibold text-muted-light">
                                                <i class="ti ti-file-download" style="font-size: 18px;"></i> File
                                            </a>
                                            <input type="file"
                                                class="form-control @error('transkip_nilai') is-invalid @enderror"
                                                name="transkip_nilai" />
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
                                            <a href="{{ Storage::url($seminar->laporan_kp) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-decoration-none fw-semibold text-muted-light">
                                                <i class="ti ti-file-download" style="font-size: 18px;"></i> File
                                            </a>
                                            <input type="file" class="form-control @error('laporan_kp') is-invalid @enderror"
                                                name="laporan_kp" />
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
                                            <a href="{{ Storage::url($seminar->kartu_kuning) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-decoration-none fw-semibold text-muted-light">
                                                <i class="ti ti-file-download" style="font-size: 18px;"></i> File
                                            </a>
                                            <input type="file"
                                                class="form-control @error('kartu_kuning') is-invalid @enderror"
                                                name="kartu_kuning" />
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
                                            <a href="{{ Storage::url($seminar->sk_keuangan) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-decoration-none fw-semibold text-muted-light">
                                                <i class="ti ti-file-download" style="font-size: 18px;"></i> File
                                            </a>
                                            <input type="file" class="form-control @error('sk_keuangan') is-invalid @enderror"
                                                name="sk_keuangan" />
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
                                            <a href="{{ Storage::url($seminar->lmbr_konsultasi) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-decoration-none fw-semibold text-muted-light">
                                                <i class="ti ti-file-download" style="font-size: 18px;"></i> File
                                            </a>
                                            <input type="file"
                                                class="form-control @error('lmbr_konsultasi') is-invalid @enderror"
                                                name="lmbr_konsultasi" />
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
                                    <textarea name="judul_ta" rows="3" class="form-control @error('judul_ta') is-invalid @enderror"
                                        required>{{ $seminar->judul_ta }}</textarea>
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
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endpush
    @push('after-script')
        <script>
            $(document).ready(function($) {
                // Modal
                $("#modal-detail").on("show.bs.modal", function(e) {
                    var button = $(e.relatedTarget);
                    var modal = $(this);
                    modal.find(".modal-body").load(button.data("remote"));
                    modal.find(".modal-title").html(button.data("title"));
                });
            });
        </script>

        {{-- Modal Detail Pendaftaran Seminar Hasil Tugas Akhir --}}
        <div class="modal modal-blur fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-full-width modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pendaftaran Seminar Hasil Tugas Akhir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    @endpush
@endsection
