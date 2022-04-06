<div class="table-responsive-lg">
    <table class="table app-table-hover mb-0 text-left">
        <tr>
            <th class="col-4">Id Ajuan</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($semhas->id) }}
            </td>
        </tr>

        <tr>
            <th class="col-4">NIM</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($semhas->mahasiswa->nim) }}
            </td>
        </tr>

        <tr>
            <th class="col-4">Nama</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($semhas->mahasiswa->nama) }}
            </td>
        </tr>

        <tr>
            <th class="col-4">Tempat Tanggal Lahir</th>
            <th>:</th>
            <td class="text-dark fw-semibold">
                {{ ucwords($semhas->mahasiswa->tpt_lahir) . ', ' . date('d F Y', strtotime($semhas->mahasiswa->tgl_lahir)) }}
            </td>
        </tr>

        @if ($semhas->mahasiswa->no_hp != null)
            <tr>
                <th class="col-4">Nomor HP</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ $semhas->mahasiswa->no_hp }}</td>
            </tr>
        @endif

        @if ($semhas->mahasiswa->alamat != null)
            <tr>
                <th class="col-4">Alamat</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($semhas->mahasiswa->alamat) }}</td>
            </tr>
        @endif

        @if ($semhas->proposal->file_satu != null)
            <tr>
                <th class="col-4">File Ajuan Satu</th>
                <th>:</th>
                <td>
                    <a href="storage/{{ $semhas->proposal->file_satu }}" target="_blank"
                        class="text-decoration-none text-dark fw-bolder"><i class="ti ti-files"></i></a>
                </td>
            </tr>
        @endif
        @if ($semhas->proposal->file_dua != null)
            <tr>
                <th class="col-4">File Ajuan Dua</th>
                <th>:</th>
                <td>
                    <a href="storage/{{ $semhas->proposal->file_dua }}" target="_blank"
                        class="text-decoration-none text-dark fw-bolder"><i class="ti ti-files"></i></a>
                </td>
            </tr>
        @endif
        @if ($semhas->proposal->file_tiga != null)
            <tr>
                <th class="col-4">File Ajuan Tiga</th>
                <th>:</th>
                <td>
                    <a href="storage/{{ $semhas->proposal->file_tiga }}" target="_blank"
                        class="text-decoration-none text-dark fw-bolder"><i class="ti ti-files"></i></a>
                </td>
            </tr>
        @endif

        @if ($semhas->proposal->dosen_id_satu != null)
            <tr>
                <th class="col-4">Pembimbing Utama</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($semhas->proposal->dosen_satu->nama) }}</td>
            </tr>
        @endif

        @if ($semhas->proposal->dosen_id_dua != null)
            <tr>
                <th class="col-4">Pembimbing Pendamping</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($semhas->proposal->dosen_dua->nama) }}</td>
            </tr>
        @endif

        @if ($semhas->judul_ta != null)
            <tr>
                <th class="col-4">Judul Tugas Akhir</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($semhas->judul_ta) }}</td>

            </tr>
        @endif

        <tr>
            <th class="col-4">Tgl. Ajuan Proposal</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($semhas->created_at)) }}</td>
        </tr>

        <tr>
            <th class="col-4">Status</th>
            <th>:</th>
            <td>
                @if ($semhas->status == 'diterima')
                    <span class="badge bg-dark">Diterima
                    @elseif ($semhas->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak
                        @elseif($semhas->status == 'selesai')
                            <span class="badge bg-success">Selesai
                            @else
                                <span class="badge bg-info">Dikirim
                @endif
                </span>
            </td>
        </tr>

        @if ($semhas->tgl_acc != null)
            <tr>
                <th class="col-4">Tgl. Proposal Diterima</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ date('d F Y', strtotime($semhas->tgl_acc)) }}</td>
            </tr>
        @endif

        <tr>
            <th class="col-4">Keterangan</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($semhas->keterangan) }}</td>
        </tr>

    </table>
</div>
