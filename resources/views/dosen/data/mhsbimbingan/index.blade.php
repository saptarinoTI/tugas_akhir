@extends('layout.app')
@section('main-title', 'Data Proposal Tugas Akhir')
@section('main-page')
    <p>Mahasiswa Proposal Tugas Akhir Sesuai dengan Pemberian Prodi.</p>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table_mhs_bimbingan" class="table card-table table-vcenter datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted">NIM</th>
                                <th class="text-muted">Nama</th>
                                <th class="text-muted col-md-6">Skripsi</th>
                                <th class="text-muted">Pemb.</th>
                                <th class="text-muted">Tahun</th>
                                <th class="text-muted col-md-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('after-script')
        <script>
            // Script of DataTables
            $(function() {
                var table = $('#table_mhs_bimbingan').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    // lengthChange: false,
                    order: [
                        [0, "desc"]
                    ],
                    ajax: "{{ route('mahasiswa-bimbingan.getdata') }}",
                    columns: [{
                        data: 'nim',
                        name: 'nim'
                    }, {
                        data: 'nama',
                        name: 'nama'
                    }, {
                        data: 'judul',
                        name: 'judul'
                    }, {
                        data: 'pemb',
                        name: 'pemb'
                    }, {
                        data: 'tgl',
                        name: 'tgl'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, ]
                });
            });
        </script>
    @endpush

@endsection
