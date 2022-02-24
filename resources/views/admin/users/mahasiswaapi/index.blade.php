@extends('layout.app')
@section('main-title', 'Data Mahasiswa API')
@section('main-title2')
    @role('superadmin')
        <form action="{{ route('mahasiswa-api.store') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary p-2 border-0 rounded-2 d-block d-sm-inline-block">Update
                Data</button>
        </form>
    @endrole
@endsection

@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table_mahasiswa" class="table card-table table-vcenter datatable nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted">NIM</th>
                                <th class="text-muted">Nama</th>
                                <th class="text-muted">TTL</th>
                                <th class="text-muted">Thn. Ajaran</th>
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
                var table = $('#table_mahasiswa').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    pageLength: 12,
                    lengthChange: false,
                    ajax: "{{ route('mahasiswa-api.get') }}",
                    columns: [{
                            data: 'mhs_no',
                            name: 'mhs_no'
                        },
                        {
                            data: 'mhs_nama',
                            name: 'mhs_nama'
                        },
                        {
                            data: 'ttl',
                            name: 'ttl'
                        },
                        {
                            data: 'ta_id',
                            name: 'ta_id'
                        },
                    ]
                });
            });
        </script>
    @endpush

@endsection
