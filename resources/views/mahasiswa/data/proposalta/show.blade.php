<div class="table-responsive-lg">
    <table class="table app-table-hover mb-0 text-left">
        <tr>
            <th class="col-4">Id Ajuan</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($proposal->id) }}
            </td>
        </tr>

        <tr>
            <th class="col-4">NIM</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($proposal->mahasiswa->nim) }}
            </td>
        </tr>

        <tr>
            <th class="col-4">Nama</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($proposal->mahasiswa->nama) }}
            </td>
        </tr>

        <tr>
            <th class="col-4">Tempat Tanggal Lahir</th>
            <th>:</th>
            <td class="text-dark fw-semibold">
                {{ ucwords($proposal->mahasiswa->tpt_lahir) . ', ' . date('d F Y', strtotime($proposal->mahasiswa->tgl_lahir)) }}
            </td>
        </tr>

        @if ($proposal->mahasiswa->no_hp != null)
            <tr>
                <th class="col-4">Nomor HP</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ $proposal->mahasiswa->no_hp }}</td>
            </tr>
        @endif

        @if ($proposal->mahasiswa->alamat != null)
            <tr>
                <th class="col-4">Alamat</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($proposal->mahasiswa->alamat) }}</td>
            </tr>
        @endif

        @if ($proposal->status == 'dikirim')
            @if ($proposal->file_satu != null)
                <tr>
                    <th class="col-4">File Ajuan Satu</th>
                    <th>:</th>
                    <td>
                        <a href="storage/{{ $proposal->file_satu }}" target="_blank"
                            class="text-decoration-none text-dark fw-bolder"><i class="ti ti-files"></i></a>
                    </td>
                </tr>
            @endif
            @if ($proposal->file_dua != null)
                <tr>
                    <th class="col-4">File Ajuan Dua</th>
                    <th>:</th>
                    <td>
                        <a href="storage/{{ $proposal->file_dua }}" target="_blank"
                            class="text-decoration-none text-dark fw-bolder"><i class="ti ti-files"></i></a>
                    </td>
                </tr>
            @endif
            @if ($proposal->file_tiga != null)
                <tr>
                    <th class="col-4">File Ajuan Tiga</th>
                    <th>:</th>
                    <td>
                        <a href="storage/{{ $proposal->file_tiga }}" target="_blank"
                            class="text-decoration-none text-dark fw-bolder"><i class="ti ti-files"></i></a>
                    </td>
                </tr>
            @endif
        @endif

        @if ($proposal->dosen_id_satu != null)
            <tr>
                <th class="col-4">Pembimbing Utama</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($proposal->dosen_satu->nama) }}</td>
            </tr>
        @endif

        @if ($proposal->dosen_id_dua != null)
            <tr>
                <th class="col-4">Pembimbing Pendamping</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($proposal->dosen_dua->nama) }}</td>
            </tr>
        @endif

        @if ($proposal->judul_ta != null)
            <tr>
                <th class="col-4">Judul Tugas Akhir</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($proposal->judul_ta) }}</td>

            </tr>
        @endif

        <tr>
            <th class="col-4">Tgl. Ajuan Proposal</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($proposal->created_at)) }}</td>
        </tr>

        <tr>
            <th class="col-4">Status</th>
            <th>:</th>
            <td>
                @if ($proposal->status == 'diterima')
                    <span class="badge bg-success">Diterima
                    @elseif ($proposal->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak
                        @elseif ($proposal->status == 'diproses')
                            <span class="badge bg-dark">Diproses
                            @elseif ($proposal->status == 'diperiksa')
                                <span class="badge bg-warning">Diperiksa
                                @else
                                    <span class="badge bg-info">Dikirim
                @endif
                </span>
            </td>
        </tr>

        @if ($proposal->tgl_acc != null)
            <tr>
                <th class="col-4">Tgl. Proposal Diterima</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($proposal->tgl_acc)) }}</td>
            </tr>
        @endif

        <tr>
            <th class="col-4">Keterangan</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($proposal->keterangan) }}</td>
        </tr>

    </table>
</div>
