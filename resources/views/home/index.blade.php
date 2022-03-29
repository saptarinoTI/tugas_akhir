@extends('layout.app')
@section('main-title', 'Dashboard')
@section('main-page')
    {{-- @role('dosen')
        <div class="w-100 my-2">
            <form action="">
                <div class="row">
                    <div class="col">
                        <label class="form-label d-flex text-light fw-bold justify-content-end my-1">Filter berdasarkan
                            tahun</label>
                    </div>
                    <div class="col-sm-3 col-md-2 col-5"><select
                            class="form-select dropdown-toggle text-muted fw-semibold py-1 my-0" name="filter" id="filter">
                            @for ($i = date('Y'); $i >= '2021'; $i--)
                                <option value="{{ $i }}" @if (date('Y') == $i) selected @endif>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </form>
        </div>
    @endrole --}}

    @role('superadmin|admin|prodi')
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-link">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="fw-semibold text-muted">Total Mhs. Lulus</div>
                                <h2 class="fw-bold text-muted p-0 m-0 mt-1">{{ $totalMhsLulus }}</h2>
                                <div class="text-muted">Mahasiswa</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns=" http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-users icon-dashboard text-purple" width="32" height="32"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-link">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="fw-semibold text-muted">Mhs. Lulus {{ date('Y') }}</div>
                                <h2 class="fw-bold text-muted p-0 m-0 mt-1">{{ $totalMhsLulusThnIni }}</h2>
                                <div class="text-muted">Mahasiswa</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-search icon-dashboard text-info" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h1"></path>
                                    <circle cx="16.5" cy="17.5" r="2.5"></circle>
                                    <path d="M18.5 19.5l2.5 2.5"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-link">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="fw-semibold text-muted">Mhs. Lulus Tepat</div>
                                <h2 class="fw-bold text-muted p-0 m-0 mt-1">{{ count($totalMhsTepat) }}</h2>
                                <div class="text-muted">Mahasiswa</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-check icon-dashboard text-success" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 11l2 2l4 -4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-link">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="fw-semibold text-muted">Mhs. Lulus Lambat</div>
                                <h2 class="fw-bold text-muted p-0 m-0 mt-1">{{ count($totalMhsLambat) }}</h2>
                                <div class="text-muted">Mahasiswa</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-exclamation icon-dashboard text-danger" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <line x1="19" y1="7" x2="19" y2="10"></line>
                                    <line x1="19" y1="14" x2="19" y2="14.01"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    @role('dosen')
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted">Total Mhs.Bimbingan</div>
                            <div class="ms-auto">
                                <svg xmlns=" http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-users icon-dashboard text-purple" width="32" height="32"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0">{{ $mhsBimbingan }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted" id="tahun">Mhs.Bimbingan {{ date('Y') }}</div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-search icon-dashboard text-info" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h1"></path>
                                    <circle cx="16.5" cy="17.5" r="2.5"></circle>
                                    <path d="M18.5 19.5l2.5 2.5"></path>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0" id="mhsBimbinganTahun">{{ $mhsBimbinganTahun }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted" id="lulus">Mhs. Bimbingan Lulus Tepat</div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-check icon-dashboard text-success" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 11l2 2l4 -4"></path>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0" id="mhsBimbinganLulus">{{ $mhsBimbinganLulus }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted" id="lulus">Total Mhs.Bimbingan Lulus</div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-check icon-dashboard text-success" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 11l2 2l4 -4"></path>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0" id="mhsBimbinganLulus">{{ $mhsBimbinganLulus }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div> --}}
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted" id="blm_lulus">Mhs. Bimbingan Lulus Terlambat
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-exclamation icon-dashboard text-danger" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <line x1="19" y1="7" x2="19" y2="10"></line>
                                    <line x1="19" y1="14" x2="19" y2="14.01"></line>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0" id="mhsBimbinganBlmLulus">{{ $mhsBimbinganBlmLulus }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted" id="blm_lulus">Total Mhs.Bimbingan Blm.Lulus
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-exclamation icon-dashboard text-danger" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <line x1="19" y1="7" x2="19" y2="10"></line>
                                    <line x1="19" y1="14" x2="19" y2="14.01"></line>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0" id="mhsBimbinganBlmLulus">{{ $mhsBimbinganBlmLulus }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div> --}}
            </div>
        </div>
    @endrole

    @role('mahasiswa')
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-lg">
                    <div class="card-body markdown">
                        <h2>Informasi Tugas Akhir</h2>
                        <ul>
                            <li>
                                <p>Silahkan klik <a href="https://www.proditi.stitek.ac.id/halaman/detail/informasi-tugas-akhir"
                                        target="_blank">disini</a>, untuk mendapatkan informasi lebih lengkap dari
                                    tugas akhir.</p>
                            </li>
                        </ul>
                        <hr class="mb-3" />
                        <h2>Informasi Seminar Hasil</h2>
                        <p>Mendaftarkan diri dalam Seminar Hasil TA dengan menyiapkan syarat-syarat sebagai berikut:</p>
                        <ol>
                            <li>Naskah TA yang sudah ditanda* tangani oleh pembimbing sebanyak 1 rangkap asli + 3 rangkap
                                fotocopy.</li>
                            <li>Kartu Rencana Studi</li>
                            <li>Transkip Nilai</li>
                            <li>Bukti Penyerahan Laporan Kerja Praktek</li>
                            <li>Foto Copy Kartu Kuning / Surat Keterangan Keuangan Dari BAUK (Dengan Keterangan Pembayaran Tugas
                                Akhir Minimal 50%)</li>
                            <li>Menunjukan Lembar Aktifitas Tugas Akhir / Lembar Konsultasi</li>
                        </ol>
                        <hr class="mb-3" />
                        <h2>Informasi Pendadaran</h2>
                        <p>Mendaftarkan diri dalam Sidang Ujian TA dengan menyiapkan syarat-syarat sebagai berikut:</p>
                        <ol>
                            <li>Naskah Tugas Akhir sebanyak 4 rangkap (1 rangkap asli)</li>
                            <li>Kartu Rencana Studi</li>
                            <li>Transkip Nilai</li>
                            <li>Lembar Aktifitas Tugas Akhir</li>
                            <li>Surat Keterangan Bebas Perkuliahan dari BAAK</li>
                            <li>Surat Keterangan Bebas Keuangan dari BAUK</li>
                            <li>Surat Keterangan Bebas Perpustakaan</li>
                            <li>Surat Keterangan Bebas Laboratorium</li>
                            <li>Sertifikat Action Program</li>
                            <li>Sertifikat Kompetensi Laboratorium</li>
                            <li>Sertifikat TOEFL</li>
                            <li>Fotocopy ijazah terakhir</li>
                            <li>Fotocopy ijazah terakhir</li>
                            <li>Foto 3 x 4 berwarna (cetak dan softcopy), latar belakang merah, pakaian kemeja putih dan jas
                                berwarna hitam (pria memakai dasi)</li>
                        </ol>
                        <div class="w-100 text-end">
                            <p class="mt-5 fw-bolder mb-0">Tim Tugas Akhir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    @push('after-script')
        <script>
            $(document).ready(function() {
                $('#filter').on('change', function() {
                    var tahun = $(this).val();
                    var dosen = {{ auth()->user()->id }};
                    $('#tahun').html('Mhs.Bimbingan ' + tahun);
                    $('#lulus').html('Mhs.Bimbingan Lulus ' + tahun);
                    $('#blm_lulus').html('Mhs.Bimbingan Blm.Lulus ' + tahun);
                    /* Mahasiswa Bimbingan per Tahun */
                    $.ajax({
                        type: "GET",
                        url: "filter-dashboard-dosen/mhs-bimbingan/" + tahun,
                        success: function(response) {
                            $('#mhsBimbinganTahun').html(response);
                        }
                    });
                    /* Mahasiswa Lulus */
                    $.ajax({
                        type: "GET",
                        url: "/filter-dashboard-dosen/mhs-bimbingan-lulus/" + tahun,
                        success: function(response) {
                            $('#mhsBimbinganLulus').html(response);
                        }
                    });
                    /* Mahasiswa Belum Lulus */
                    $.ajax({
                        type: "GET",
                        url: "/filter-dashboard-dosen/mhs-bimbingan-belum-lulus/" + tahun,
                        success: function(response) {
                            $('#mhsBimbinganBlmLulus').html(response);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
