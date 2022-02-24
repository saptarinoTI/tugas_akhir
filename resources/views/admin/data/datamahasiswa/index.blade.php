@extends('layout.app')
@section('main-title', 'Data Mahasiswa')
@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="data_mahasiswa" class="table card-table table-vcenter datatable nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted">NIM</th>
                                <th class="text-muted">Nama</th>
                                <th class="text-muted">TTL</th>
                                <th class="text-muted">Nomor Hp</th>
                                <th class="text-muted">Alamat</th>
                                <th class="text-muted">Tgl. Submit</th>
                                <th class="text-muted">Tgl. Update</th>
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
            $(function() {
                var table = $('#data_mahasiswa').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    order: [
                        [0, "asc"]
                    ],
                    ajax: "{{ route('data-mahasiswa.get') }}",
                    columns: [{
                        data: 'nim',
                        name: 'nim'
                    }, {
                        data: 'nama',
                        name: 'nama'
                    }, {
                        data: 'ttl',
                        name: 'ttl'
                    }, {
                        data: 'nohp',
                        name: 'nohp'
                    }, {
                        data: 'alamat',
                        name: 'alamat'
                    }, {
                        data: 'tgl_add',
                        name: 'tgl_add'
                    }, {
                        data: 'tgl_update',
                        name: 'tgl_update'
                    }, ]
                });
            });
        </script>
    @endpush
@endsection
