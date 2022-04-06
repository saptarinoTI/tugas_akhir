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
        <!-- Pertahun -->
        <div class="row row-deck row-cards my-1">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <a href="{{ route('data-mahasiswa.index') }}" class="text-decoration-none">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-blue text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-semibold text-muted mt-2">
                                        Mahasiswa Terdaftar {{ date('Y') }}
                                    </div>
                                    <div class="fw-bolder text-muted mb-2 mt-1">
                                        <span class="fs-2">{{ $totalMhsTahun }} </span> <span
                                            class="fw-lighter">
                                            Mahasiswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <a href="{{ route('data-proposal.index') }}" class="text-decoration-none">
                        @if ($totalProposal > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        @endif
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-red text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-semibold text-muted mt-2">
                                        Pendt. ProposalTA Baru
                                    </div>
                                    <div class="fw-bolder text-muted mb-2 mt-1">
                                        <span class="fs-2">{{ $totalProposal }} </span> <span
                                            class="fw-lighter">
                                            Mahasiswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <a href="{{ route('data-seminar-hasil.index') }}" class="text-decoration-none">
                        @if ($totalSemhas > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        @endif
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-yellow text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-minus"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <line x1="9" y1="14" x2="15" y2="14"></line>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-semibold text-muted mt-2">
                                        Pendt. Seminar Hasil Baru
                                    </div>
                                    <div class="fw-bolder text-muted mb-2 mt-1">
                                        <span class="fs-2">{{ $totalSemhas }} </span> <span class="fw-lighter">
                                            Mahasiswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <a href="{{ route('data-pendadaran.index') }}" class="text-decoration-none">
                        @if ($totalPend > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        @endif
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <line x1="9" y1="9" x2="10" y2="9"></line>
                                            <line x1="9" y1="13" x2="15" y2="13"></line>
                                            <line x1="9" y1="17" x2="15" y2="17"></line>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-semibold text-muted mt-2">
                                        Pendt. Pendadaran Baru
                                    </div>
                                    <div class="fw-bolder text-muted mb-2 mt-1">
                                        <span class="fs-2">{{ $totalPend }} </span> <span class="fw-lighter">
                                            Mahasiswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endrole

    @role('dosen')
        <div class="row row-deck row-cards mb-3">
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted">Proposal Tugas Akhir</div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-minus"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                    </path>
                                    <line x1="9" y1="14" x2="15" y2="14"></line>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0">{{ $proposalProgres->count() }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted">Seminar Hasil</div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                    </path>
                                    <path d="M9 17h6"></path>
                                    <path d="M9 13h6"></path>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0">{{ $semhasProgres->count() }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fw-semibold text-muted">Pendadaran</div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                    </path>
                                    <line x1="9" y1="9" x2="10" y2="9"></line>
                                    <line x1="9" y1="13" x2="15" y2="13"></line>
                                    <line x1="9" y1="17" x2="15" y2="17"></line>
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-muted p-0 m-0">{{ $pendadaranProgres->count() }}</h2>
                        <div class="text-muted">Mahasiswa</div>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="row row-deck row-cards">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card">
                                               <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="fw-semibold text-dark">Proposal Tugas Akhir</div>
                                                    <div class="ms-auto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-minus"
                                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                            </path>
                                                            <line x1="9" y1="14" x2="15" y2="14"></line>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <h2 class="fw-bold text-dark p-0 m-0">{{ $proposalProgres->count() }}</h2>
                                                <div class="text-dark">Mahasiswa</div>
                                                {{-- </div> --}}
                                                <div class="accordion mt-3" id="accordion-example">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading-1">
                                                            <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse-1" aria-expanded="true">
                                                                Mahasiswa Proposal Tugas Akhir
                                                            </button>
                                                        </h2>
                                                        <div id="collapse-1" class="accordion-collapse collapse show"
                                                            data-bs-parent="#accordion-example">
                                                            <div class="accordion-body pt-0">
                                                                @foreach ($proposalProgres as $item)
        <div class="list-group list-group-flush list-group-hoverable">
                                                                        <div class="list-group-item">
                                                                            <div class="row align-items-center">
                                                                                <div class="col-auto"><span class="badge bg-red"></span></div>
                                                                                <div class="col text-truncate">
                                                                                    <a href="#" class="text-reset d-block">Paweł Kuna</a>
                                                                                    <div class="d-block text-muted text-truncate mt-n1">Change
                                                                                        deprecated
                                                                                        html
                                                                                        tags to text decoration classes (#29604)</div>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    fjkdsnjfknsdjk
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
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
                            <li>Naskah TA yang sudah ditanda* tangani oleh pembimbing sebanyak 1 rangkap asli + 3
                                rangkap
                                fotocopy.</li>
                            <li>Kartu Rencana Studi</li>
                            <li>Transkip Nilai</li>
                            <li>Bukti Penyerahan Laporan Kerja Praktek</li>
                            <li>Foto Copy Kartu Kuning / Surat Keterangan Keuangan Dari BAUK (Dengan Keterangan
                                Pembayaran Tugas
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
                            <li>Foto 3 x 4 berwarna (cetak dan softcopy), latar belakang merah, pakaian kemeja putih dan
                                jas
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
