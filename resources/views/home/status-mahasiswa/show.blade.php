<div class="table-responsive-lg">
    <table class="table app-table-hover mb-0 text-left">
        <tr>
            <th class="col-4">NIM Mhs.</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ $pendadaran->mahasiswa->nim }}</td>
        </tr>
        <tr>
            <th class="col-4">Nama Mhs.</th>
            <th>:</th>
            <td class="text-dark fw-semibold">{{ ucwords($pendadaran->mahasiswa->nama) }}</td>
        </tr>
        <tr>
            <th class="col-4">Tempat Tanggal Lahir</th>
            <th>:</th>
            <td class="text-dark fw-semibold">
                {{ ucwords($pendadaran->mahasiswa->tpt_lahir) .', ' .date('d F Y', strtotime($pendadaran->mahasiswa->tgl_lahir)) }}
            </td>
        </tr>
        @if ($pendadaran->mahasiswa->no_hp)
            <tr>
                <th class="col-4">Nomor HP</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ $pendadaran->mahasiswa->no_hp }}</td>
            </tr>
        @endif
        @if ($pendadaran->mahasiswa->alamat)
            <tr>
                <th class="col-4">Alamat</th>
                <th>:</th>
                <td class="text-dark fw-semibold">{{ ucwords($pendadaran->mahasiswa->alamat) }}</td>
            </tr>
        @endif
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
    </table>
</div>
