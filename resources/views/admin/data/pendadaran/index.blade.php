@extends('layout.app')
@section('main-title', 'Data Pendaftaran Pendadaran Tugas Akhir Mahasiswa')
@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table_pendadaran" class="table card-table table-vcenter datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted">NIM Mhs.</th>
                                <th class="text-muted">Nama Mhs.</th>
                                <th class="text-muted">Status</th>
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
            $(function() {
                var table = $('#table_pendadaran').DataTable({
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
                    ajax: "{{ route('data-pendadaran.getdata') }}",
                    columns: [{
                        data: 'nim',
                        name: 'nim'
                    }, {
                        data: 'nama',
                        name: 'nama'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, {
                        data: 'btn',
                        name: 'btn'
                    }, ]
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
