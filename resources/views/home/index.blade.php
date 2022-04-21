@extends('layouts.apps')

@section('main-content')
@role('superadmin|admin|prodi')
<div class="row">
  <!-- Result Lulusan -->
  <div class="col-lg-8 col-12 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col">
          <h5 class="card-header m-0 me-2 pb-3">Lulusan Mahasiswa Teknik Informatika</h5>
          <div id="totalRevenueChart" class="px-2 p-6 m-2 bg-white"> {!! $mahasiswaLulusChart->container() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Result Lulusan -->
  <div class="col-lg-4 col-12">
    <div class="row">
      <!-- Result Proposal -->
      <div class="col-12 mb-4">
        <a href="{{ route('data-proposal.index') }}">
          <div class="card">
            @if($proposalStatusSend > 0)
            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
              <span class="visually-hidden">New alerts</span>
            </span>
            @endif
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <i style="font-size: 20px" class='bx bx-book-alt p-2 rounded-circle bg-danger text-white'></i>
              </div>
              <span class="fw-semibold d-block mb-1">Pendaftaran Proposal</span>
              <div>
                <span class="fw-bold card-title mb-2 h5">{!! $proposalStatusSend !!} </span>
                <small class="text-secondary fw-normal">Mahasiswa</small>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- /Result Proposal -->
      <!-- Result SeminarHasil -->
      <div class="col-12 mb-4">
        <a href="{{ route('data-seminar.index') }}">
          <div class="card">
            @if($semhasStatusSend > 0)
            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
              <span class="visually-hidden">New alerts</span>
            </span>
            @endif
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <i class='bx bx-book p-2 rounded-circle bg-warning text-white'></i>
              </div>
              <span class="fw-semibold d-block mb-1">Pendaftaran Seminar Hasil</span>
              <div>
                <span class="fw-bold card-title mb-2 h5">{!! $semhasStatusSend !!} </span>
                <small class="text-secondary fw-normal">Mahasiswa</small>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- /Result SeminarHasil -->
      <!-- Result Pendadaran -->
      <div class="col-12 mb-4">
        <a href="{{ route('data-pendadaran.index') }}">
          <div class="card">
            @if($pendadaranStatusSend > 0)
            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
              <span class="visually-hidden">New alerts</span>
            </span>
            @endif
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <i style="font-size: 20px" class='bx bx-book-bookmark p-2 rounded-circle bg-success text-white'></i>
              </div>
              <span class="fw-semibold d-block mb-1">Pendaftaran Pendadaran</span>
              <div>
                <span class="fw-bold card-title mb-2 h5">{!! $pendadaranStatusSend !!} </span>
                <small class="text-secondary fw-normal">Mahasiswa</small>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- /Result Pendadaran -->
    </div>
  </div>
</div>

@push('after-script')
<script src="{{ $mahasiswaLulusChart->cdn() }}"></script>
{{ $mahasiswaLulusChart->script() }}
@endpush
@endrole

@role('mahasiswa')
<div class="card">
  <div class="card-body">
    <h5 class="fw-bold">Informasi Tugas Akhir</h5>
    <i class='bx bxs-chevrons-right'></i> <span>Silahkan klik <a href="https://www.proditi.stitek.ac.id/halaman/detail/informasi-tugas-akhir" target="_blank">disini</a>, untuk mendapatkan informasi lebih lengkap dari
      tugas akhir.</span>
    <hr class="mb-3" />
    <h5 class="fw-bold">Informasi Seminar Hasil</h5>
    <p>Mendaftarkan diri dalam Seminar Hasil TA dengan menyiapkan syarat-syarat sebagai berikut:</p>
    <p><i class='bx bxs-chevrons-right'></i> Naskah TA yang sudah ditanda* tangani oleh pembimbing sebanyak 1 rangkap asli + 3 rangkap fotocopy.</p>
    <p><i class='bx bxs-chevrons-right'></i> Kartu Rencana Studi</p>
    <p><i class='bx bxs-chevrons-right'></i> Transkip Nilai</p>
    <p><i class='bx bxs-chevrons-right'></i> Bukti Penyerahan Laporan Kerja Praktek</p>
    <p><i class='bx bxs-chevrons-right'></i> Foto Copy Kartu Kuning / Surat Keterangan Keuangan Dari BAUK (Dengan Keterangan Pembayaran Tugas Akhir Minimal 50%)</p>
    <p><i class='bx bxs-chevrons-right'></i> Menunjukan Lembar Aktifitas Tugas Akhir / Lembar Konsultasi</p>
    <hr class="mb-3" />
    <h5 class="fw-bold">Informasi Pendadaran</h5>
    <p>Mendaftarkan diri dalam Sidang Ujian TA dengan menyiapkan syarat-syarat sebagai berikut:</p>
    <p><i class='bx bxs-chevrons-right'></i> Naskah Tugas Akhir sebanyak 4 rangkap (1 rangkap asli)</p>
    <p><i class='bx bxs-chevrons-right'></i> Kartu Rencana Studi</p>
    <p><i class='bx bxs-chevrons-right'></i> Transkip Nilai</p>
    <p><i class='bx bxs-chevrons-right'></i> Lembar Aktifitas Tugas Akhir</p>
    <p><i class='bx bxs-chevrons-right'></i> Surat Keterangan Bebas Perkuliahan dari BAAK</p>
    <p><i class='bx bxs-chevrons-right'></i> Surat Keterangan Bebas Keuangan dari BAUK</p>
    <p><i class='bx bxs-chevrons-right'></i> Surat Keterangan Bebas Perpustakaan</p>
    <p><i class='bx bxs-chevrons-right'></i> Surat Keterangan Bebas Laboratorium</p>
    <p><i class='bx bxs-chevrons-right'></i> Sertifikat Action Program</p>
    <p><i class='bx bxs-chevrons-right'></i> Sertifikat Kompetensi Laboratorium</p>
    <p><i class='bx bxs-chevrons-right'></i> Sertifikat TOEFL</p>
    <p><i class='bx bxs-chevrons-right'></i> Fotocopy ijazah terakhir</p>
    <p><i class='bx bxs-chevrons-right'></i> Fotocopy ijazah terakhir</p>
    <p><i class='bx bxs-chevrons-right'></i> Foto 3 x 4 berwarna (cetak dan softcopy), latar belakang merah, pakaian kemeja putih dan
      jas
      berwarna hitam (pria memakai dasi)</p>
    <div class="w-100 text-end">
      <p class="mt-5 fw-bolder mb-0">Tim Tugas Akhir</p>
    </div>
  </div>
</div>
@endrole

@role('dosen')
<div class="row">
  <!-- Result Proposal -->
  <div class="col-12 col-lg-4 mb-4">
    <div class="card">
      <div class="card-body">
        <a href="{{ route('proposal-mahasiswa.index') }}">
          <div class="card-title d-flex align-items-start justify-content-between">
            <i style="font-size: 20px" class='bx bx-book-alt p-2 rounded-circle bg-danger text-white'></i>
          </div>
          <span class="fw-semibold d-block mb-1">Proposal Tugas Akhir</span>
          <div>
            <span class="fw-bold card-title mb-2 h5">{{ count($proposalProgres) }}</span>
            <small class="text-secondary fw-normal">Mahasiswa</small>
          </div>
        </a>
        <div class="accordion mt-3" id="accordion-proposal-ta">
          <div class="card accordion-item active">
            <h2 class="accordion-header" id="headingOne">
              <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-proposal-ta" aria-expanded="true" aria-controls="collapse-proposal-ta">
                Mahasiswa Proposal Tugas Akhir
              </button>
            </h2>
            <div id="collapse-proposal-ta" class="accordion-collapse collapse show" data-bs-parent="#accordion-proposal-ta">
              <div class="accordion-body">
                <!-- List group -->
                <div class="demo-inline-spacing mt-3">
                  <ol class="list-group list-group-flush">
                    @foreach ($proposalProgres->take(5) as $item)
                    <li class="list-group-item d-flex justify-content-end align-items-center">
                      <a href="." class="text-decoration-none text-reset d-block me-auto">{{ ucwords($item->mahasiswa->nama) }}</a>
                      @php
                      $now = \Carbon\Carbon::parse();
                      $tgl = \Carbon\Carbon::parse($item->tgl_acc);
                      $result = $tgl->diffInDays($now);
                      echo '<div class="col-auto"><sup> + </sup> ' . $result . ' hari</div>';
                      if ($result >= 60) {
                      echo '<span class="badge badge-center"><i class="bx bxs-circle" style="color: red"></i></span>';
                      } elseif ($result >= 30) {
                      echo '<span class="badge badge-center"><i class="bx bxs-circle" style="color: yellow"></i></span>';
                      } elseif ($result <= 29) { echo '<span class="badge badge-center"><i class="bx bxs-circle" style="color: green"></i></span>' ; } @endphp </li>
                        @endforeach
                  </ol>
                </div>
                <!--/ List group -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- /Result Proposal -->
  <!-- Result SeminarHasil -->
  <div class="col-12 col-lg-4 mb-4">
    <div class="card">
      <div class="card-body">
        <a href="{{ route('seminar-mahasiswa.index') }}">
          <div class="card-title d-flex align-items-start justify-content-between">
            <i style="font-size: 20px" class='bx bx-book p-2 rounded-circle bg-warning text-white'></i>
          </div>
          <span class="fw-semibold d-block mb-1">Pendaftaran Seminar Hasil</span>
          <div>
            <span class="fw-bold card-title mb-2 h5">{{ count($semhasProgres) }}</span>
            <small class="text-secondary fw-normal">Mahasiswa</small>
          </div>
        </a>
        <div class="accordion mt-3" id="accordion-seminar-hasil">
          <div class="card accordion-item active">
            <h2 class="accordion-header" id="headingOne">
              <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-seminar-hasil" aria-expanded="true" aria-controls="collapse-seminar-hasil">
                Mahasiswa Seminar Hasil
              </button>
            </h2>
            <div id="collapse-seminar-hasil" class="accordion-collapse collapse show" data-bs-parent="#accordion-seminar-hasil">
              <div class="accordion-body">
                <!-- List group -->
                <div class="demo-inline-spacing mt-3">
                  <ol class="list-group list-group-flush">
                    @foreach ($semhasProgres->take(5) as $item)
                    <li class="list-group-item d-flex justify-content-end align-items-center">
                      <a href="." class="text-decoration-none text-reset d-block me-auto">{{ ucwords($item->mahasiswa->nama) }}</a>
                      @php
                      $now = \Carbon\Carbon::parse();
                      $tgl = \Carbon\Carbon::parse($item->tgl_acc);
                      $result = $tgl->diffInDays($now);
                      echo '<div class="col-auto"><sup> + </sup> ' . $result . ' hari</div>';
                      if ($result >= 60) {
                      echo '<span class="badge badge-center"><i class="bx bxs-circle" style="color: red"></i></span>';
                      } elseif ($result >= 30) {
                      echo '<span class="badge badge-center"><i class="bx bxs-circle" style="color: yellow"></i></span>';
                      } elseif ($result <= 29) { echo '<span class="badge badge-center"><i class="bx bxs-circle" style="color: green"></i></span>' ; } @endphp </li>
                        @endforeach
                  </ol>
                </div>
                <!--/ List group -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Result SeminarHasil -->
  <!-- Result Pendadaran -->
  <div class="col-12 col-lg-4 mb-4">
    <a href="{{ route('pendadaran-mahasiswa.index') }}">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <i style="font-size: 20px" class='bx bx-book-bookmark p-2 rounded-circle bg-success text-white'></i>
          </div>
          <span class="fw-semibold d-block mb-1">Pendaftaran Pendadaran</span>
          <div>
            <span class="fw-bold card-title mb-2 h5">{{ count($pendadaranProgres) }}</span>
            <small class="text-secondary fw-normal">Mahasiswa</small>
          </div>
        </div>
      </div>
    </a>
  </div>
  <!-- /Result Pendadaran -->
</div>
@endrole
@endsection
