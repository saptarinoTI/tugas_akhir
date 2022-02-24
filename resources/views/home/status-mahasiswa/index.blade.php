@extends('layout.app')
@section('main-title', 'Data Lulusan Mahasiswa Teknik Informatika')
@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table_mahasiswa_lulus" class="table card-table table-vcenter datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted">NIM Mhs.</th>
                                <th class="text-muted">Nama Mhs.</th>
                                <th class="text-muted">Thn. Lulus</th>
                                <th class="text-muted">Status Lulus</th>
                                <th class="text-muted">Aksi</th>
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
            /* Script of DataTables */
            $(function() {
                var table = $('#table_mahasiswa_lulus').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    order: [
                        [3, "desc"]
                    ],
                    pagingType: "simple_numbers",
                    ajax: "{{ route('mahasiswa-lulus.getData') }}",
                    columns: [{
                            data: 'nim',
                            name: 'nim'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'thn_lulus',
                            name: 'thn_lulus'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        },
                    ]
                });
            });

            $(document).ready(function($) {
                $("#modal").on("show.bs.modal", function(e) {
                    var button = $(e.relatedTarget);
                    var modal = $(this);
                    modal.find(".modal-body").load(button.data("remote"));
                    modal.find(".modal-title").html(button.data("title"));
                });
            });
        </script>
        <div class="modal modal-blur fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    @endpush
@endsection
