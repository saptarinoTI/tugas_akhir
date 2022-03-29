<div class="table-responsive-lg">
    <table class="table app-table-hover mb-0 text-left">
        <tr>
            <th class="col-4">NIM Mahasiswa</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ $pendadaran->mahasiswa->nim }}
            </td>
        </tr>
        <tr>
            <th class="col-4">Nama Mahasiswa</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($pendadaran->mahasiswa->nama) }}
            </td>
        </tr>
        <tr>
            <th class="col-4">Tempat Tanggal Lahir</th>
            <th>:</th>
            <td class="text-dark fw-semibold">
                {{ ucwords($pendadaran->mahasiswa->tpt_lahir) .', ' .date('d F Y', strtotime($pendadaran->mahasiswa->tgl_lahir)) }}
            </td>
        </tr>
        <tr>
            <th class="col-4">Nomor HP</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ $pendadaran->mahasiswa->no_hp }}</td>
        </tr>
        <tr>
            <th class="col-4">Alamat</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($pendadaran->mahasiswa->alamat) }}</td>
        </tr>
        <tr>
            <th class="col-4">Pembimbing Utama</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($pendadaran->mahasiswa->proposal->dosen_satu->nama) }}
            </td>
        </tr>
        <tr>
            <th class="col-4">Pembimbing Pendamping</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($pendadaran->mahasiswa->proposal->dosen_dua->nama) }}
            </td>
        </tr>
        <tr>
            <th class="col-4">Judul Tugas Akhir</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($pendadaran->mahasiswa->proposal->judul_ta) }}</td>
        </tr>
        <tr>
            <th class="col-4">Kartu Rencana Studi</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->krs) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Transkip Nilai</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->transkip_nilai) }}"
                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Lembar Aktifitas Tugas Akhir</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->lmbr_konsultasi) }}"
                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Surat Keterangan Bebas Perkuliahan dari BAAK</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->bebas_perkuliahan) }}"
                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Surat Keterangan Bebas Keuangan dari BAUK</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->bebas_keuangan) }}"
                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Surat Keterangan Bebas Perpustakaan</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->bebas_perpus) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Surat Keterangan Bebas Laboratorium</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->bebas_lab) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Sertifikat Action Program</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->act_program) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Sertifikat Kompetensi Laboratorium</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->komp_lab) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Sertifikat TOEFL</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->toefl) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Fotocopy Ijazah Terakhir</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->ijazah_terakhir) }}"
                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Fotocopy KTP</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->ktp) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Fotocopy Akte Kelahiran</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->akte_kelahiran) }}"
                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        <tr>
            <th class="col-4">Foto 3 x 4 Berwarna</th>
            <th>:</th>
            <td class="text-dark fw-semibold"><a href="{{ Storage::url($pendadaran->foto) }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-sm btn-primary"
                    style="padding: 2px 8px !important">Unduh</a></td>
        </tr>
        @if ($pendadaran->tgl_lulus)
            <tr>
                <th class="col-4">Tgl.Lulus</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($pendadaran->tgl_lulus)) }}</td>
            </tr>
        @endif
        <tr>
            <th class="col-4">Status</th>
            <th>:</th>
            <td class="text-dark fw-semibold">
                @if ($pendadaran->status == 'diterima')
                    <span class="badge bg-dark">Diterima
                    @elseif ($pendadaran->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak
                        @elseif ($pendadaran->status == 'lulus')
                            <span class="badge bg-success">Lulus
                            @else
                                <span class="badge bg-info">Dikirim
                @endif
                </span>
            </td>
        </tr>
        <tr>
            <th class="col-4">Keterangan</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($pendadaran->keterangan) }}</td>
        </tr>
    </table>
</div>
