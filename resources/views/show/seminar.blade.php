<div class="table-responsive-lg">
  <table class="table app-table-hover mb-0 text-left">
    <tr>
      <th class="col-4">NIM</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ ucwords($seminar->mahasiswa->nim) }}
      </td>
    </tr>

    <tr>
      <th class="col-4">Nama</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ ucwords($seminar->mahasiswa->nama) }}
      </td>
    </tr>

    <tr>
      <th class="col-4">Tempat Tanggal Lahir</th>
      <th>:</th>
      <td class="text-dark fw-semibold">
        {{ ucwords($seminar->mahasiswa->tpt_lahir) . ', ' . date('d F Y', strtotime($seminar->mahasiswa->tgl_lahir)) }}
      </td>
    </tr>

    @if ($seminar->mahasiswa->no_hp != null)
    <tr>
      <th class="col-4">Nomor HP</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ $seminar->mahasiswa->no_hp }}</td>
    </tr>
    @endif

    @if ($seminar->mahasiswa->alamat)
    <tr>
      <th class="col-4">Alamat</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ ucwords($seminar->mahasiswa->alamat) }}</td>
    </tr>
    @endif

    <tr>
      <th class="col-4">Pembimbing Utama</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ ucwords($seminar->proposal->dosen_satu->nama) }}</td>
    </tr>

    <tr>
      <th class="col-4">Pembimbing Pendamping</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ ucwords($seminar->proposal->dosen_dua->nama) }}</td>
    </tr>

    <tr>
      <th class="col-4">Judul Tugas Akhir</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ ucwords($seminar->judul_ta) }}</td>
    </tr>

    <tr>
      <th class="col-4">Kartu Rencana Studi</th>
      <th>:</th>
      <td class="text-dark fw-semibold"><a href="{{ Storage::url($seminar->krs) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary border-0 rounded-2">Unduh</a></td>
    </tr>

    <tr>
      <th class="col-4">Transkip Nilai</th>
      <th>:</th>
      <td class="text-dark fw-semibold"><a href="{{ Storage::url($seminar->transkip_nilai) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary border-0 rounded-2">Unduh</a></td>
    </tr>

    <tr>
      <th class="col-4">Laporan Kerja Praktek</th>
      <th>:</th>
      <td class="text-dark fw-semibold"><a href="{{ Storage::url($seminar->laporan_kp) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary border-0 rounded-2">Unduh</a></td>
    </tr>

    <tr>
      <th class="col-4">Kartu Kuning</th>
      <th>:</th>
      <td class="text-dark fw-semibold"><a href="{{ Storage::url($seminar->kartu_kuning) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary border-0 rounded-2">Unduh</a></td>
    </tr>

    <tr>
      <th class="col-4">Surat Keterangan Keuangan</th>
      <th>:</th>
      <td class="text-dark fw-semibold"><a href="{{ Storage::url($seminar->sk_keuangan) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary border-0 rounded-2">Unduh</a></td>
    </tr>

    <tr>
      <th class="col-4">Lembar Konsultasi Konsultasi</th>
      <th>:</th>
      <td class="text-dark fw-semibold"><a href="{{ Storage::url($seminar->lmbr_konsultasi) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary border-0 rounded-2">Unduh</a></td>
    </tr>

    @if ($seminar->tgl_acc)
    <tr>
      <th class="col-4">Tgl. Acc</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($seminar->tgl_acc)) }}</td>
    </tr>
    @endif

    <tr>
      <th class="col-4">Status</th>
      <th>:</th>
      <td class="text-dark fw-semibold">
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
    </tr>

    <tr>
      <th class="col-4">Tgl. Pendaftaran</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($seminar->created_at)) }}</td>
    </tr>

    <tr>
      <th class="col-4">Tgl. Perubahan</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($seminar->updated_at)) }}</td>
    </tr>

    <tr>
      <th class="col-4">Catatan</th>
      <th>:</th>
      <td class="text-dark fw-semibold">{{ ucwords($seminar->keterangan) }}</td>
    </tr>

  </table>
</div>
